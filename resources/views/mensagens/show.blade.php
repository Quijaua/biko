@extends('mensagens._mensagens')

@section('content_message')
    <div class="card">
        <div class="card-header">{{ $mensagem->titulo }}</div>

        <div class="card-body">
            <p><strong>Enviado por:</strong> {{ $mensagem->remetente['name'] }}</p>
            <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($mensagem->created_at)->format('d/m/Y h:i') }}</p>
            <hr />

            <div class="clearfix">
                {!! $mensagem->mensagem !!}
            </div>

            <a class="btn btn-danger float-right" href="{{ url()->previous() }}">Voltar</a>
        </div>
    </div>
@endsection