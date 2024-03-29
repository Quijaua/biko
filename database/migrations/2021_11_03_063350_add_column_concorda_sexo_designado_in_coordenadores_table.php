<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnConcordaSexoDesignadoInCoordenadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coordenadores', function (Blueprint $table) {
          $table->integer('concordaSexoDesignado')->after('Genero')->nullable();
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
          $table->dropColumn('concordaSexoDesignado');
        });
    }
}
