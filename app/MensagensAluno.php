<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Date;

class MensagensAluno extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'mensagem_id',
        'aluno_id',
        'visualizado_at',
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class, 'aluno_id');
    }

    public function mensagem()
    {
        return $this->belongsTo(Mensagens::class, 'mensagem_id');
    }

    public static function enviarParaNucleos(Collection $nucleos, $mensagem)
    {
        $nucleos = $nucleos->isNotEmpty() ? Nucleo::query()->whereIn('id', $nucleos)->get() : Nucleo::query()->get();
        $mensagens = $nucleos->map(function (Nucleo $nucleo) use ($mensagem) {
            return $nucleo->alunos->map(function (Aluno $aluno) use ($mensagem) {
                return self::convert($mensagem->id, $aluno->id);
            });
        })->collapse();

        return self::query()->insert($mensagens->toArray());
    }

    public static function enviarParaAlunos(Collection $alunos, $mensagem)
    {
        $alunos = Aluno::whereIn('id', $alunos->toArray())->get();
        $mensagens = $alunos->map(function (Aluno $aluno) use ($mensagem) {
            return self::convert($mensagem->id, $aluno->id);
        })->collapse();

        return self::query()->insert($mensagens->toArray());
    }

    private static function convert($mensagemId, $alunoId)
    {
        return [
            'mensagem_id' => $mensagemId,
            'aluno_id' => $alunoId,
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ];
    }

}
