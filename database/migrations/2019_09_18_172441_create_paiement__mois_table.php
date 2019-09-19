<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaiementMoisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiement__mois', function (Blueprint $table) {
            $table->unsignedBigInteger('paiement_id');
            $table->foreign('paiement_id')->references('id')->on('paiements')->onDelete('cascade');;
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
        Schema::dropIfExists('paiement_mois');
    }
}
