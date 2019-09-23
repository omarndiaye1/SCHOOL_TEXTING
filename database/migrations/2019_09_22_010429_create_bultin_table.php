<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBultinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bultins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cc');
            $table->integer('compo');
            $table->integer('moy');
            $table->integer('rang');
            $table->integer('Nbpoint');
            $table->integer('ccclass');
            $table->integer('compoclass');
            $table->integer('moyclass');
            $table->integer('Nbpointclass');
            $table->unsignedBigInteger('eleve_id');
            $table->foreign('eleve_id')->references('id')->on('eleves');
            $table->unsignedBigInteger('semestre_id');
            $table->foreign('semestre_id')->references('id')->on('semestres')->onDelete('cascade');
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
        Schema::dropIfExists('bultin');
    }
}
