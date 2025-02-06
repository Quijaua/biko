@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- PAGE HEADER -->
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header">Bem vindo ao Biko - Sistema de gestão de cursinhos populares.</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="row text-center">
                        <div class="col-12">
                            Para completar a instalação, informe a nova senha de acesso administrativo.
                        </div>
                        <div class="col-12">
                            <form action="{{ route('change_default_password') }}" method="POST" class="mt-5">
                                @csrf
                                <div class="col-6 offset-3">
                                    <div class="mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                            <input type="password" name="password" class="form-control" placeholder="Informe a nova senha" required>
                                        </div>
                                        <small class="form-text text-muted">Mínimo de 8 caracteres</small>
                                    </div>
                                </div>
                                <div class="col-6 offset-3">
                                    <div class="mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirme a nova senha" required>
                                        </div>
                                        <small class="form-text text-muted">Mínimo de 8 caracteres</small>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Alterar Senha</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
