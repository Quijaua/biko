<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsRamoAtuacaoAndRamoAtuacaoOutrosInCoordenadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coordenadores', function (Blueprint $table) {
          $table->string('RamoAtuacao', 255)->after('Empresa')->nullable();
          $table->string('RamoAtuacaoOutros', 255)->after('RamoAtuacao')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coordenadores', function (Blueprint $table) {
          $table->dropColumn(['RamoAtuacao', 'RamoAtuacaoOutros']);
        });
    }
}
