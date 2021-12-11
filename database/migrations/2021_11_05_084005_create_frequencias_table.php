<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrequenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frequencias', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('lista_presenca_id');
            $table->unsignedBigInteger('aluno_id');
            $table->integer('is_present');

            $table->foreign('lista_presenca_id')->references('id')->on('lista_presencas')->onDelete('cascade');
            $table->foreign('aluno_id')->references('id')->on('alunos')->onDelete('cascade');

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
        Schema::dropIfExists('frequencias');
        $table->dropForeign(['frequencias_lista_presenca_id_foreign', 'frequencias_aluno_id_foreign']);
    }
}
