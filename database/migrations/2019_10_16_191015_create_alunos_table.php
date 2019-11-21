<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('Status')->nullable();
            $table->string('NomeAluno')->nullable();
            $table->unsignedBigInteger('id_nucleo')->nullable();
            $table->foreign('id_nucleo')->references('id')->on('nucleos');
            $table->string('Foto')->nullable();
            $table->string('CPF')->unique()->nullable();
            $table->string('RG')->nullable();
            $table->string('Raca')->nullable();
            $table->string('Genero')->nullable();
            $table->string('EstadoCivil')->nullable();
            $table->string('Nascimento')->nullable();
            $table->string('CEP')->nullable();
            $table->string('Endereco')->nullable();
            $table->string('Numero')->nullable();
            $table->string('Bairro')->nullable();
            $table->string('Cidade')->nullable();
            $table->string('Estado')->nullable();
            $table->string('Complemento')->nullable();
            $table->string('FoneComercial')->nullable();
            $table->string('FoneResidencial')->nullable();
            $table->string('FoneCelular')->nullable();
            $table->string('Empresa')->nullable();
            $table->string('CEPEmpresa')->nullable();
            $table->string('EnderecoEmpresa')->nullable();
            $table->string('NumeroEmpresa')->nullable();
            $table->string('BairroEmpresa')->nullable();
            $table->string('CidadeEmpresa')->nullable();
            $table->string('EstadoEmpresa')->nullable();
            $table->string('ComplementoEmpresa')->nullable();
            $table->string('Cargo')->nullable();
            $table->string('HorarioFrom')->nullable();
            $table->string('HorarioTo')->nullable();
            $table->string('NomeMae')->nullable();
            $table->string('NomePai')->nullable();
            $table->string('CEPFamilia')->nullable();
            $table->string('EnderecoFamilia')->nullable();
            $table->string('NumeroFamilia')->nullable();
            $table->string('ComplementoFamilia')->nullable();
            $table->string('BairroFamilia')->nullable();
            $table->string('CidadeFamilia')->nullable();
            $table->string('EstadoFamilia')->nullable();
            $table->string('TelefoneFamilia')->nullable();
            $table->string('AuxGoverno')->nullable();
            $table->string('EnsFundamental')->nullable();
            $table->string('PorcentagemBolsa')->nullable();
            $table->string('EnsMedio')->nullable();
            $table->string('PorcentagemBolsaMedio')->nullable();
            $table->string('Vestibular')->nullable();
            $table->string('OpcoesVestibular1')->nullable();
            $table->string('OpcoesVestibular2')->nullable();
            $table->string('VestibularOutraCidade')->nullable();
            $table->string('ComoSoube')->nullable();
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
        Schema::dropIfExists('alunos');
    }
}
