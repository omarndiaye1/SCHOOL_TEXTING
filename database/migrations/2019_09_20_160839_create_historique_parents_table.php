<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoriqueParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historique_parents', function (Blueprint $table) {
            $table->unsignedBigInteger('message_id');
            $table->foreign('message_id')->references('id')->on('messages');
            $table->unsignedBigInteger('parent_id');
            $table->foreign('parent_id')->references('id')->on('parentes');
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
        Schema::dropIfExists('historique_parents');
    }
}
