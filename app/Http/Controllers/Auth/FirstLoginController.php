<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FirstLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();

        if ($request->password != $request->password_confirmation) {
            return redirect()->back()->with('error', 'As senhas não conferem.');
        };

        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        };

        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('default_username')->with('success', 'Senha alterada com sucesso.');
    }

    public function username()
    {
        return view('first_login.change_username');
    }

    public function changeUsername(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'username' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        };

        $user->email = $request->username;
        $user->first_login = false;
        $user->save();

        return redirect()->route('home')->with('success', 'Email alterado com sucesso.');
    }
}