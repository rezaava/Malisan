<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoringsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scorings', function (Blueprint $table) {
            $table->id();
            $table->integer('couurse_id');
            $table->string('q_1')->default('1');
            $table->string('q_2')->default('0.5');
            $table->string('q_3')->default('0.25');
            $table->string('q_4')->default('-0.25');

            $table->string('d_1')->default('1');
            $table->string('d_2')->default('0.8');
            $table->string('d_3')->default('0.65');
            $table->string('d_4')->default('-0.25');

            $table->string('e_1')->default('1');
            $table->string('e_2')->default('0.8');
            $table->string('e_3')->default('0.65');
            $table->string('e_4')->default('-0.15');

            $table->string('s_1')->default('1');
            $table->string('s_2')->default('0.8');
            $table->string('s_3')->default('0.65');
            $table->string('s_4')->default('-0.15');

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
        Schema::dropIfExists('scorings');
    }
}
