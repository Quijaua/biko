<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNucleosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nucleos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('Status')->nullable();
            $table->string('NomeNucleo')->nullable();
            $table->string('AreaAtuacao')->nullable();
            $table->string('EspacoInserido')->nullable();
            $table->string('Endereco')->nullable();
            $table->string('Numero')->nullable();
            $table->string('Bairro')->nullable();
            $table->string('Complemento')->nullable();
            $table->string('Cidade')->nullable();
            $table->string('Estado')->nullable();
            $table->string('CEP')->nullable();
            $table->string('Telefone')->nullable();
            $table->string('Email')->nullable();
            $table->string('Fundacao')->nullable();
            $table->string('Facebook')->nullable();
            $table->string('Voluntarios')->nullable();
            $table->string('TaxaInscricao')->nullable();
            $table->string('InscricaoFrom')->nullable();
            $table->string('InscricaoTo')->nullable();
            $table->string('InicioAtividades')->nullable();
            $table->string('Representantes1')->nullable();
            $table->string('Representantes2')->nullable();
            $table->string('Coordenador')->nullable();
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
        Schema::dropIfExists('nucleos');
    }
}
