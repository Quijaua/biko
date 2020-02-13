@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Pré-cadastro') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                <small id="nameHelp" class="form-text text-muted">Por favor, informe seu nome completo, da mesma forma em que consta em seu RG.</small>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Celular') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                                <small id="phoneHelp" class="form-text text-muted">Por favor, informe o número do seu celular, com DDD</small>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                <small id="emailHelp" class="form-text text-muted">Um e-mail válido. Todos os e-mails do sistema serão enviados para este endereço. O endereço de e-mail não será divulgado e será usado apenas se você solicitar uma nova senha ou notificações específicas por e-mail.</small>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-4 col-form-label text-md-right" for="inputNucleo">Núcleo</label>
                            <?php $nucleos = DB::table('nucleos')->where('status', 1)->orderBy('Regiao','asc')->get(); ?>
                            <div class="col-md-6">
                              <select name="inputNucleo" class="custom-select" required>
                                <option selected>Selecione</option>
                                @foreach($nucleos as $nucleo)
                                <option value="{{ $nucleo->id }}">{{ $nucleo->Regiao }} - {{ $nucleo->NomeNucleo }} - {{ $nucleo->InfoInscricao }}</option>
                                @endforeach
                              </select>
                                <small id="nucleoHelp" class="form-text text-muted">Por favor, informe o núcleo do seu interesse.</small>
                            </div>
                        </div>

                        <!--<div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                <small id="passwordHelp" class="form-text text-muted">A senha deve ter, no mínimo, 8 caracteres.</small>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>-->

                        <!--<div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                <small id="password-confirmHelp" class="form-text text-muted">Repita a mesma senha digitada no campo anterior.</small>

                                <input id="role" type="hidden" name="role" value="aluno">
                            </div>
                        </div>-->
                        <input id="role" type="hidden" name="role" value="aluno">

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Cadastrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
