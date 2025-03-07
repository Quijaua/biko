@extends('layouts.app')

@section('content')
<div class="page">
	<div class="container container-tight py-4">
        <div class="card card-md">


	        <div class="card-body">
		        <h2 class="h2 text-center mb-4">{{ __('Login') }}</h2>
                <form method="POST" action="{{ route('login') }}" autocomplete="off" novalidate>
                @csrf

	<div class="mb-3">
		<label for="email" class="form-label">{{ __('E-Mail') }}</label>


        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

@error('email')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror


	</div>
	<div class="mb-2">


		<label for="password" class="form-label">
        {{ __('Senha') }}
		</label>
        <div class="input-group input-group-flat">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
	        <span class="input-group-text">
		        <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip">
	                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1"><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                </a>
	        </span>
        </div>
	</div>
	<div class="mb-2">
		<label class="form-check">
            <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <span class="form-check-label" for="remember">
            {{ __('Manter-me conectado') }}
            </span>
		</label>
	</div>
	<div class="form-footer">



		<button type="submit" class="btn btn-primary w-100">{{ __('Login') }}</button>
	</div>
</form>
	</div>

</div>
<div class="text-center text-secondary mt-3">
@if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Esqueceu a senha?') }}
                                    </a>
                                @endif


</div>
	</div>
</div>

@endsection





