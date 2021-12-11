<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HorarioAula extends Model
{
  protected $fillable = [
    'professor_id',
    'nucleo_id',
    'DiaSemana',
    'De',
    'Ate'
  ];

  public function professor()
  {
    return $this->belongsTo('App\Professores');
  }
}
