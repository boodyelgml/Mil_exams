<?php

namespace App\Http\Controllers;

use App\Models\exam_form;
use App\Models\exam_form_questions;
use App\Models\factions;
use App\Models\final_result;
use App\Models\question_choises;
use App\Models\questions;
use App\Models\timer;
use App\Models\User;
use Carbon\Carbon;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class ExamFormQuestionsController extends Controller
{


    public function getLastResult($user_id)
    {
        $user = User::where('id', $user_id)->first();
        $returned_result = final_result::where([['user_id', $user->id], ['exam_count', $user->exams_counter]])->get();
        return response()->json($returned_result);
    }



    public function get_result($user_Id)
    {
        $viewResult = new result();
        $user = User::where('id', $user_Id)->first();
        $final_result = final_result::where('user_id', $user_Id)->first();


        $viewResult->user_name = $user->name;
        $viewResult->exam_form_name = exam_form::where('id', $user->exam_id)->first()->name;
        $viewResult->correct_answers = $final_result->total_correct;
        $viewResult->wrong_answers = $final_result->total_failed;
        $viewResult->total_answers =  $final_result->total_correct + $final_result->total_failed;

        return view('admin.result', ['results' => $viewResult]);
    }




    public function to_add_question_view()
    {
        $exam = exam_form::all();
        return view('admin.add_question', ['exams' => $exam]);
    }



    public function create_question(Request $request)
    {

        $request->validate([
            'exam' => 'required|min:1',
            'question' => 'required|min:6',
            'answer1' => 'required',
            'answer2' => 'required',
            'answer3' => 'required',
            'answer4' => 'required',
            'is_correct' => 'required',
        ], [
            'exam.required' => 'اختار مادة واحدة على الأقل',
            'question.required' => 'يجب إدخال السؤال',
            'question.min' => 'يجب ألا يقل السؤال عن 6 أحرف',
            'answer1.required' => 'يجب إدخال الاختيار الأول',
            'answer2.required' => 'يجب إدخال الاختيار الثانى',
            'answer3.required' => 'يجب إدخال الاختيار الثالث',
            'answer4.required' => 'يجب إدخال الاختيار الرابع',
            'is_correct.required' => 'يجب إختيار الأجابة الصحيحة',

        ]);


        // 1- save question
        $question = new questions();
        $question->name = $request->question;
        $question->save();

        // 2- save choises
        $answer1 = new question_choises();
        $answer1->title =  $request->answer1;
        $answer1->is_correct = intval($request->is_correct) == 1 ? 1 : 0;
        $answer1->question_id =  $question->id;
        $answer1->save();


        $answer2 = new question_choises();
        $answer2->title =  $request->answer2;
        $answer2->is_correct = intval($request->is_correct) == 2 ? 1 : 0;;
        $answer2->question_id =  $question->id;
        $answer2->save();

        $answer3 = new question_choises();
        $answer3->title =  $request->answer3;
        $answer3->is_correct = intval($request->is_correct) == 3 ? 1 : 0;;
        $answer3->question_id =  $question->id;
        $answer3->save();

        $answer4 = new question_choises();
        $answer4->title =  $request->answer4;
        $answer4->is_correct = intval($request->is_correct) == 4 ? 1 : 0;;
        $answer4->question_id =  $question->id;
        $answer4->save();

        // 1- link with exam
        foreach ($request->exam as $exam) {
            DB::table('exam_form_questions')->insert(array("exam_form_id" => intval($exam), "questions_id" => $question->id));
        }
    }


    public function changeTimer(Request $request)
    {
        $timer = timer::first();
        $timer->duration = $request->timer_duration;
        $timer->save();
    }
}



class result
{
    public $total_answers;
    public $correct_answers;
    public $wrong_answers;
    public $exam_form_name;
    public $faction_name;
}
