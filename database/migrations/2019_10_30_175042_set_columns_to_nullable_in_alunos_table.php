<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetColumnsToNullableInAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alunos', function (Blueprint $table) {
            $table->string('Foto')->nullable()->change();
            $table->string('CPF')->nullable()->change();
            $table->string('RG')->nullable()->change();
            $table->string('Raca')->nullable()->change();
            $table->string('Genero')->nullable()->change();
            $table->string('EstadoCivil')->nullable()->change();
            $table->string('Nascimento')->nullable()->change();
            $table->string('Endereco')->nullable()->change();
            $table->string('Numero')->nullable()->change();
            $table->string('Bairro')->nullable()->change();
            $table->string('CEP')->nullable()->change();
            $table->string('Cidade')->nullable()->change();
            $table->string('Estado')->nullable()->change();
            $table->string('NomeMae')->nullable()->change();
            $table->string('NomePai')->nullable()->change();
            $table->string('CEPFamilia')->nullable()->change();
            $table->string('EnderecoFamilia')->nullable()->change();
            $table->string('NumeroFamilia')->nullable()->change();
            $table->string('BairroFamilia')->nullable()->change();
            $table->string('CidadeFamilia')->nullable()->change();
            $table->string('EstadoFamilia')->nullable()->change();
            $table->string('AuxGoverno')->nullable()->change();
            $table->string('Vestibular')->nullable()->change();
            $table->string('OpcoesVestibular1')->nullable()->change();
            $table->string('OpcoesVestibular2')->nullable()->change();
            $table->string('VestibularOutraCidade')->nullable()->change();
            $table->string('ComoSoube')->nullable()->change();
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
            //
        });
    }
}
