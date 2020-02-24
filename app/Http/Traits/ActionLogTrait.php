<?php

namespace App\Http\Traits;

use DB;

trait ActionLogTrait {
  public function logAction($url, $userId, $userName)
  {

    DB::table('action_log')->insert([
      'url' => $url,
      'user_id' => $userId,
      'username' => $userName,
      'created_at' => now(),
    ]);

  }
}
