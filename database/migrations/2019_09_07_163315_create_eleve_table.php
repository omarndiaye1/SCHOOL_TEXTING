<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEleveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eleves', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom');
            $table->string('prenom');
            $table->string('sexe');
            $table->string('datenaissance');
            $table->string('lieu');
            $table->string('tel')->nullable();
            $table->string('adresse')->nullable();
            $table->string('email')->unique();
            $table->string('ville')->nullable();
            $table->string('pays')->nullable();
            $table->longText('photo')->nullable();
            $table->unsignedBigInteger('parente_id');
            $table->foreign('parente_id')->references('id')->on('parentes');
            $table->unsignedBigInteger('classe_id');
            $table->foreign('classe_id')->references('id')->on('classes');
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
        Schema::dropIfExists('eleves');
    }
}
