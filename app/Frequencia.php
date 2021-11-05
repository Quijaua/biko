<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frequencia extends Model
{
  protected $fillable = [
    'lista_presenca_id',
    'aluno_id',
    'is_present'
  ];

  protected $casts = [
    'created_at'
  ];

  public function lista()
  {
    return $this->belongsTo('App\ListaPresenca');
  }

  public function aluno()
  {
    return $this->belongsTo('App\Aluno');
  }
}
