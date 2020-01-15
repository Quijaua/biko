@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Seu pré-cadastro foi realizado com sucesso!') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Um novo link de verificação foi enviado para o seu endereço de e-mail.') }}
                        </div>
                    @endif

                    <p>{{ __('A Coordenação do Núcleo que você escolheu entrará em contato em breve.') }}</p>
                    <p>{{ __('Enquanto isso, enviamos uma mensagem para o seu e-mail, acesse sua caixa de entrada, confirme seu e-mail clicando no link indicado na mensagem e complete seu cadastro.') }}</p>
                    {{ __('Se você não recebeu o email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('clique aqui para solicitar outra') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
