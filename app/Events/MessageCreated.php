<?php

namespace App\Events;

use App\MensagensAluno;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $mensagensAluno;

    /**
     * Create a new event instance.
     *
     * @param MensagensAluno $mensagensAluno
     * @return void
     */
    public function __construct(MensagensAluno $mensagensAluno)
    {
        $this->mensagensAluno = $mensagensAluno;
    }

    public function getMensagensAluno()
    {
        return $this->mensagensAluno;
    }
}
