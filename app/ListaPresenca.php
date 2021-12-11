<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListaPresenca extends Model
{
  protected $fillable = [
    'nucleo_id',
    'professor_id',
    'date'
  ];

  protected $casts = [
    'date' => 'date'
  ];

  public function nucleo()
  {
    return $this->belongsTo('App\Nucleo');
  }

  public function frequencias()
  {
    return $this->hasMany('App\Frequencia');
  }
}
