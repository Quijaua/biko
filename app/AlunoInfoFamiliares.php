<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlunoInfoFamiliares extends Model
{
    protected $fillable = [
      'id_user',
      'GrauParentesco',
      'Idade',
      'EstadoCivil',
      'Escolaridade',
      'Profissao',
      'Renda',
      'id_aluno',
    ];

    protected $casts = [
      'GrauParentesco' => 'collection',
      'Idade' => 'collection',
      'EstadoCivil' => 'collection',
      'Escolaridade' => 'collection',
      'Profissao' => 'collection',
      'Renda' => 'collection',
    ];

    public function aluno()
    {
      return $this->belongTo('App\Aluno');
    }
}
