@component('mail::message')

Ola {{ $aluno->NomeAluno }}, você recebeu mensagem do {{ $mensagem->remetente->name }}:

{!! Illuminate\Mail\Markdown::parse($mensagem->mensagem) !!}

@component('mail::button', ['url' => route('messages.show', $mensagem->id)])
Visualizar mensagem no sistema
@endcomponent

@endcomponent