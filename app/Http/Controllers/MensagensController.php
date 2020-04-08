<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Mensagens;
use App\MensagensAluno;
use App\Nucleo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MensagensController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $mensagensAluno = MensagensAluno::query()
            ->where('aluno_id', Auth::user()->id)
            ->paginate(15);

        return view('mensagens.index', compact('mensagensAluno'));
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

    public function show(Mensagens $mensagem)
    {
        $mensagem->marcarComoLida();
        return view('mensagens.show', compact('mensagem'));
    }

}
