<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $fillable = [
        'Status',
        'NomeAluno',
        'NomeSocial',
        'NomeNucleo',
        'id_user',
        'id_nucleo',
        'Foto',
        'ListaEspera',
        'CPF',
        'RG',
        'temFilhos',
        'filhosQt',
        'Email',
        'Raca',
        'Genero',

        'concordaSexoDesignado',

        'IdentificaGenero',
        'EstadoCivil',
        'Nascimento',

        'responsavelCuidadoOutraPessoa',

        'temFilhos',

        'filhosIdade',

        'CEP',
        'Endereco',
        'Numero',
        'Bairro',
        'Cidade',
        'Estado',
        'Complemento',
        'FoneComercial',
        'FoneResidencial',
        'FoneCelular',

        'Escolaridade',

        'Empresa',
        'CEPEmpresa',
        'EnderecoEmpresa',
        'NumeroEmpresa',
        'BairroEmpresa',
        'CidadeEmpresa',
        'EstadoEmpresa',
        'ComplementoEmpresa',
        'Cargo',
        'HorarioFrom',
        'HorarioTo',
        'NomeMae',
        'NomePai',
        'CEPFamilia',
        'EnderecoFamilia',
        'NumeroFamilia',
        'ComplementoFamilia',
        'BairroFamilia',
        'CidadeFamilia',
        'EstadoFamilia',
        'TelefoneFamilia',
        'AuxGoverno',
        'AuxTipo',
        'EnsFundamental',
        'PorcentagemBolsa',
        'EnsMedio',
        'PorcentagemBolsaMedio',
        'Enem',
        'Vestibular',
        'FaculdadeTipo',
        'NomeFaculdade',
        'CursoFaculdade',
        'AnoFaculdade',
        'OpcoesVestibular1',
        'OpcoesVestibular2',
        'VestibularOutraCidade',
        'ComoSoube',
        'ComoSoubeOutros',
    ];

    public function nucleo()
    {
        return $this->belongsTo('App\Nucleo');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function familiares()
    {
        return $this->hasMany('App\AlunoInfoFamiliares', 'id_user');
    }

    public static function whereStatus($value = true)
    {
        return self::query()->where('Status', $value);
    }

    public static function whereNucleo($nucleo)
    {
        return self::query()->where('id_nucleo', $nucleo);
    }
}
