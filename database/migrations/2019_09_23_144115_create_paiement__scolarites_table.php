<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaiementScolaritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiement__scolarites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('montant');
            $table->integer('nombremois');
            $table->unsignedBigInteger('typepaiement_id');
            $table->foreign('typepaiement_id')->references('id')->on('typepaiement');
            $table->unsignedBigInteger('eleve_id');
            $table->foreign('eleve_id')->references('id')->on('eleves');
            $table->unsignedBigInteger('aneescholaires_id');
            $table->foreign('aneescholaires_id')->references('id')->on('aneescholaires');
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
        Schema::dropIfExists('paiement__scolarites');
    }
}
