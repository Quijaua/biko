<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMensagensAlunoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensagens_alunos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mensagem_id');
            $table->unsignedBigInteger('aluno_id');
            $table->dateTime('visualizado_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('mensagem_id')->references('id')->on('mensagens');
            $table->foreign('aluno_id')->references('id')->on('alunos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mensagens_aluno');
    }
}
