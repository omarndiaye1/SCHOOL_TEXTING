<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtablissementAdresseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

            Schema::create('etablissement_adresses', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('libelle');
                $table->string('ville');
                $table->string('pays');
                $table->unsignedBigInteger('etablissement_id');
                $table->foreign('etablissement_id')->references('id')->on('etablissements')->onDelete('cascade');
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
        Schema::dropIfExists('etablissement_adresse');
    }
}
