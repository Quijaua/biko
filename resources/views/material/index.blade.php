@extends('layouts.app')

@section('content')
<div class="container">
  <!-- PAGE HEADER -->
  <div class="row">
      <div class="col-12 text-center">
        <h1>@if( $user->role === 'professor' || $user->role === 'administrador' ) ENVIO DE @endif MATERIAL</h1>
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

  @if( $user->role === 'professor' || $user->role === 'administrador' || $user->role === 'coordenador' )
  <div class="row mt-4">
    <div class="col-12">
      <form action="{{ route('nucleo.material.create') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-12 col-md-6 mb-2">
            <input class="form-control" type="file" name="file" id="file" required>
          </div>
          @if( $user->role === 'administrador' )
          <div class="col mb-2">
            <select class="custom-select" name="nucleo_id">
              @foreach( $nucleos as $nucleo )
              <option value="{{ $nucleo->id }}">{{ $nucleo->NomeNucleo }}</option>
              @endforeach
            </select>
          </div>
          @else
          <input type="hidden" name="nucleo_id" value="{{ $nucleos->id }}">
          @endif
          <div class="col-12 col-md-6">
            <button class="btn btn-success" type="submit">Enviar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  @endif

  <div class="row">
    <div class="col mt-4">
      {{ $user->role }}
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Título</th>
            <th scope="col">Enviado por</th>
            <th scope="col">Núcleo</th>
            <th scope="col">Data de envio</th>
            <th scope="col">Status</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody>
          @foreach( $files as $file )
          <tr>
            <th>{{ $file->name }}</th>
            <th>{{ $file->user->name }}</th>
            <td>{{ $file->nucleo->NomeNucleo }}</td>
            <td>{{ $file->created_at->format('d/m/Y') }}</td>
            <td>@if( $file->status ) <span class="badge bg-success">disponível</span> @else <span class="badge bg-danger">indisponível</span> @endif</td>
            <td>
              @if( $user->role === 'professor' || $user->role === 'administrador' || $user->role === 'coordenador' )
                @if( $user->role === 'administrador' && $file->status || $user->id === $file->user_id )
                <a class="btn btn-sm btn-danger" href="{{ route('nucleo.material.delete', ['id' => $file->id]) }}">Excluir</a>
                @elseif( $user->role === 'administrador' && !$file->status )
                <a class="btn btn-sm btn-warning" href="{{ route('nucleo.material.restore', ['id' => $file->id]) }}">Restaurar</a>
                @endif
              @endif
              <a class="btn btn-sm btn-primary" href="{{ asset('uploads') . '/' . $file->name }}" target="_blank">Baixar</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

    </div>
  </div>

</div>
@endsection
