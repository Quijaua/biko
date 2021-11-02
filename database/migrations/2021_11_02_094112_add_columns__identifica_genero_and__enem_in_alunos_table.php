<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsIdentificaGeneroAndEnemInAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alunos', function (Blueprint $table) {
          $table->integer('IdentificaGenero')->after('Genero')->nullable();
          $table->integer('Enem')->after('PorcentagemBolsaMedio')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alunos', function (Blueprint $table) {
          $table->dropColumn(['IdentificaGenero', 'Enem']);
        });
    }
}
