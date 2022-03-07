<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionChoisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_choises', function (Blueprint $table) {
            $table->increments("id");
            $table->string("name");
            $table->boolean("is_correct");

            $table->integer('question_id')->unsigned();
            $table->foreign('question_id')->references('id')->on('exam_form_questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_choises');
    }
}
