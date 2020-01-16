<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nucleo extends Model
{
    protected $fillable = [
      'Status',
      'NomeNucleo',
      'AreaAtuacao',
      'InfoInscricao',
      'EspacoInserido',
      'Endereco',
      'Numero',
      'Bairro',
      'Complemento',
      'Cidade',
      'Estado',
      'CEP',
      'Telefone',
      'Email',
      'Fundacao',
      'Facebook',
      'TaxaInscricao',
      'TaxaInscricaoValor',
      'Vagas',
      'InscricaoFrom',
      'InscricaoTo',
      'InicioAtividades',
      'whatsapp_url',
    ];

    public function alunos()
    {
      return $this->hasMany('App\Aluno', 'id_nucleo');
    }

    public function professores()
    {
      return $this->hasMany('App\Professores', 'id_nucleo');
    }

    public function coordenadores()
    {
      return $this->hasMany('App\Coordenadores', 'id_nucleo');
    }
}
