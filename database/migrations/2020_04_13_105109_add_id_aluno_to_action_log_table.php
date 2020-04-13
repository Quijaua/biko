<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdAlunoToActionLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('action_log', function (Blueprint $table) {
          $table->unsignedBigInteger('aluno_id');
          $table->string('alunoNome');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('action_log', function (Blueprint $table) {
          $table->dropColumn('aluno_id');
          $table->dropColumn('alunoNome');
        });
    }
}
