<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaiementScolariteMoisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiement__scolarite__mois', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('paiementscolarite_id');
            $table->foreign('paiementscolarite_id')->references('id')->on('paiement__scolarites')->onDelete('cascade');;
            $table->unsignedBigInteger('mois_id');
            $table->foreign('mois_id')->references('id')->on('mois')->onDelete('cascade');;
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
        Schema::dropIfExists('paiement__scolarite_mois');
    }
}
