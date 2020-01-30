<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordenadores extends Model
{
    protected $fillable = [
      'id_user',
      'Status',
      'NomeCoordenador',
      'NomeSocial',
      'id_nucleo',
      'FuncaoCoordenador',
      'AnoIngresso',
      'Foto',
      'CPF',
      'RG',
      'Raca',
      'Genero',
      'EstadoCivil',
      'Nascimento',
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
      'Cargo',
      'HorarioFrom',
      'HorarioTo',
      'ProjetosRealizados',
      'ProjetosNome',
      'ProjetosFuncao',
      'ComoSoube',
      'ComoSoubeOutros',
      'MotivoPrincipal',
      'RepresentanteCGU',
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

    public function nucleo()
    {
      return $this->belongsTo('App\Nucleo');
    }

    public function user()
    {
      return $this->hasOne('App\User');
    }
}
