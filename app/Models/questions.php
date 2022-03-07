<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class questions extends Model
{
    protected $table = 'questions';


    public function exams()
    {
        return $this->belongsToMany(exam_form::class, 'exam_form_questions');
    }
}
