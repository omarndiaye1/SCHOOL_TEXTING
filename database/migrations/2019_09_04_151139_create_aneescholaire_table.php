<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAneescholaireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aneescholaires', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('libelle');
            $table->date('datedep');
            $table->date('datefin');
            $table->boolean('etat');
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
        Schema::dropIfExists('aneescholaires');
    }
}
