<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class question_choises extends Model
{
    protected $table = 'question_choises';

    public function exam_form_questions()
    {
        return $this->belongsTo('\App\exam_form_questions', 'questions_id');
    }
}
