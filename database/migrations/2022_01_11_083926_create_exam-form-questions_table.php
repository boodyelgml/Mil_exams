<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamFormQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_form_questions', function (Blueprint $table) {
            $table->increments("id");
            $table->string("title");
            $table->boolean("is_enabled");
            $table->string("exam_duration");

            $table->integer('exam_form_id')->unsigned();
            $table->foreign('exam_form_id')->references('id')->on('exam_forms');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_form_questions');
    }
}
