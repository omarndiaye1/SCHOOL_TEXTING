<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('value');
            $table->unsignedBigInteger('eleves_id');
            $table->foreign('eleves_id')->references('id')->on('eleves')->onDelete('cascade');
            $table->unsignedBigInteger('evaluations_id');
            $table->foreign('evaluations_id')->references('id')->on('evaluations')->onDelete('cascade');
            $table->unsignedBigInteger('matieres_id');
            $table->foreign('matieres_id')->references('id')->on('matieres')->onDelete('cascade');
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
        Schema::dropIfExists('note');
    }
}
