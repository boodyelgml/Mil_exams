<?php

namespace App\Http\Controllers;

use App\Models\exam_form;
use App\Models\exam_form_questions;
use App\Models\factions;
use App\Models\final_result;
use App\Models\item;
use App\Models\level;
use App\Models\question_choises;
use App\Models\units;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class DeleteController extends Controller
{



    public function exams_list()
    {
        $exams = exam_form::all();
        return view('admin.exams_list', ['exams' => $exams]);
    }



    public function review_exam_questions($examId)
    {
        $exam = exam_form::where('id', $examId)->first();

        $question = DB::select("SELECT q.id q_id, q.name q_name , ef.id exam_id, ef.name exam_name from questions AS q
                                            JOIN exam_form_questions AS efq ON efq.questions_id = q.id AND efq.exam_form_id = ?
                                            JOIN exam_forms AS ef ON efq.exam_form_id = ef.id", [$examId]);

        $questions_choises = DB::select("SELECT * from question_choises");

        return view('admin.review_exam_questions', ['questions' => $question, 'questions_choises' => $questions_choises, 'exam' => $exam]);
    }




    public function delete_exam($examId, $questionId)
    {
        $exam_question = exam_form_questions::where([['exam_form_id', $examId], ['questions_id', $questionId]])->first();
        $exam_question->delete();
    }




    public function delete_exam_by_id($examId)
    {
        $exam = exam_form::where('id', $examId)->first();
        $exam_question = exam_form_questions::where('exam_form_id', $examId);

        // $exam_question->each()->delete();

        foreach ($exam_question as $question) {
            $question->delete();
        }

        $exam->delete();
    }



    public function delete_level($levelId)
    {
        $exam = exam_form::where('level_id', $levelId);

        $exam_question = exam_form_questions::where('exam_form_id', $levelId);

        $level = level::where('id', $levelId)->first();


        foreach ($exam_question as $question) {
            $question->delete();
        }


        foreach ($exam as $ex) {
            $ex->delete();
        }


        $level->delete();
    }


    public function change_exam_questions_count($examId)
    {
        $exam = exam_form::where('id', $examId)->first();
        return view('admin.change_exam_questions_count', ['exam' => $exam]);
    }


    public function update_exam_questions_count(Request $request)
    {

        $request->validate([
            'question_display_count' => 'required|min:1',
        ], [
            'question_display_count.required' => 'برجاء إدخال عدد الاسئلة فى المادة',

        ]);


        $exam = exam_form::where('id', $request->exam_id)->first();
        $exam->question_display_count = $request->question_display_count;
        $exam->save();
    }


}
