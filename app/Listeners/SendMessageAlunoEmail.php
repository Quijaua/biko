<?php

namespace App\Listeners;

use App\Events\MessageCreated;
use App\Mail\MessageAlunoMail;
use Illuminate\Support\Facades\Mail;

class SendMessageAlunoEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param MessageCreated $event
     * @return void
     */
    public function handle(MessageCreated $event)
    {
        $mensagemAluno = $event->getMensagensAluno();

        Mail::to($mensagemAluno->aluno->Email)
            ->cc($mensagemAluno->mensagem->remetente->email)
            ->queue(new MessageAlunoMail($mensagemAluno));
    }
}
