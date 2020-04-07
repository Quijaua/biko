<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Mensagens extends Model
{

    protected $fillable = [
        'remetente',
        'nucleos',
        'mensagem',
    ];

    protected $casts = [
        'remetente' => 'array',
        'nucleos' => 'array'
    ];

    public static function create(array $attributes = [])
    {
        $attributes['remetente'] = [
            'id' => Auth::user()->id,
            'role' => Auth::user()->role
        ];
        return parent::query()->create($attributes);
    }

}
