<?php

namespace App\Mail;

use App\MensagensAluno;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageAlunoMail extends Mailable
{
    use Queueable, SerializesModels;

    private $aluno;

    private $mensagem;

    /**
     * Create a new message instance.
     *
     * @param MensagensAluno $mensagensAluno
     * @return void
     */
    public function __construct(MensagensAluno $mensagensAluno)
    {
        $this->aluno = $mensagensAluno->aluno;
        $this->mensagem = $mensagensAluno->mensagem;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject($this->mensagem->titulo);

        return $this->markdown('mensagens._mensagem_mail', [
            'aluno' => $this->aluno,
            'mensagem' => $this->mensagem
        ]);
    }

}
