<?php

namespace App\Exports;

use App\Aluno;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

//class AlunosExport implements FromCollection
class AlunosExport implements FromQuery
{
  use Exportable;
  /**
  * @return \Illuminate\Support\Collection
  */
  public function __construct(int $nucleo)
  {
      $this->nucleo = $nucleo;
  }

  public function query()
  {
    if($this->nucleo === 0){
      return Aluno::query();
    };

    return Aluno::query()->where('id_nucleo', $this->nucleo);
  }
}
