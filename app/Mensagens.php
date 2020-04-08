<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class Mensagens extends Model
{

    protected $fillable = [
        'remetente',
        'titulo',
        'nucleos',
        'mensagem',
    ];

    protected $casts = [
        'remetente' => 'array',
        'nucleos' => 'array'
    ];

    public function mensagensAluno(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(MensagensAluno::class, 'mensagens_id');
    }

    public static function create(array $attributes = [])
    {
        $attributes['remetente'] = [
            'id' => Auth::user()->id,
            'role' => Auth::user()->role,
            'email' => Auth::user()->email,
            'name' => Auth::user()->name
        ];
        return parent::query()->create($attributes);
    }

    public function marcarComoLida()
    {
        $mensagemAluno = $this->mensagensAluno->where('aluno_id', Auth::user()->id)->first();
        if ($mensagemAluno->is_visualizado === false) {
            $mensagemAluno->update([
                'visualizado_at' => Date::now(),
            ]);
        }
    }

}
