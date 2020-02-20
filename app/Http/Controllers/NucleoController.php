<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Nucleo;
use Session;

class NucleoController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
      $user = Auth::user();
      Session::put('verified', $user->email_verified_at);

      if($user->role === 'aluno'){
        return back();
      }

      if($user->role === 'professor'){
        $nucleos = Nucleo::get();

        return view('nucleos')->with([
          'nucleos' => $nucleos,
          'user' => $user,
        ]);
      }

      if($user->role === 'coordenador'){
        $nucleos = Nucleo::get();
        $myNucleo = $user->coordenador->id_nucleo;
        //dd($myNucleo);

        return view('nucleos')->with([
          'myNucleo' => $myNucleo,
          'user' => $user,
          'nucleos' => $nucleos,
        ]);
      }

      if($user->role === 'administrador'){
        $user = Auth::user();
        $nucleos = Nucleo::where('Status', 1)->get();

        return view('nucleos')->with([
          'user' => $user,
          'nucleos' => $nucleos,
        ]);
      }
    }

    public function showForm()
    {
      return view('nucleosCreate');
    }

    public function edit($id)
    {
      $dados = Nucleo::find($id);
      $representantes = $dados->coordenadores()->where('id_nucleo', $id)->where('RepresentanteCGU', 'sim')->get('NomeCoordenador');

      return view('nucleosEdit')->with([
        'dados' => $dados,
        'representantes' => $representantes,
      ]);
    }

    public function create(Request $request)
    {

      Nucleo::create([
        'Status' => $request->input('inputStatus'),
        'NomeNucleo' => $request->input('inputNomeNucleo'),
        'AreaAtuacao' =>$request->input('inputAreaAtuacao'),
        'InfoInscricao' => $request->input('inputInfoInscricao'),
        'EspacoInserido' => $request->input('inputEspacoInserido'),
        'Endereco' => $request->input('inputEndereco'),
        'Numero' => $request->input('inputNumero'),
        'Bairro' => $request->input('inputBairro'),
        'Complemento' => $request->input('inputComplemento'),
        'Cidade' => $request->input('inputCidade'),
        'Estado' => $request->input('inputEstado'),
        'CEP' => $request->input('inputCEP'),
        'Telefone' => $request->input('inputTelefone'),
        'Email' => $request->input('inputEmail'),
        'Fundacao' => $request->input('inputFundacao'),
        'Facebook' => $request->input('inputFacebook'),
        'TaxaInscricao' => $request->input('inputTaxaInscricao'),
        'TaxaInscricaoValor' => $request->input('inputTaxaInscricaoValor'),
        'Vagas' => $request->input('inputVagas'),
        'InscricaoFrom' => $request->input('inputInscricaoFrom'),
        'InscricaoTo' => $request->input('inputInscricaoTo'),
        'InicioAtividades' => $request->input('inputInicioAtividades'),
        'Status' => $request->input('inputStatus'),
        'whatsapp_url' => $request->input('inputWhatsapp'),
        'Regiao' => $request->input('inputRegiao'),
      ]);

      return back()->with('success', 'DADOS SALVOS COM SUCESSO.');
    }

    public function update(Request $request, $id)
    {
      $nucleo = Nucleo::find($id);
      $nucleo->NomeNucleo = $request->input('inputNomeNucleo');
      $nucleo->AreaAtuacao = $request->input('inputAreaAtuacao');
      $nucleo->InfoInscricao = $request->input('inputInfoInscricao');
      $nucleo->EspacoInserido = $request->input('inputEspacoInserido');
      $nucleo->Endereco = $request->input('inputEndereco');
      $nucleo->Numero = $request->input('inputNumero');
      $nucleo->Bairro = $request->input('inputBairro');
      $nucleo->Complemento = $request->input('inputComplemento');
      $nucleo->Cidade = $request->input('inputCidade');
      $nucleo->Estado = $request->input('inputEstado');
      $nucleo->CEP = $request->input('inputCEP');
      $nucleo->Telefone = $request->input('inputTelefone');
      $nucleo->Email = $request->input('inputEmail');
      $nucleo->Fundacao = $request->input('inputFundacao');
      $nucleo->Facebook = $request->input('inputFacebook');
      $nucleo->TaxaInscricao = $request->input('inputTaxaInscricao');
      $nucleo->TaxaInscricaoValor = $request->input('inputTaxaInscricaoValor');
      $nucleo->Vagas = $request->input('inputVagas');
      $nucleo->InscricaoFrom = $request->input('inputInscricaoFrom');
      $nucleo->InscricaoTo = $request->input('inputInscricaoTo');
      $nucleo->InicioAtividades = $request->input('inputInicioAtividades');
      $nucleo->whatsapp_url = $request->input('inputWhatsapp');
      $nucleo->Regiao = $request->input('inputRegiao');

      $nucleo->save();

      return back()->with([
        'success' => 'DADOS SALVOS COM SUCESSO.',
      ]);
    }

    public function disable(Request $request, $id)
    {
      $nucleo = Nucleo::find($id);
      $nucleo->Status = 0;

      $nucleo->save();

      return back()->with('success', 'Núcleo inativado com sucesso.');
    }

    public function enable(Request $request, $id)
    {
      $nucleo = Nucleo::find($id);
      $nucleo->Status = 1;

      $nucleo->save();

      return back()->with('success', 'Núcleo ativado com sucesso.');
    }

    public function search(Request $request)
    {
      $user = Auth::user();
      $status = $request->input('status');
      if($status != ''){
        $result = Nucleo::where('Status', 0)->get();
        if($result->isEmpty()){
          return redirect('nucleos')->with([
            'error' => 'Não há núcleos inativos no momento.',
          ]);
        }

        return view('nucleos')->with([
          'user' => $user,
          'nucleos' => $result,
        ]);
      }

      $query = $request->input('inputQuery');
      $results = Nucleo::where('NomeNucleo','LIKE','%'.$query.'%')->get();

      if($results->isEmpty()){
        return back()->with('error', 'Nenhum resultado encontrado.');
      }else{
        return view('nucleos')->with('nucleos', $results);
      }
    }

    public function details($id)
    {
      $dados = Nucleo::find($id);
      $representantes = $dados->coordenadores()->where('id_nucleo', $id)->where('RepresentanteCGU', 'sim')->get('NomeCoordenador');
      $disciplinas = $dados->professores()->where('id_nucleo', $id)->where('Status', 1)->get('Disciplinas');

      if($disciplinas->isEmpty()){
        $disciplinas[] = null;
      }

      return view('nucleosDetails')->with([
        'dados' => $dados,
        'representantes' => $representantes,
        'disciplinas' => $disciplinas,
      ]);
    }
}
