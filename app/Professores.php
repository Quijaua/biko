<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professores extends Model
{
    protected $fillable = [
      'id_user',
      'Status',
      'NomeProfessor',
      'id_nucleo',
      'Foto',
      'CPF',
      'RG',
      'Raca',
      'Genero',
      'EstadoCivil',
      'Nascimento',
      'Disciplinas',
      'OutrosNucleos',
      'DiasHorarios',
      'GastoTransporte',
      'TempoChegada',
      'Endereco',
      'Numero',
      'Bairro',
      'CEP',
      'Cidade',
      'Estado',
      'Complemento',
      'FoneComercial',
      'FoneResidencial',
      'FoneCelular',
      'Email',
      'Empresa',
      'EnderecoEmpresa',
      'NumeroEmpresa',
      'ComplementoEmpresa',
      'BairroEmpresa',
      'CidadeEmpresa',
      'EstadoEmpresa',
      'CEPEmpresa',
      'ProjetosRealizados',
      'ProjetosNome',
      'ProjetosFuncao',
      'ComoSoube',
      'ComoSoubeOutros',
      'MotivoPrincipal',
      'EnsinoSuperior',
      'InstituicaoSuperior',
      'CursoSuperior1',
      'AnoCursoSuperior1',
      'CursoSuperior2',
      'AnoCursoSuperior2',
      'Especializacao',
      'InstEspecializacao',
      'CursoEspecializacao',
      'AnoCursoEspecializacao',
      'Mestrado',
      'InstMestrado',
      'CursoMestrado',
      'AnoCursoMestrado',
    ];

    protected $casts = [
      'Disciplinas' => 'array',
    ];

    public function nucleo()
    {
      return $this->belongTo('App\Nucleo');
    }

    public function user()
    {
      return $this->hasOne('App\User');
    }
}
