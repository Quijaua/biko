<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $fillable = [
      'Status',
      'NomeAluno',
      'id_user',
      'id_nucleo',
      'Foto',
      'CPF',
      'RG',
      'Email',
      'Raca',
      'Genero',
      'EstadoCivil',
      'Nascimento',
      'CEP',
      'Endereco',
      'Numero',
      'Bairro',
      'Cidade',
      'Estado',
      'Complemento',
      'FoneComercial',
      'FoneResidencial',
      'FoneCelular',
      'Empresa',
      'CEPEmpresa',
      'EnderecoEmpresa',
      'NumeroEmpresa',
      'BairroEmpresa',
      'CidadeEmpresa',
      'EstadoEmpresa',
      'ComplementoEmpresa',
      'Cargo',
      'HorarioFrom',
      'HorarioTo',
      'NomeMae',
      'NomePai',
      'CEPFamilia',
      'EnderecoFamilia',
      'NumeroFamilia',
      'ComplementoFamilia',
      'BairroFamilia',
      'CidadeFamilia',
      'EstadoFamilia',
      'TelefoneFamilia',
      'AuxGoverno',
      'AuxTipo',
      'EnsFundamental',
      'PorcentagemBolsa',
      'EnsMedio',
      'PorcentagemBolsaMedio',
      'Vestibular',
      'FaculdadeTipo',
      'NomeFaculdade',
      'CursoFaculdade',
      'AnoFaculdade',
      'OpcoesVestibular1',
      'OpcoesVestibular2',
      'VestibularOutraCidade',
      'ComoSoube',
      'ComoSoubeOutros',
    ];

    public function nucleo()
    {
      return $this->belongsTo('App\Nucleo');
    }

    public function user()
    {
      return $this->hasOne('App\User');
    }

    public function familiares()
    {
      return $this->hasMany('App\AlunoInfoFamiliares','id_user');
    }
}
