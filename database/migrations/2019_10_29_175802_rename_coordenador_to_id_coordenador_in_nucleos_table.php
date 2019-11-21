<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameCoordenadorToIdCoordenadorInNucleosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nucleos', function (Blueprint $table) {
            $table->renameColumn('Coordenador', 'id_representanteCGU');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nucleos', function (Blueprint $table) {
            $table->renameColumn('id_representanteCGU', 'Coordenador');
        });
    }
}
