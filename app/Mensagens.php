<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class Mensagens extends Model
{

    protected $fillable = [
        'remetente_id',
        'titulo',
        'nucleos',
        'mensagem',
    ];

    protected $casts = [
        'nucleos' => 'array'
    ];

    public function mensagensAluno()
    {
        return $this->hasMany(MensagensAluno::class, 'mensagens_id');
    }

    public function remetente()
    {
        return $this->belongsTo(User::class, 'remetente_id');
    }

    public static function create(array $attributes = [])
    {
        $attributes['remetente_id'] = Auth::user()->id;
        return parent::query()->create($attributes);
    }

    public function marcarComoLida()
    {
        try {
            $mensagemAluno = $this->mensagensAluno()->where('aluno_id', Auth::user()->id)->firstOrFail();
            if ($mensagemAluno->is_visualizado === false) {
                $mensagemAluno->update([
                    'visualizado_at' => Date::now(),
                ]);
            }
        } catch (\Exception $e) {}
    }

}
