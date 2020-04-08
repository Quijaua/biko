<?php

namespace App;

use App\Events\MessageCreated;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class MensagensAluno extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'mensagens_id',
        'aluno_id',
        'visualizado_at',
    ];

    protected $appends = [
        'is_visualizado',
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class, 'aluno_id');
    }

    public function mensagem()
    {
        return $this->belongsTo(Mensagens::class, 'mensagens_id');
    }

    public function getIsVisualizadoAttribute()
    {
        return $this->visualizado_at !== null;
    }

    public static function enviarParaNucleos(Collection $nucleos, $mensagem)
    {
        $nucleos = $nucleos->isNotEmpty() ? Nucleo::query()->whereIn('id', $nucleos)->get() : Nucleo::whereUserAtuacao()->get();
        $mensagens = $nucleos->map(function (Nucleo $nucleo) use ($mensagem) {
            return $nucleo->alunos->map(function (Aluno $aluno) use ($mensagem) {
                return self::convert($mensagem->id, $aluno->id);
            });
        })->collapse();

        return self::saveMany($mensagens->toArray());
    }

    public static function enviarParaAlunos(Collection $alunos, $mensagem)
    {
        $alunos = Aluno::query()->whereIn('id', $alunos->toArray())->get();
        $mensagens = $alunos->map(function (Aluno $aluno) use ($mensagem) {
            return self::convert($mensagem->id, $aluno->id);
        });

        return self::saveMany($mensagens->toArray());
    }

    private static function convert($mensagemId, $alunoId)
    {
        return [
            'mensagens_id' => $mensagemId,
            'aluno_id' => $alunoId,
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ];
    }

    public static function saveMany(array $values)
    {
        return DB::transaction(static function () use ($values) {
            return collect($values)->map(function ($value) {
                $message = self::query()->create($value);
                event(new MessageCreated($message));

                return $message;
            });
        });
    }

}
