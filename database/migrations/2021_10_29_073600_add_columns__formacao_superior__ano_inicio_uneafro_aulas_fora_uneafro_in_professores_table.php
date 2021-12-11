<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsFormacaoSuperiorAnoInicioUneafroAulasForaUneafroInProfessoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('professores', function (Blueprint $table) {
          $table->string('FormacaoSuperior')->after('Escolaridade')->nullable();
          $table->string('AnoInicioUneafro')->after('FormacaoSuperior')->nullable();
          $table->string('aulasForaUneafro')->after('AnoInicioUneafro')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('professores', function (Blueprint $table) {
          $table->DropColumn([
            'FormacaoSuperior',
            'AnoInicioUneafro',
            'aulasForaUneafro'
          ]);
        });
    }
}
