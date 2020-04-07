@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1>MENSAGENS</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 col-lg-3">
                <div class="card">
                    <div class="card-header">Pastas</div>

                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li class="pb-2 pt-2 border-bottom">
                                <a href="#" class="text-black-50">
                                    <i class="fas fa-inbox"></i>
                                    Entrada
                                </a>
                            </li>

                            @if(\Illuminate\Support\Facades\Auth::user()->allowed_send_email)
                                <li class="pb-2 pt-2 border-bottom">
                                    <a href="#" class="text-black-50">
                                        <i class="fas fa-paper-plane"></i>
                                        Enviadas
                                    </a>
                                </li>
                            @endif

                            <li class="pb-2 pt-2 border-bottom">
                                <a href="#" class="text-black-50">
                                    <i class="fas fa-trash-alt"></i>
                                    Removidas
                                </a>
                            </li>
                        </ul>

                        @if(\Illuminate\Support\Facades\Auth::user()->allowed_send_email)
                            <a href="{{ route('messages.create') }}" class="btn btn-outline-secondary btn-block">
                                <i class="far fa-envelope-open"></i>
                                Nova mensagem
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-lg-9">
                @yield('content_message')
            </div>
        </div>
    </div>

@endsection
