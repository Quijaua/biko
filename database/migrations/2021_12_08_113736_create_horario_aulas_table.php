<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorarioAulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horario_aulas', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('professor_id');
            $table->unsignedBigInteger('nucleo_id');
            $table->string('DiaSemana', 255);
            $table->string('De', 255)->nullable();
            $table->string('Ate', 255)->nullable();

            $table->foreign('professor_id')->references('id')->on('professores')->onDelete('cascade');
            $table->foreign('nucleo_id')->references('id')->on('nucleos')->onDelete('cascade');

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
        Schema::dropIfExists('horario_aulas');
        $table->dropForeign(['horario_aulas_professor_id_foreign', 'horario_aulas_nucleo_id_foreign']);
    }
}
