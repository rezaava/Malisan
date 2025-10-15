<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id');

            $table->integer('tarahi_soal_nomre')->nullable()->default('15');
            $table->string('tarahi_soal_desc')->nullable()->default('سوال 4 گزینه ای که طرح میکنید مرتبط با موضوع باشد');
            $table->integer('ersal_gozaresh_nomre')->nullable()->default('15');
            $table->string('ersal_gozaresh_desc')->nullable()->default('برداشتتان از مباحث این جلسه را در 10 سطر بنویسید');
            $table->integer('taklif_seminar_nomre')->nullable()->default('0');
            $table->string('taklif_seminar_desc')->nullable();
            $table->tinyInteger('taklif_seminar_type')->nullable()->default('1')->comment('1.taklif 2.seminar');
            $table->integer('quiz_mid_nomre')->nullable()->default('10');
            $table->integer('quiz_mid_desc')->default('5');
            $table->tinyInteger('quiz_mid_type')->nullable()->default('1')->comment('1.quiz 2.mid');
            $table->integer('pishraft_nomre')->nullable()->default('15');
            $table->string('pishraft_desc')->nullable();
            $table->integer('talash_nomre')->nullable()->default('15');
            $table->string('talash_desc')->nullable();
            $table->integer('hozor_nomre')->nullable()->default('0');
            $table->string('hozor_desc')->nullable();
            $table->integer('amali_nomre')->nullable()->default('0');
            $table->string('amali_desc')->nullable();
            $table->integer('final_nomre')->nullable()->default('30');
            $table->string('final_desc')->nullable();
            $table->integer('erfagh_nomre')->nullable()->default('1');
            $table->string('erfagh_desc')->nullable();

            $table->tinyInteger('soal_last')->default('1');
            $table->tinyInteger('gozaresh_last')->default('0');
            $table->tinyInteger('taklif_last')->default('1');
            $table->integer('max_soal')->default('3')->nullable();
            $table->integer('min_soal')->default('3')->nullable();
            $table->integer('max_taklif')->nullable();
            $table->integer('max_seminar')->default('4')->nullable();
            $table->integer('max_gozaresh')->default('4')->nullable();
            $table->integer('max_gheibat')->default('3')->nullable();

            $table->integer('min_w_khod')->default('3')->nullable();
            $table->integer('q_num')->default('10')->nullable();
            $table->integer('sath_khod')->default('1')->nullable();
            $table->integer('show_khod')->default('1')->nullable();
            $table->integer('quiz_num')->default('1')->nullable();
            $table->integer('sath_quiz')->default('1')->nullable();
            $table->integer('natije')->default('1')->nullable();
            $table->integer('show_quiz')->default('1')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
