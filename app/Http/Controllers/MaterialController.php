<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Nucleo;
use App\Material;

class MaterialController extends Controller
{
  public function index()
  {
    $user = Auth::user();

    if ( $user->role === 'administrador' ) {
      $nucleos = Nucleo::where('Status', 1)->get();
      $files = Material::withTrashed()->get();
    } elseif ( $user->role === 'coordenador' ) {
      $nucleos = Nucleo::where('Status', 1)->where('id', $user->coordenador->id_nucleo)->first();
      $files = Material::where('status', 1)->where('nucleo_id', $user->coordenador->id_nucleo)->get();
    } elseif ( $user->role === 'professor' ) {
      $nucleos = Nucleo::where('Status', 1)->where('id', $user->professor->id_nucleo)->first();
      $files = Material::where('status', 1)->where('nucleo_id', $user->professor->id_nucleo)->get();
    } else {
      $user = Auth::user();
      //dd($user->aluno->id_nucleo);
      $nucleos = NULL;
      $files = Material::where('status', 1)->where('nucleo_id', $user->aluno->id_nucleo)->get();
    }

    return view('material.index')->with([
      'user' => $user,
      'nucleos' => $nucleos,
      'files' => $files
    ]);
  }

  public function create(Request $request)
  {
    $user_id = Auth::user()->id;
    $fileName = $request->file->getClientOriginalName();
    $request->file->move(public_path('uploads'), $fileName);

    $stored_file = Material::create([
      'user_id' => $user_id,
      'nucleo_id' => $request->nucleo_id,
      'name' => $fileName,
      'status' => 1
    ]);

    return back();
  }

  public function delete($id)
  {
    $file = Material::find($id);

    $file->update([
      'status' => 0
    ]);

    $file->delete($file);

    return back();
  }

  public function restore($id)
  {
    $file = Material::withTrashed()->find($id);
    $file->status = 1;
    $file->restore();

    return back();
  }
}
