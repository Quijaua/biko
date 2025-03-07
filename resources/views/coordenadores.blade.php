@extends('layouts.app')

@section('content')
<div class="container">
  <!-- PAGE HEADER -->
  <div class="row">
      <div class="col-12 text-center">
        <h1>CADASTRO DE COORDENADORES</h1>
      </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-6 m-auto">
        <form action="/coordenadores/search" method="POST" role="search">
        @csrf
        @if($user->role != 'aluno' && $user->role != 'professor')
        <div class="input-group">
            <input type="text" class="form-control" name="inputQuery"
                placeholder="Buscar por nome ou sobrenome do coordenador" required> <span class="input-group-btn">
                <button type="submit" class="btn-link text-decorate-none">
                    <i class="fas fa-search"></i>
                </button>
            </span>
        </div>
        @endif
        </form>
      </div>
    </div>
  </div>
  @if(\Session::has('success'))
  <div class="row mt-2">
    <div class="col-6 m-auto">
      <div class="alert alert-success text-center" role="alert">
        {!! \Session::get('success') !!}
      </div>
    </div>
  </div>
  @endif
  @if(\Session::has('error'))
  <div class="row mt-2">
    <div class="col-6 m-auto">
      <div class="alert alert-danger text-center" role="alert">
        {!! \Session::get('error') !!}
      </div>
    </div>
  </div>
  @endif
  @if($coordenadores->isEmpty())
  @if($user->role != 'aluno' && $user->role != 'professor' && $user->role != 'coordenador')
  <div class="col mt-4 text-center">
    <a class="btn btn-success" href="/coordenadores/add">Adicionar novo coordenador</a>
  </div>
  @endif
  <p>Nenhum registro encontrado.</p>
  @else
  @foreach($coordenadores as $coordenador)
  @endforeach
  @if($user->role != 'aluno' && $user->role != 'professor' && $user->role != 'coordenador')
  <div class="col mt-4 text-center">
    <a class="btn btn-success" href="/coordenadores/add">Adicionar novo coordenador</a>
    @if($coordenador->Status === 1)
    <a class="btn btn-danger" href="/coordenadores/search/?status=0">Ver coordenadores inativos</a>
    @else
    <a class="btn btn-primary" href="/coordenadores/search/?status=1">Ver coordenadores ativos</a>
    @endif
    @if( $user->role === 'administrador' )
    <a class="btn btn-primary" href="{{ route('coordenadores/export/') }}/?nucleo=0">Exportar</a>
    @endif
  </div>
  @endif
  @endif
  @if($coordenadores->isEmpty())
  @else
  <div class="row">
    <div class="col mt-4">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Foto</th>
            <th scope="col">Nome</th>
            <th scope="col">Núcleo</th>
            <th scope="col">Situação</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody>
          @foreach($coordenadores as $coordenador)
          <tr>
            @if($coordenador->Foto)
            <td><img class="rounded-circle avatar" src="{{ asset('storage') }}/{{ $coordenador->Foto }}" alt="{{ $coordenador->Foto }}" width="25%"></td>
            @else
            <td><img class="rounded-circle avatar" src="{{ asset('images') }}/user.png" alt="Avatar" width="25%"></td>
            @endif


            @if($coordenador->NomeSocial === null)
            <td>{{ $coordenador->NomeCoordenador }}</td>
            @else
            <td>{{ $coordenador->NomeSocial }}</td>
            @endif
            @php $nomeNucleo = \App\Nucleo::where('id', $coordenador->id_nucleo)->get('NomeNucleo'); @endphp
            @if($nomeNucleo->isEmpty())
            <td></td>
            @else
            <td>{{ $nomeNucleo[0]['NomeNucleo'] }}</td>
            @endif
            <td>
              @if($coordenador->Status === 1)
              <span class="badge bg-success text-white p-2">ATIVO</span>
              @else
              <span class="badge bg-danger  text-white p-2">INATIVO</span>
              @endif
            </td>
            <td>
              <a class="btn btn-info text-light" href="/coordenadores/details/{{ $coordenador->id }}">Detalhes</a>
              <a class="btn btn-primary" href="/coordenadores/edit/{{ $coordenador->id }}">Editar</a>
              @if($coordenador->Status === 1)
              <a class="btn btn-danger disableBtn" href="/coordenadores/disable/{{ $coordenador->id }}">Inativar</a>
              @else
              <a class="btn btn-success enableBtn" href="/coordenadores/enable/{{ $coordenador->id }}">Ativar</a>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  @endif
  <div class="row">
    <div class="col">
      {{ $coordenadores->links() }}
    </div>
  </div>
</div>
@endsection
