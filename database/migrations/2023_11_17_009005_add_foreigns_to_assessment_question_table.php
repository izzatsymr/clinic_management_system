<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assessment_question', function (Blueprint $table) {
            $table
                ->foreign('question_id')
                ->references('id')
                ->on('questions')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('assessment_id')
                ->references('id')
                ->on('assessments')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assessment_question', function (Blueprint $table) {
            $table->dropForeign(['question_id']);
            $table->dropForeign(['assessment_id']);
        });
    }
};
