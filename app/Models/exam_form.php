<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class exam_form extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'exam_forms';


    public function questions()
    {
        return $this->belongsToMany(questions::class, 'exam_form_questions');
    }
}
