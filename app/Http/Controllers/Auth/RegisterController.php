<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Aluno;
use App\Nucleo;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            //'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'min:11']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
      $remove = array("(", ")", "-", " ");
      $phone = intval(str_replace($remove, "", $data['phone']));
      $fundamental = isset($data['inputEnsFundamental']) ? json_encode($data['inputEnsFundamental']) : NULL;
      $medio = isset($data['inputEnsMedio']) ? json_encode($data['inputEnsMedio']) : NULL;

        /*
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);
        */

        /*$user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'phone' => $data['phone']
        ]);*/

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make(md5($data['email'])),
            'role' => $data['role'],
            'phone' => $phone
        ]);

        $my_token = app('auth.password.broker')->createToken($user);

        $nucleo = $data['inputNucleo'];
        $myNucleo = Nucleo::find($nucleo);
        Session::put('verified',$user->email_verified_at);

        $aluno = Aluno::create([
            'NomeAluno' => $user->name,
            'NomeSocial' => $data['NomeSocial'],
            'id_user' => $user->id,
            'Status' => 0,
            'FoneCelular' => $user->phone,
            'Escolaridade' => $data['inputEscolaridade'],
            'Email' => $data['email'],
            'id_nucleo' => $nucleo,
            'NomeNucleo' => $myNucleo->NomeNucleo,
            'ListaEspera' => 'Sim',
            'Raca' => $data['inputRaca'],
            'Genero' => $data['inputGenero'],
            'concordaSexoDesignado' => $data['concordaSexoDesignado'],
            'Nascimento' => $data['inputNascimento'],
            'responsavelCuidadoOutraPessoa' => $data['responsavelCuidadoOutraPessoa'],
            'temFilhos' => $data['temFilhos'],
            'filhosQt' => $data['filhosQt'],
            /*'filhosIdade' => $data['filhosIdade'],*/
            'CEP' => $data['inputCEP'],
            'Endereco' => $data['inputEndereco'],
            'Numero' => $data['inputNumero'],
            'Bairro' => $data['inputBairro'],
            'Cidade' => $data['inputCidade'],
            'Estado' => $data['inputEstado'],
            'Complemento' => $data['inputComplemento'],
            'EnsFundamental' => $fundamental,
            'PorcentagemBolsa' => $data['inputPorcentagemBolsa'],
            'EnsMedio' => $medio,
            'PorcentagemBolsaMedio' => $data['inputPorcentagemBolsaMedio'],
            'Vestibular' => $data['inputVestibular'],
            'Enem' => $data['inputEnem'],
            'OpcoesVestibular1' => $data['inputOpcoesVestibular1'],
            'OpcoesVestibular2' => $data['inputOpcoesVestibular2'],
            'VestibularOutraCidade' => $data['inputVestibularOutraCidade'],
            'ComoSoube' => $data['inputComoSoube'],
            'ComoSoubeOutros' => $data['inputComoSoubeOutros'],
        ]);

        return User::find($user->id);
    }
}
