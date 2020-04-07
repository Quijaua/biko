<?php

namespace App\Http\Controllers;

use App\Nucleo;

class MensagensController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('mensagens.index');
    }

    public function create()
    {
        $nucleos = Nucleo::whereStatus()->get();
        return view('mensagens.create', compact('nucleos'));
    }

}
