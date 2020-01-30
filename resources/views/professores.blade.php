@extends('layouts.app')

@section('content')
<div class="container">
  <!-- PAGE HEADER -->
  <div class="row">
      <div class="col-12 text-center">
        <h1>CADASTRO DE PROFESSORES</h1>
      </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-6 m-auto">
        <form action="/professores/search" method="POST" role="search">
        @csrf
        @if($user->role != 'aluno' && $user->role != 'professor')
        <div class="input-group">
            <input type="text" class="form-control" name="inputQuery"
                placeholder="Buscar por nome ou sobrenome do professor" required> <span class="input-group-btn">
                <button type="submit" class="btn btn-default">
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
  @if($professores->isEmpty())
  @if($user->role != 'aluno' && $user->role != 'professor')
  <div class="col mt-4 text-center">
    <a class="btn btn-success" href="/professores/add">Adicionar novo professor</a>
  </div>
  @endif
  @else
  @foreach($professores as $professor)
  @endforeach
  @if($user->role != 'aluno' && $user->role != 'professor')
  <div class="col mt-4 text-center">
    <a class="btn btn-success" href="/professores/add">Adicionar novo professor</a>
    @if($professor->Status === 1)
    <a class="btn btn-danger" href="/professores/search/?status=0">Ver professores inativos</a>
    @else
    <a class="btn btn-primary" href="/professores">Ver professores ativos</a>
    @endif
  </div>
  @endif
  @endif
  <div class="row">
    <div class="col mt-4">
      @if($professores->isEmpty())
      <p>Nenhum registro encontrado.</p>
      @else
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Foto</th>
            <th scope="col">Nome</th>
            <th scope="col">CPF</th>
            <th scope="col">Situação</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody>
          @foreach($professores as $professor)
          <tr>
            <td><img class="rounded-circle" src="{{ asset('storage') }}/{{ $professor->Foto }}" alt="{{ $professor->Foto }}" width="25%"></td>
            @if($professor->NomeSocial === null)
            <td>{{ $professor->NomeProfessor }}</td>
            @else
            <td>{{ $professor->NomeSocial }}</td>
            @endif
            <td>{{ $professor->CPF }}</td>
            <td>
              @if($professor->Status === 1)
              <span class="badge badge-success p-2">ATIVO</span>
              @else
              <span class="badge badge-danger p-2">INATIVO</span>
              @endif
            </td>
            <td>
              <a class="btn btn-info text-light" href="/professores/details/{{ $professor->id }}">Detalhes</a>
              <a class="btn btn-primary" href="/professores/edit/{{ $professor->id }}">Editar</a>
              @if($professor->Status === 1)
              <a class="btn btn-danger disableBtn" href="/professores/disable/{{ $professor->id }}">Inativar</a>
              @else
              <a class="btn btn-success enableBtn" href="/professores/enable/{{ $professor->id }}">Ativar</a>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @endif
    </div>
  </div>
</div>
@endsection
