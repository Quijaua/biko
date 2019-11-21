<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfessoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('Status')->nullable();
            $table->string('NomeProfessor');
            $table->unsignedBigInteger('id_nucleo');
            $table->foreign('id_nucleo')->references('id')->on('nucleos');
            $table->string('Foto')->nullable();
            $table->string('CPF')->unique()->nullable();
            $table->string('RG')->nullable();
            $table->string('Raca')->nullable();
            $table->string('Genero')->nullable();
            $table->string('EstadoCivil')->nullable();
            $table->string('Nascimento')->nullable();
            $table->string('Endereco')->nullable();
            $table->string('Numero')->nullable();
            $table->string('Bairro')->nullable();
            $table->string('CEP')->nullable();
            $table->string('Cidade')->nullable();
            $table->string('Estado')->nullable();
            $table->string('Complemento')->nullable();
            $table->string('FoneComercial')->nullable();
            $table->string('FoneResidencial')->nullable();
            $table->string('FoneCelular')->nullable();
            $table->string('Email')->unique();
            $table->string('Empresa')->nullable();
            $table->string('CEPEmpresa')->nullable();
            $table->string('EnderecoEmpresa')->nullable();
            $table->string('NumeroEmpresa')->nullable();
            $table->string('ComplementoEmpresa')->nullable();
            $table->string('BairroEmpresa')->nullable();
            $table->string('CidadeEmpresa')->nullable();
            $table->string('EstadoEmpresa')->nullable();
            $table->string('ProjetosRealizados')->nullable();
            $table->string('ComoSoube')->nullable();
            $table->string('MotivoPrincipal')->nullable();
            $table->string('EnsinoSuperior')->nullable();
            $table->string('InstituicaoSuperior')->nullable();
            $table->string('CursoSuperior1')->nullable();
            $table->string('AnoCursoSuperior1')->nullable();
            $table->string('CursoSuperior2')->nullable();
            $table->string('AnoCursoSuperior2')->nullable();
            $table->string('Especializacao')->nullable();
            $table->string('InstEspecializacao')->nullable();
            $table->string('CursoEspecializacao')->nullable();
            $table->string('AnoCursoEspecializacao')->nullable();
            $table->string('Mestrado')->nullable();
            $table->string('InstMestrado')->nullable();
            $table->string('CursoMestrado')->nullable();
            $table->string('AnoCursoMestrado')->nullable();
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
        Schema::dropIfExists('professores');
    }
}
