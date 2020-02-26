<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AlunoInfoFamiliares;

class AlunoInfoFamiliaresController extends Controller
{
    public function index()
    {
      return 'INFORMAÇÕES FAMILIARES';
    }

    public function add(Request $request)
    {
      $infos = AlunoInfoFamiliares::create([
        'id_user' => $request->input('inputIdUser'),
        'GrauParentesco' => $request->input('inputGrauParentesco'),
        'Idade' => $request->input('inputIdade'),
        'EstadoCivil' => $request->input('inputEstadoCivil'),
        'Escolaridade' => $request->input('inputEscolaridade'),
        'Profissao' => $request->input('inputProfissao'),
        'Renda' => $request->input('inputRenda'),
        'id_aluno' => $request->input('inputIdAluno'),
      ]);

      return back()->with([
        'success' => 'DADOS SALVOS COM SUCESSO.',
      ]);
    }

    public function update(Request $request, $id)
    {
      $infos = AlunoInfoFamiliares::find($id);

      $infos->GrauParentesco = $request->input('inputGrauParentesco');
      $infos->Idade = $request->input('inputIdade');
      $infos->EstadoCivil = $request->input('inputEstadoCivil');
      $infos->Escolaridade = $request->input('inputEscolaridade');
      $infos->Profissao = $request->input('inputProfissao');
      $infos->Renda = $request->input('inputRenda');

      $infos->save();
    }
}
