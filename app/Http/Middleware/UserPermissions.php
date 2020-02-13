<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Nucleo;
use App\Aluno;

class UserPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
      $user = Auth::user();
      $role = $user->role;
      $id = $user->id;

      if($role === 'aluno'){
        $currentPath = $request->path();
        $allowedAlunosIndex = 'alunos';
        $allowedAlunosDetails = 'alunos/details/'.$user->aluno->id;
        $allowedAlunosEdit = 'alunos/edit/'.$user->aluno->id;
        $allowedAlunosUpdate = 'alunos/update/'.$user->aluno->id;
        $allowedAlunosSearch = 'alunos/search';

        if($allowedAlunosIndex === $currentPath){
          return $next($request);
        }
        if($allowedAlunosDetails === $currentPath){
          return $next($request);
        }
        if($allowedAlunosEdit === $currentPath){
          return $next($request);
        }
        if($allowedAlunosUpdate === $currentPath){
          return $next($request);
        }
        if(strpos($currentPath, $allowedAlunosSearch) !== false){
          return $next($request);
        }

        return back();
      }

      if($role === 'professor'){
        $currentPath = $request->path();
        $allowedProfessoresIndex = 'professores';
        $allowedAlunosIndex = 'alunos';
        $allowedAlunosDetails = 'alunos/details/';
        $allowedNucleosIndex = 'nucleos';
        $allowedNucleosDetails = 'nucleos/details/';
        $allowedNucleosEdit = 'nucleos/edit/';
        $allowedProfessoresDetails = 'professores/details/'.$user->professor->id;
        $allowedProfessoresEdit = 'professores/edit/'.$user->professor->id;
        $allowedProfessoresUpdate = 'professores/update/'.$user->professor->id;
        $allowedCoordenadoresList = 'coordenadores';
        $allowedInactive = 'professores/disable/';

        if($allowedProfessoresIndex === $currentPath){
          return $next($request);
        }
        if($allowedProfessoresEdit === $currentPath){
          return $next($request);
        }
        if($allowedProfessoresUpdate === $currentPath){
          return $next($request);
        }
        if($allowedAlunosIndex === $currentPath){
          return $next($request);
        }
        if(strpos($currentPath, $allowedAlunosDetails) !== false){
          return $next($request);
        }
        if($allowedNucleosIndex === $currentPath){
          return $next($request);
        }
        if(strpos($currentPath, $allowedNucleosDetails) !== false){
          return $next($request);
        }
        if(strpos($currentPath, $allowedNucleosEdit) !== false){
          return back();
        }
        if($allowedProfessoresDetails === $currentPath){
          return $next($request);
        }
        if($allowedCoordenadoresList === $currentPath){
          return $next($request);
        }
        if($allowedInactive === $currentPath){
          return back();
        }

        return back();
      }

      if($role === 'coordenador'){
        $currentPath = $request->path();
        $allowedAlunosIndex = 'alunos';
        $allowedAlunosSearch = 'alunos/search';
        $allowedAlunosSearchByNucleo = 'alunos/nucleo/search';
        $allowedAlunosDetails = 'alunos/details/';
        $allowedAlunosEdit = 'alunos/edit/';
        $allowedAlunosInactive = 'alunos/disable/';
        $allowedAlunosActive = 'alunos/enable/';
        $allowedCoordenadoresIndex = 'coordenadores';
        $allowedCoordenadoresDetails = 'coordenadores/details/';
        $allowedCoordenadoresEdit = 'coordenadores/edit/'.$user->coordenador->id;
        $allowedProfessoresIndex = 'professores';
        $allowedProfessoresCreate = 'professores/add';
        $allowedProfessoresEdit = 'professores/edit/';
        $allowedProfessoresDisable = 'professores/disable/';
        $allowedProfessoresEnable = 'professores/enable/';
        $allowedNucleosIndex = 'nucleos';
        $allowedNucleosDetails = 'nucleos/details/';
        $allowedNucleosCreate = 'nucleos/create/';
        $allowedNucleosEdit = 'nucleos/edit/';
        $allowedNucleosInactive = 'nucleos/disable/';
        $allowedProfessoresDetails = 'professores/details/'.$user->coordenador->id;
        $allowedCoordenadoresList = 'coordenadores';
        $allowedInactive = 'professores/disable/';

        if($allowedAlunosIndex === $currentPath){
          return $next($request);
        }
        if(strpos($currentPath, $allowedAlunosSearch) !== false){
          return $next($request);
        }
        if(strpos($currentPath, $allowedAlunosSearchByNucleo) !== false){
          return $next($request);
        }
        if(strpos($currentPath, $allowedAlunosDetails) !== false){
          return $next($request);
        }
        if(strpos($currentPath, $allowedAlunosEdit) !== false){
          return $next($request);
        }
        if(strpos($currentPath, $allowedAlunosInactive) !== false){
          return $next($request);
        }
        if(strpos($currentPath, $allowedAlunosActive) !== false){
          return $next($request);
        }
        if($allowedProfessoresIndex === $currentPath){
          return $next($request);
        }
        if($allowedProfessoresCreate === $currentPath){
          return $next($request);
        }
        if(strpos($currentPath, $allowedProfessoresEdit) !== false){
          return $next($request);
        }
        if(strpos($currentPath, $allowedProfessoresDisable) !== false){
          return $next($request);
        }
        if(strpos($currentPath, $allowedProfessoresEnable) !== false){
          return $next($request);
        }
        if($allowedCoordenadoresIndex === $currentPath){
          return $next($request);
        }
        if(strpos($currentPath, $allowedCoordenadoresDetails) !== false){
          return $next($request);
        }
        if($allowedCoordenadoresEdit === $currentPath){
          return $next($request);
        }
        if($allowedNucleosIndex === $currentPath){
          return $next($request);
        }
        if(strpos($currentPath, $allowedNucleosDetails) !== false){
          return $next($request);
        }
        if($allowedNucleosCreate === $currentPath){
          return back();
        }
        if($allowedNucleosInactive === $currentPath){
          return back();
        }

        return back();
      }

      if($role === 'administrador'){
        return $next($request);
      }
    }
}
