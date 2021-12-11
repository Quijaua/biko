<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraColumnsInAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alunos', function (Blueprint $table) {
          $table->integer('concordaSexoDesignado')->after('Genero')->nullable();
          $table->string('responsavelCuidadoOutraPessoa')->after('concordaSexoDesignado')->nullable();
          $table->string('filhosIdade')->after('temFilhos')->nullable();
          $table->string('Escolaridade')->after('FoneCelular')->nullable();
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
          $table->dropColumn(['concordaSexoDesignado', 'responsavelCuidadoOutraPessoa', 'filhosIdade', 'Escolaridade']);
        });
    }
}
