@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
      <div class="col-12 text-center">
        <h1>LISTAS DE PRESENÇA</h1>
      </div>
      <div class="col-12 text-center">
        <h2>({{ $nucleo->NomeNucleo }})</h2>
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
<div class="container">
  <div class="row">
    <div class="col-12 col-md-4">
      <div class="mb-3">
        <a class="btn btn-success" href="{{ route('nucleo/presences/new') }}">Nova Lista</a>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col" id="presences_wrapper">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Data</th>
            <th scope="col">Núcleo</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody>
          @foreach($nucleo->listas_presenca as $lista)
          <tr>
            <td>{{ $lista->date->format('d/m/Y') }}</td>
            <td>{{ $nucleo->NomeNucleo }}</td>
            <td>
              <a class="btn btn-primary btn-sm btn-absent mb-2" href="{{ route('nucleo/presences/new') }}">Ver/Editar</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@stop
