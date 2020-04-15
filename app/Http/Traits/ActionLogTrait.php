<?php

namespace App\Http\Traits;

use DB;

trait ActionLogTrait {
  public function logAction($url, $userId, $userName, $alunoId, $alunoNome)
  {

    DB::table('action_log')->insert([
      'url' => $url,
      'user_id' => $userId,
      'username' => $userName,
      'aluno_id' => $alunoId,
      'alunoNome' => $alunoNome,
      'created_at' => now(),
    ]);

  }
}
