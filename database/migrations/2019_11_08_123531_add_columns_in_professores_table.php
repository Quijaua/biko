<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInProfessoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('professores', function (Blueprint $table) {
          $table->longText('DiasHorarios')->nullable();
          $table->string('GastoTransporte')->nullable();
          $table->string('TempoChegada')->nullable();
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
            $table->dropColumn('DiasHorarios');
            $table->dropColumn('GastoTransporte');
            $table->dropColumn('TempoChegada');
        });
    }
}
