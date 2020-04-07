<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\Http\Requests\StoreMessageRequest;
use App\Mensagens;
use App\MensagensAluno;
use App\Models\ChecagemDocumentacao;
use App\Nucleo;
use Illuminate\Support\Facades\DB;

class MensagensController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('mensagens.index');
    }

    public function create()
    {
        $nucleos = Nucleo::whereStatus()->get();
        return view('mensagens.create', compact('nucleos'));
    }

    public function store(StoreMessageRequest $request)
    {
        DB::transaction(static function () use ($request) {
            $mensagem = Mensagens::create($request->all());
            $alunos = collect($request->alunos);
            $nucleos = collect($request->nucleos);

            if (collect($request->alunos)->isNotEmpty()) {
                return MensagensAluno::enviarParaAlunos($alunos, $mensagem);
            }

            return MensagensAluno::enviarParaNucleos($nucleos, $mensagem);
        });

        return redirect()->route('messages.index')->with('success', 'Mensagem enviada com sucesso');
    }

}
