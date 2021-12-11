<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListaPresencasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lista_presencas', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('nucleo_id');
            $table->unsignedBigInteger('professor_id');
            $table->date('date');

            $table->foreign('nucleo_id')->references('id')->on('nucleos')->onDelete('cascade');
            $table->foreign('professor_id')->references('id')->on('professores')->onDelete('cascade');

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
      $table->dropForeign(['lista_presencas_nucleo_id_foreign', 'lista_presencas_professor_id_foreign']);
      Schema::dropIfExists('lista_presencas');
    }
}
