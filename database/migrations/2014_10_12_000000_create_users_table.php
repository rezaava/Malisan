<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('family')->nullable();
            $table->tinyInteger('gender')->nullable()->comment('0 female  1 male');
            $table->string('email')->unique()->nullable();
            $table->string('national')->unique()->nullable();
            $table->string('shenasname')->nullable();
            $table->string('personal')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('city_birth')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('postal')->nullable();
            $table->string('tel')->nullable();
            $table->string('mobile')->nullable();
            $table->string('tel_work')->nullable();
            $table->string('uni_email')->nullable();
            $table->string('web')->nullable();
            $table->string('scholar')->nullable();
            $table->string('social')->nullable();
            $table->string('degree')->nullable();
            $table->string('field')->nullable()->comment('reshte');
            $table->string('trend')->nullable()->comment('gerayesh');
            $table->string('trend_en')->nullable()->comment('gerayesh');
            $table->string('research')->nullable()->comment('pajohesh');
            $table->string('image')->nullable();
            $table->string('shaba')->nullable();
            $table->string('turn')->nullable()->comment('dore');
            $table->string('password');
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
        Schema::dropIfExists('users');
    }
}
