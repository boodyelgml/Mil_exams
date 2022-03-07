<?php

namespace App\Http\Controllers;

use App\Models\exam_form;
use App\Models\exam_form_questions;
use App\Models\factions;
use App\Models\final_result;
use App\Models\final_result_log;
use App\Models\level;
use App\Models\question_choises;
use App\Models\questions;
use App\Models\rotba;
use App\Models\timer;
use App\Models\units;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamFormController extends Controller
{

    public function checkIfUserExist(Request $request)
    {
        $user = User::where('mil_number', intval($request->mil_number))->first();
        if ($user != null && $user->mil_number > 1) {
            return $user;
        } else {
            return 0;
        }
    }


    public function to_add_exam_view()
    {
        $levels = level::all();
        $exams = exam_form::all();
        return view('admin.add_exam', ['levels' => $levels, 'exams' => $exams]);
    }



    public function create_exam(Request $request)
    {
        $request->validate([
            'name' => 'required|min:4',
            'level' => 'required',
        ], [
            'name.required' => 'برجاء إدخال إسم المادة',
            'level.required' => 'برجاء إختيار مستوى واحد على الأقل',
        ]);


        foreach ($request->level as $level) {

            $level_formDB = level::where('id', $level)->first();
            $name = '';
            $name = $request->name . " - " . $level_formDB->name;

            DB::table('exam_forms')->insert(array("name" => $name, "is_enabled" => 1, "level_id" => $level));
        }
    }


    public function start_exam($mil_number)
    {

        $user = User::where('mil_number', $mil_number)->first();
        $exams = DB::select("SELECT * from exam_forms WHERE level_id = ?", [$user->level_id]);

        $all_question = array();

        foreach ($exams as $exam) {
            $question = DB::select("SELECT q.id q_id, q.name q_name , ef.id exam_id, ef.name exam_name from questions AS q
                                            JOIN exam_form_questions AS efq ON efq.questions_id = q.id AND efq.exam_form_id = ?
                                            JOIN exam_forms AS ef ON efq.exam_form_id = ef.id
                                            ORDER BY RAND () LIMIT ? ", [$exam->id , $exam->question_display_count]);
            $all_question[] = $question;
        }

        $all_questions = array();

        foreach ($all_question as $to_obj) {
            $all_questions[] = (object)$to_obj;
        }

        $questions_choises = DB::select("SELECT * from question_choises");
        //dd($all_question);
        $timer = timer::first();

        if ($user->id != null) {
            if ($user->is_user_did_exam_before > 1) {
                return view('exams.start_exam', [
                    'user' => $user,
                    'timer' => $timer,
                    'exams' => $exams,
                    'all_questions' => $all_questions,
                    'questions_choises' => $questions_choises,

                ]);
            }

            $user->is_user_did_exam_before = $user->is_user_did_exam_before + 1;
            $user->save();

            return view('exams.start_exam', [
                'user' => $user,
                'timer' => $timer,
                'exams' => $exams,
                'all_questions' => $all_questions,
                'questions_choises' => $questions_choises,
            ]);
        }

        return null;
    }



    public function finishExam(Request $request)
    {
        $user_id = intval($request->user_id);
        $user = User::where('id', $user_id)->first();

        $result = array();
        $exam_name = array();
        foreach ($request->all() as $key => $value) {

            if ($key != "_token" && $key != "user_id") {
                $exam = explode(',', $key);
                if (isset($exam[1])) {
                    $key = $exam[1];
                }
                $result[] = (object)[$key, $value];
                $exam_name[] = $key;
            }
        }


        $correct_answers = 0;
        $wrong_answers = 0;
        $resultObject = (object)['exam_name' => '', 'total_correct' => 0, 'total_failed' => 0];

        $exams_counts_per_user = 0;
        $total_percentage = 0;



        foreach ($exam_name as $exam) {

            if ($exam != $resultObject->exam_name) {

                foreach ($result as $key => $value) {

                    if ($exam == value((array)$value)[0]) {
                        if (value((array)$value)[1]  === "1") {
                            $correct_answers++;
                        } else if (value((array)$value)[1]  === "0") {
                            $wrong_answers++;
                        } else {
                            $wrong_answers++;
                        }
                    }

                    $resultObject->exam_name = $exam;
                    $resultObject->total_correct = $correct_answers;
                    $resultObject->total_failed = $wrong_answers;
                }


                $final_result = new final_result();

                //update exam counter
                $final_result->exam_count = $user->exams_counter + 1;

                //save result
                $final_result->user_id = $user_id;
                $final_result->exam_name = $resultObject->exam_name;
                $final_result->total_correct = $resultObject->total_correct;
                $final_result->total_failed = $resultObject->total_failed;
                $final_result->save();

                $total_percentage += ($resultObject->total_correct / ($resultObject->total_correct + $resultObject->total_failed)) * 100;
                $exams_counts_per_user++;
            }

            $correct_answers = 0;
            $wrong_answers = 0;
        }


        $user->last_exam_percentage = $total_percentage / $exams_counts_per_user;
        $user->last_exam_date = Carbon::now();
        $user->exams_counter += 1;
        $user->is_user_did_exam_before = 1;
        $user->save();


        // final_result_log
        $final_result_log = new final_result_log();
        $final_result_log->user_id = $user->id;
        $final_result_log->user_name = $user->name;
        $final_result_log->rotba_name = rotba::where('id' , $user->rotba_id)->first()->name;
        $final_result_log->weapon_name = $user->weapon_name;
        $final_result_log->mil_number = $user->mil_number;
        $final_result_log->unit_name = units::where('id' , $user->unit_id)->first()->name;
        $final_result_log->work = $user->job_name;
        $final_result_log->level_name = level::where('id' , $user->level_id)->first()->name;
        $final_result_log->result = $user->last_exam_percentage;
        $final_result_log->save();


        $returned_result = final_result::where([ ['user_id', $user->id], ['exam_count', $user->exams_counter]])->get();

        return response()->json($returned_result);
    }






}
