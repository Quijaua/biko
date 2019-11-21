@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- PAGE HEADER -->
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>Bem vindo, {{ $user->name }}.</p>
                    <p>Aqui você poderá acompanhar a sua jornada e seu desempenho durante a permanência no projeto.</p>
                    <p>Boa sorte e bons estudos!</p>
                    <p><a href="http://uneafrobrasil.org" target="_blank"><strong>UNEAfro Brasil</strong></a></p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
