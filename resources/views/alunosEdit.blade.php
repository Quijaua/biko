@extends('layouts.app')

@section('content')
<div class="container">
  <!-- PAGE HEADER -->
  <div class="row">
      <div class="col-12 text-center">
        <h1>DADOS DO ALUNO</h1>
      </div>
  </div>
  <div class="row">
    <div class="col text-center">
       @if($dados->Foto)
       <img class="rounded-circle" src="{{ asset('storage') }}/{{ $dados->Foto }}" alt="{{ $dados->Foto }}">
       @else
       <img class="rounded-circle" src="{{ asset('images') }}/user.png" alt="Avatar">
       @endif
    </div>
  </div>
  @if(\Session::has('success'))
  <div class="row mt-2">
    <div class="col">
      <div class="alert alert-success text-center" role="alert">
        {!! \Session::get('success') !!}
      </div>
    </div>
  </div>
  @endif

  @foreach($familiares as $parente)
  <form id="updateParents{{ $parente->id }}" method="POST" action="/alunos/familiares/update/{{ $parente->id }}">@csrf</form>
  @endforeach
  <form method="POST" action="/alunos/update/{{ $dados->id }}" enctype="multipart/form-data">
    @csrf
    <h3>DADOS PESSOAIS</h3>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputNomeAluno">Nome do aluno</label>
          <input type="text" class="form-control" id="inputNomeAluno" name="inputNomeAluno" aria-describedby="inputNomeAlunoHelp" value="{{ $dados->NomeAluno }}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputNomeSocial">Nome Social do aluno</label>
          <input type="text" class="form-control" id="inputNomeSocial" name="inputNomeSocial" aria-describedby="inputNomeSocialHelp" value="{{ $dados->NomeSocial }}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputNucleo">Núcleo</label>
          <select name="inputNucleo" class="custom-select">
            <option selected>Selecione</option>
            @foreach($nucleos as $nucleo)
            @if($user->role === 'aluno')
            <option <?php if($nucleo->id == $dados->id_nucleo){ echo 'selected=selected';} ?> value="{{ $nucleo->id }}">{{ $nucleo->NomeNucleo }} - {{ $nucleo->InfoInscricao }}</option>
            @else
            <option <?php if($nucleo->id == $dados->id_nucleo){ echo 'selected=selected';} ?> value="{{ $nucleo->id }}">{{ $nucleo->NomeNucleo }}</option>
            @endif
            @endforeach
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputFoto">Foto</label>
          <input name="inputFoto" type="file" class="form-control-file" id="inputFoto">
        </div>
      </div>
      <div class="col mt-2">
        <small class="form-text text-muted">Arquivos devem ter menos que <strong>8 MB</strong>.</small>
        <small class="form-text text-muted">Tipos de arquivos permitidos: <strong>png gif jpg jpeg</strong>.</small>
      </div>
      <div class="col">
        <div class="form-group">
          <!--<label for="inputListaEspera">Lista de Espera</label>--><br />
          <div class="form-check form-check-inline">
            @if($user->role === 'administrador' || $user->role === 'coordenador')
            @if($dados->ListaEspera === 'Sim')
            <input class="form-check-input" name="inputListaEspera" type="checkbox" value="{{ $dados->ListaEspera }}" checked>
            @else
            <input class="form-check-input" name="inputListaEspera" type="checkbox" value="Sim">
            @endif
            <label class="form-check-label" for="inputListaEspera">Lista de Espera</label>
            @endif
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <!--<div class="col">
        <div class="form-group">
          <label for="inputCPF">CPF</label>
          <input type="text" class="form-control" id="inputCPF" name="inputCPF" aria-describedby="inputCPFHelp" data-mask="000.000.000-00" value="{{ $dados->CPF }}" placeholder="000.000.000-00" onblur="checkCPF()">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputRG">RG</label>
          <input type="text" class="form-control" id="inputRG" name="inputRG" aria-describedby="inputRGHelp" data-mask="00.000.000-00" value="{{ $dados->RG }}" placeholder="00.000.000-00">
        </div>
      </div>-->
      <?php //dd($dados->temFilhos); ?>
      <div class="col">
        <label for="temFilhos">Tem filhos?</label>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="temFilhos" id="temFilhos1" value="1" @if($dados->temFilhos === 1) {{ 'checked' }} @endif >
          <label class="form-check-label" for="temFilhos1">
            Sim
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="temFilhos" id="temFilhos2" value="0" @if($dados->temFilhos === 0) {{ 'checked' }} @endif>
          <label class="form-check-label" for="temFilhos2">
            Não
          </label>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="filhosQt">Quantos?</label>
          <input class="form-control" type="number" id="filhosQt" name="filhosQt" value="{{ $dados->filhosQt }}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputEmail">Email</label>
          <input type="email" class="form-control" id="inputEmail" name="inputEmail" aria-describedby="inputEmailHelp" placeholder="Endereço de Email" value="{{ $dados->Email }}" placeholder="Endereço de Email">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputRaca">Raça / Cor</label>
          <select name="inputRaca" class="custom-select">
            <option value="" selected>Selecione</option>
            <option <?php if($dados->Raca == 'negra'){ echo 'selected=selected';} ?> value="negra">Negra</option>
            <option <?php if($dados->Raca == 'branca'){ echo 'selected=selected';} ?> value="branca">Branca</option>
            <option <?php if($dados->Raca == 'parda'){ echo 'selected=selected';} ?> value="parda">Parda</option>
            <option <?php if($dados->Raca == 'amarela'){ echo 'selected=selected';} ?> value="amarela">Amarela</option>
            <option <?php if($dados->Raca == 'indigena'){ echo 'selected=selected';} ?> value="indigena">Indígena</option>
          </select>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputGenero">Gênero</label>
          <select name="inputGenero" class="custom-select">
            <option value="" selected>Selecione</option>
            <option <?php if($dados->Genero == 'mulher'){ echo 'selected=selected';} ?> value="mulher">Mulher</option>
            <option <?php if($dados->Genero == 'homem'){ echo 'selected=selected';} ?> value="homem">Homem</option>
            <option <?php if($dados->Genero == 'mulher_trans_cis'){ echo 'selected=selected';} ?> value="mulher_trans_cis">Mulher (Trans ou Cis)</option>
            <option <?php if($dados->Genero == 'homem_trans_cis'){ echo 'selected=selected';} ?> value="homem_trans_cis">Homem (Trans ou Cis)</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputEstadoCivil">Estado Civil</label>
          <select name="inputEstadoCivil" class="custom-select">
            <option value="" selected>Selecione</option>
            <option <?php if($dados->EstadoCivil == 'solteiro_a'){ echo 'selected=selected';} ?> value="solteiro_a">Solteiro(a)</option>
            <option <?php if($dados->EstadoCivil == 'casado_a'){ echo 'selected=selected';} ?> value="casado_a">Casado(a)</option>
            <option <?php if($dados->EstadoCivil == 'uniao_estavel'){ echo 'selected=selected';} ?> value="uniao_estavel">União Estável</option>
            <option <?php if($dados->EstadoCivil == 'divorciado_a'){ echo 'selected=selected';} ?> value="divorciado_a">Divorciado(a)</option>
            <option <?php if($dados->EstadoCivil == 'viuvo_a'){ echo 'selected=selected';} ?> value="viuvo_a">Viúvo(a)</option>
          </select>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputNascimento">Data de Nascimento</label>
          <input type="date" class="form-control" id="inputNascimento" name="inputNascimento" aria-describedby="inputNascimentoHelp" value="{{ $dados->Nascimento }}" onblur="getAge()">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputAuxGoverno">A família recebe algumn tipo de auxílio do Governo?</label>
          <div id="AuxGoverno" class="form-check form-check-inline">
            <input <?php if($dados->AuxGoverno == 'sim'){ echo 'checked=checked';} ?> class="form-check-input" type="radio" name="inputAuxGoverno" id="inputAuxGoverno1" value="sim" onclick="showInput('#AuxTipo')">
            <label class="form-check-label" for="inputTaxaInscricao1">Sim</label>
          </div>
          <div class="form-check form-check-inline">
            <input <?php if($dados->AuxGoverno == 'nao'){ echo 'checked=checked';} ?> class="form-check-input" type="radio" name="inputAuxGoverno" id="inputAuxGoverno2" value="nao" onclick="hideAuxInput('#AuxTipo')">
            <label class="form-check-label" for="inputTaxaInscricao2">Não</label>
          </div>
        </div>
      </div>
      <div class="col">
        @if($dados->AuxGoverno == 'nao' or $dados->AuxGoverno == NULL)
        <div id="AuxTipo" class="form-group" style="display:none;">
          <label for="inputAuxTipo">Qual?</label>
          <select name="inputAuxTipo" class="custom-select">
            <option value="" selected>Selecione</option>
            <option value="bolsa_familia">Programa Bolsa Família</option>
            <option value="energia_eletrica">Tarifa Social de Energia Elétrica</option>
            <option value="emergencial_financeiro">Auxílio Emergencial Financeiro</option>
            <option value="bolsa_verde">Bolsa Verde</option>
          </select>
        </div>
        @else
        <div id="AuxTipo" class="form-group">
          <label for="inputAuxTipo">Qual?</label>
          <select name="inputAuxTipo" class="custom-select">
            <option value="">Selecione</option>
            <option <?php if($dados->AuxTipo == 'bolsa_familia'){ echo 'selected=selected';} ?> value="bolsa_familia">Programa Bolsa Família</option>
            <option <?php if($dados->AuxTipo == 'energia_eletrica'){ echo 'selected=selected';} ?> value="energia_eletrica">Tarifa Social de Energia Elétrica</option>
            <option <?php if($dados->AuxTipo == 'emergencial_financeiro'){ echo 'selected=selected';} ?> value="emergencial_financeiro">Auxílio Emergencial Financeiro</option>
            <option <?php if($dados->AuxTipo == 'bolsa_verde'){ echo 'selected=selected';} ?> value="bolsa_verde">Bolsa Verde</option>
          </select>
        </div>
        @endif
      </div>
    </div>
    <hr>
    <h3>ENDEREÇO</h3>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputCEP">CEP (Somente números)</label>
          <input type="text" class="form-control" id="inputCEP" name="inputCEP" aria-describedby="inputCEPHelp" data-mask="00000-000" value="{{ $dados->CEP }}" onblur="checkCEP('#inputCEP')" placeholder="00000-000">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputEndereco">Rua</label>
          <input pattern="([^\s][A-zÀ-ž\s]+)" type="text" class="form-control" id="inputEndereco" name="inputEndereco" aria-describedby="inputEnderecoHelp" value="{{ $dados->Endereco }}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputNumero">Número</label>
          <input type="number" class="form-control" id="inputNumero" name="inputNumero" aria-describedby="inputNumeroHelp" value="{{ $dados->Numero }}">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputBairro">Bairro</label>
          <input type="text" class="form-control" id="inputBairro" name="inputBairro" aria-describedby="inputBairroHelp" value="{{ $dados->Bairro }}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputCidade">Cidade</label>
          <input type="text" class="form-control" id="inputCidade" name="inputCidade" aria-describedby="inputCidadeHelp" value="{{ $dados->Cidade }}">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputEstado">Estado</label>
          <select id="inputEstado" name="inputEstado" class="custom-select">
            <option value="" selected>Selecione</option>
            <option <?php if($dados->Estado == 'AC'){ echo 'selected=selected';} ?> value="AC">Acre</option>
            <option <?php if($dados->Estado == 'AL'){ echo 'selected=selected';} ?> value="AL">Alagoas</option>
            <option <?php if($dados->Estado == 'AP'){ echo 'selected=selected';} ?> value="AP">Amapá</option>
            <option <?php if($dados->Estado == 'AM'){ echo 'selected=selected';} ?> value="AM">Amazonas</option>
            <option <?php if($dados->Estado == 'BA'){ echo 'selected=selected';} ?> value="BA">Bahia</option>
            <option <?php if($dados->Estado == 'CE'){ echo 'selected=selected';} ?> value="CE">Ceará</option>
            <option <?php if($dados->Estado == 'DF'){ echo 'selected=selected';} ?> value="DF">Distrito Federal</option>
            <option <?php if($dados->Estado == 'ES'){ echo 'selected=selected';} ?> value="ES">Espírito Santo</option>
            <option <?php if($dados->Estado == 'GO'){ echo 'selected=selected';} ?> value="GO">Goiás</option>
            <option <?php if($dados->Estado == 'MA'){ echo 'selected=selected';} ?> value="MA">Maranhão</option>
            <option <?php if($dados->Estado == 'MT'){ echo 'selected=selected';} ?> value="MT">Mato Grosso</option>
            <option <?php if($dados->Estado == 'MS'){ echo 'selected=selected';} ?> value="MS">Mato Grosso do Sul</option>
            <option <?php if($dados->Estado == 'MG'){ echo 'selected=selected';} ?> value="MG">Minas Gerais</option>
            <option <?php if($dados->Estado == 'PA'){ echo 'selected=selected';} ?> value="PA">Pará</option>
            <option <?php if($dados->Estado == 'PB'){ echo 'selected=selected';} ?> value="PB">Paraíba</option>
            <option <?php if($dados->Estado == 'PR'){ echo 'selected=selected';} ?> value="PR">Paraná</option>
            <option <?php if($dados->Estado == 'PE'){ echo 'selected=selected';} ?> value="PE">Pernambuco</option>
            <option <?php if($dados->Estado == 'PI'){ echo 'selected=selected';} ?> value="PI">Piauí</option>
            <option <?php if($dados->Estado == 'RJ'){ echo 'selected=selected';} ?> value="RJ">Rio de Janeiro</option>
            <option <?php if($dados->Estado == 'RN'){ echo 'selected=selected';} ?> value="RN">Rio Grande do Norte</option>
            <option <?php if($dados->Estado == 'RS'){ echo 'selected=selected';} ?> value="RS">Rio Grande do Sul</option>
            <option <?php if($dados->Estado == 'RO'){ echo 'selected=selected';} ?> value="RO">Rondônia</option>
            <option <?php if($dados->Estado == 'RR'){ echo 'selected=selected';} ?> value="RR">Roraima</option>
            <option <?php if($dados->Estado == 'SC'){ echo 'selected=selected';} ?> value="SC">Santa Catarina</option>
            <option <?php if($dados->Estado == 'SP'){ echo 'selected=selected';} ?> value="SP">São Paulo</option>
            <option <?php if($dados->Estado == 'SE'){ echo 'selected=selected';} ?> value="SE">Sergipe</option>
            <option <?php if($dados->Estado == 'TO'){ echo 'selected=selected';} ?> value="TO">Tocantins</option>
            <option <?php if($dados->Estado == 'EX'){ echo 'selected=selected';} ?> value="EX">Estrangeiro</option>
          </select>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputComplemento">Complemento</label>
          <input type="text" class="form-control" id="inputComplemento" name="inputComplemento" aria-describedby="inputComplementoHelp" value="{{ $dados->Complemento }}">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputFoneComercial">Telefone Comercial</label>
          <input type="phone" class="form-control" id="inputFoneComercial" name="inputFoneComercial" aria-describedby="inputFoneComercialHelp" data-mask="(00) 0000-0000" value="{{ $dados->FoneComercial }}" placeholder="(00) 0000-0000">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputFoneResidencial">Telefone Residencial</label>
          <input type="phone" class="form-control" id="inputFoneResidencial" name="inputFoneResidencial" aria-describedby="inputFoneResidencialHelp" data-mask="(00) 0000-0000" value="{{ $dados->FoneResidencial }}" placeholder="(00) 0000-0000">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputFoneCelular">Telefone Celular</label>
          <input type="phone" class="form-control" id="inputFoneCelular" name="inputFoneCelular" aria-describedby="inputFoneCelularHelp" data-mask="(00) 0 0000-0000" value="{{ $dados->FoneCelular }}" placeholder="(00) 0 0000-0000">
        </div>
      </div>
    </div>
    <hr>
    <h3>DADOS PROFISSIONAIS</h3>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputEmpresa">Nome da Empresa</label>
          <input type="text" class="form-control" id="inputEmpresa" name="inputEmpresa" aria-describedby="inputEmpresaHelp" value="{{ $dados->Empresa }}">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputCEPEmpresa">CEP</label>
          <input type="text" class="form-control" id="inputCEPEmpresa" name="inputCEPEmpresa" aria-describedby="inputCEPEmpresaHelp" data-mask="00000-000" value="{{ $dados->CEPEmpresa }}" onblur="checkCEP('#inputCEPEmpresa')" placeholder="00000-000">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputEnderecoEmpresa">Rua</label>
          <input pattern="([^\s][A-zÀ-ž\s]+)" type="text" class="form-control" id="inputEnderecoEmpresa" name="inputEnderecoEmpresa" aria-describedby="inputEnderecoEmpresaHelp" value="{{ $dados->EnderecoEmpresa }}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputNumeroEmpresa">Número</label>
          <input type="text" class="form-control" id="inputNumeroEmpresa" name="inputNumeroEmpresa" aria-describedby="inputNumeroEmpresaHelp" value="{{ $dados->NumeroEmpresa }}">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputBairroEmpresa">Bairro</label>
          <input type="text" class="form-control" id="inputBairroEmpresa" name="inputBairroEmpresa" aria-describedby="inputBairroEmpresaHelp" value="{{ $dados->BairroEmpresa }}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputCidadeEmpresa">Cidade</label>
          <input type="text" class="form-control" id="inputCidadeEmpresa" name="inputCidadeEmpresa" aria-describedby="inputCidadeEmpresaHelp" value="{{ $dados->CidadeEmpresa }}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputComplementoEmpresa">Complemento</label>
          <input type="text" class="form-control" id="inputComplementoEmpresa" name="inputComplementoEmpresa" aria-describedby="inputComplementoEmpresaHelp" value="{{ $dados->ComplementoEmpresa }}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputEstadoEmpresa">Estado</label>
          <select name="inputEstadoEmpresa" class="custom-select">
            <option value="" selected>Selecione</option>
            <option <?php if($dados->EstadoEmpresa == 'AC'){ echo 'selected=selected';} ?> value="AC">Acre</option>
            <option <?php if($dados->EstadoEmpresa == 'AL'){ echo 'selected=selected';} ?> value="AL">Alagoas</option>
            <option <?php if($dados->EstadoEmpresa == 'AP'){ echo 'selected=selected';} ?> value="AP">Amapá</option>
            <option <?php if($dados->EstadoEmpresa == 'AM'){ echo 'selected=selected';} ?> value="AM">Amazonas</option>
            <option <?php if($dados->EstadoEmpresa == 'BA'){ echo 'selected=selected';} ?> value="BA">Bahia</option>
            <option <?php if($dados->EstadoEmpresa == 'CE'){ echo 'selected=selected';} ?> value="CE">Ceará</option>
            <option <?php if($dados->EstadoEmpresa == 'DF'){ echo 'selected=selected';} ?> value="DF">Distrito Federal</option>
            <option <?php if($dados->EstadoEmpresa == 'ES'){ echo 'selected=selected';} ?> value="ES">Espírito Santo</option>
            <option <?php if($dados->EstadoEmpresa == 'GO'){ echo 'selected=selected';} ?> value="GO">Goiás</option>
            <option <?php if($dados->EstadoEmpresa == 'MA'){ echo 'selected=selected';} ?> value="MA">Maranhão</option>
            <option <?php if($dados->EstadoEmpresa == 'MT'){ echo 'selected=selected';} ?> value="MT">Mato Grosso</option>
            <option <?php if($dados->EstadoEmpresa == 'MS'){ echo 'selected=selected';} ?> value="MS">Mato Grosso do Sul</option>
            <option <?php if($dados->EstadoEmpresa == 'MG'){ echo 'selected=selected';} ?> value="MG">Minas Gerais</option>
            <option <?php if($dados->EstadoEmpresa == 'PA'){ echo 'selected=selected';} ?> value="PA">Pará</option>
            <option <?php if($dados->EstadoEmpresa == 'PB'){ echo 'selected=selected';} ?> value="PB">Paraíba</option>
            <option <?php if($dados->EstadoEmpresa == 'PR'){ echo 'selected=selected';} ?> value="PR">Paraná</option>
            <option <?php if($dados->EstadoEmpresa == 'PE'){ echo 'selected=selected';} ?> value="PE">Pernambuco</option>
            <option <?php if($dados->EstadoEmpresa == 'PI'){ echo 'selected=selected';} ?> value="PI">Piauí</option>
            <option <?php if($dados->EstadoEmpresa == 'RJ'){ echo 'selected=selected';} ?> value="RJ">Rio de Janeiro</option>
            <option <?php if($dados->EstadoEmpresa == 'RN'){ echo 'selected=selected';} ?> value="RN">Rio Grande do Norte</option>
            <option <?php if($dados->EstadoEmpresa == 'RS'){ echo 'selected=selected';} ?> value="RS">Rio Grande do Sul</option>
            <option <?php if($dados->EstadoEmpresa == 'RO'){ echo 'selected=selected';} ?> value="RO">Rondônia</option>
            <option <?php if($dados->EstadoEmpresa == 'RR'){ echo 'selected=selected';} ?> value="RR">Roraima</option>
            <option <?php if($dados->EstadoEmpresa == 'SC'){ echo 'selected=selected';} ?> value="SC">Santa Catarina</option>
            <option <?php if($dados->EstadoEmpresa == 'SP'){ echo 'selected=selected';} ?> value="SP">São Paulo</option>
            <option <?php if($dados->EstadoEmpresa == 'SE'){ echo 'selected=selected';} ?> value="SE">Sergipe</option>
            <option <?php if($dados->EstadoEmpresa == 'TO'){ echo 'selected=selected';} ?> value="TO">Tocantins</option>
            <option <?php if($dados->EstadoEmpresa == 'EX'){ echo 'selected=selected';} ?> value="EX">Estrangeiro</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputCargo">Cargo/Função</label>
          <input type="text" class="form-control" id="inputCargo" name="inputCargo" aria-describedby="inputCargoHelp" value="{{ $dados->Cargo }}">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <p>Horário de Trabalho</p>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputHorarioFrom">De</label>
          <input type="time" class="form-control" id="inputHorarioFrom" name="inputHorarioFrom" aria-describedby="inputHorarioFromHelp" value="{{ $dados->HorarioFrom }}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputHorarioTo">Até</label>
          <input type="time" class="form-control" id="inputHorarioTo" name="inputHorarioTo" aria-describedby="inputHorarioToHelp" value="{{ $dados->HorarioTo }}">
        </div>
      </div>
    </div>
    <hr>
    <!--
    <h3>DADOS FAMILIARES</h3>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputNomeMae">Nome da Mãe</label>
          <input type="text" class="form-control" id="inputNomeMae" name="inputNomeMae" aria-describedby="inputNomeMaeHelp" value="{{ $dados->NomeMae }}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputNomePai">Nome do Pai</label>
          <input type="text" class="form-control" id="inputNomePai" name="inputNomePai" aria-describedby="inputNomePaiHelp" value="{{ $dados->NomePai }}">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputCEPFamilia">CEP</label>
          <input type="text" class="form-control" id="inputCEPFamilia" name="inputCEPFamilia" aria-describedby="inputCEPFamiliaHelp" data-mask="00000-000" value="{{ $dados->CEPFamilia }}" onblur="checkCEP('#inputCEPFamilia')" placeholder="00000-000">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputEnderecoFamilia">Rua</label>
          <input pattern="([^\s][A-zÀ-ž\s]+)" type="text" class="form-control" id="inputEnderecoFamilia" name="inputEnderecoFamilia" aria-describedby="inputEnderecoFamiliaHelp" value="{{ $dados->EnderecoFamilia }}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputNumeroFamilia">Número</label>
          <input type="number" class="form-control" id="inputNumeroFamilia" name="inputNumeroFamilia" aria-describedby="inputNumeroFamiliaHelp" value="{{ $dados->NumeroFamilia }}">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputComplementoFamilia">Complemento</label>
          <input type="text" class="form-control" id="inputComplementoFamilia" name="inputComplementoFamilia" aria-describedby="inputComplementoFamiliaHelp" value="{{ $dados->ComplementoFamilia }}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputBairroFamilia">Bairro</label>
          <input type="text" class="form-control" id="inputBairroFamilia" name="inputBairroFamilia" aria-describedby="inputBairroFamiliaHelp" value="{{ $dados->BairroFamilia }}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputCidadeFamilia">Cidade</label>
          <input type="text" class="form-control" id="inputCidadeFamilia" name="inputCidadeFamilia" aria-describedby="inputCidadeFamiliaHelp" value="{{ $dados->CidadeFamilia }}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputEstadoFamilia">Estado</label>
          <select id="inputEstadoFamilia" name="inputEstadoFamilia" class="custom-select">
            <option value="" selected>Selecione</option>
            <option <?php if($dados->EstadoFamilia == 'AC'){ echo 'selected=selected';} ?> value="AC">Acre</option>
            <option <?php if($dados->EstadoFamilia == 'AL'){ echo 'selected=selected';} ?> value="AL">Alagoas</option>
            <option <?php if($dados->EstadoFamilia == 'AP'){ echo 'selected=selected';} ?> value="AP">Amapá</option>
            <option <?php if($dados->EstadoFamilia == 'AM'){ echo 'selected=selected';} ?> value="AM">Amazonas</option>
            <option <?php if($dados->EstadoFamilia == 'BA'){ echo 'selected=selected';} ?> value="BA">Bahia</option>
            <option <?php if($dados->EstadoFamilia == 'CE'){ echo 'selected=selected';} ?> value="CE">Ceará</option>
            <option <?php if($dados->EstadoFamilia == 'DF'){ echo 'selected=selected';} ?> value="DF">Distrito Federal</option>
            <option <?php if($dados->EstadoFamilia == 'ES'){ echo 'selected=selected';} ?> value="ES">Espírito Santo</option>
            <option <?php if($dados->EstadoFamilia == 'GO'){ echo 'selected=selected';} ?> value="GO">Goiás</option>
            <option <?php if($dados->EstadoFamilia == 'MA'){ echo 'selected=selected';} ?> value="MA">Maranhão</option>
            <option <?php if($dados->EstadoFamilia == 'MT'){ echo 'selected=selected';} ?> value="MT">Mato Grosso</option>
            <option <?php if($dados->EstadoFamilia == 'MS'){ echo 'selected=selected';} ?> value="MS">Mato Grosso do Sul</option>
            <option <?php if($dados->EstadoFamilia == 'MG'){ echo 'selected=selected';} ?> value="MG">Minas Gerais</option>
            <option <?php if($dados->EstadoFamilia == 'PA'){ echo 'selected=selected';} ?> value="PA">Pará</option>
            <option <?php if($dados->EstadoFamilia == 'PB'){ echo 'selected=selected';} ?> value="PB">Paraíba</option>
            <option <?php if($dados->EstadoFamilia == 'PR'){ echo 'selected=selected';} ?> value="PR">Paraná</option>
            <option <?php if($dados->EstadoFamilia == 'PE'){ echo 'selected=selected';} ?> value="PE">Pernambuco</option>
            <option <?php if($dados->EstadoFamilia == 'PI'){ echo 'selected=selected';} ?> value="PI">Piauí</option>
            <option <?php if($dados->EstadoFamilia == 'RJ'){ echo 'selected=selected';} ?> value="RJ">Rio de Janeiro</option>
            <option <?php if($dados->EstadoFamilia == 'RN'){ echo 'selected=selected';} ?> value="RN">Rio Grande do Norte</option>
            <option <?php if($dados->EstadoFamilia == 'RS'){ echo 'selected=selected';} ?> value="RS">Rio Grande do Sul</option>
            <option <?php if($dados->EstadoFamilia == 'RO'){ echo 'selected=selected';} ?> value="RO">Rondônia</option>
            <option <?php if($dados->EstadoFamilia == 'RR'){ echo 'selected=selected';} ?> value="RR">Roraima</option>
            <option <?php if($dados->EstadoFamilia == 'SC'){ echo 'selected=selected';} ?> value="SC">Santa Catarina</option>
            <option <?php if($dados->EstadoFamilia == 'SP'){ echo 'selected=selected';} ?> value="SP">São Paulo</option>
            <option <?php if($dados->EstadoFamilia == 'SE'){ echo 'selected=selected';} ?> value="SE">Sergipe</option>
            <option <?php if($dados->EstadoFamilia == 'TO'){ echo 'selected=selected';} ?> value="TO">Tocantins</option>
            <option <?php if($dados->EstadoFamilia == 'EX'){ echo 'selected=selected';} ?> value="EX">Estrangeiro</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputTelefoneFamilia">Telefone</label>
          <input type="text" class="form-control" id="inputTelefoneFamilia" name="inputTelefoneFamilia" aria-describedby="inputTelefoneFamiliaHelp" data-mask="(00) 0000-0000" value="{{ $dados->TelefoneFamilia }}" placeholder="(00) 0000-0000">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputAuxGoverno">A família recebe algumn tipo de auxílio do Governo?</label>
          <div id="AuxGoverno" class="form-check form-check-inline">
            <input <?php if($dados->AuxGoverno == 'sim'){ echo 'checked=checked';} ?> class="form-check-input" type="radio" name="inputAuxGoverno" id="inputAuxGoverno1" value="sim" onclick="showInput('#AuxTipo')">
            <label class="form-check-label" for="inputTaxaInscricao1">Sim</label>
          </div>
          <div class="form-check form-check-inline">
            <input <?php if($dados->AuxGoverno == 'nao'){ echo 'checked=checked';} ?> class="form-check-input" type="radio" name="inputAuxGoverno" id="inputAuxGoverno2" value="nao" onclick="hideAuxInput('#AuxTipo')">
            <label class="form-check-label" for="inputTaxaInscricao2">Não</label>
          </div>
        </div>
      </div>
      <div class="col">
        @if($dados->AuxGoverno == 'nao' or $dados->AuxGoverno == NULL)
        <div id="AuxTipo" class="form-group" style="display:none;">
          <label for="inputAuxTipo">Qual?</label>
          <select name="inputAuxTipo" class="custom-select">
            <option value="" selected>Selecione</option>
            <option value="bolsa_familia">Programa Bolsa Família</option>
            <option value="energia_eletrica">Tarifa Social de Energia Elétrica</option>
            <option value="emergencial_financeiro">Auxílio Emergencial Financeiro</option>
            <option value="bolsa_verde">Bolsa Verde</option>
          </select>
        </div>
        @else
        <div id="AuxTipo" class="form-group">
          <label for="inputAuxTipo">Qual?</label>
          <select name="inputAuxTipo" class="custom-select">
            <option value="">Selecione</option>
            <option <?php if($dados->AuxTipo == 'bolsa_familia'){ echo 'selected=selected';} ?> value="bolsa_familia">Programa Bolsa Família</option>
            <option <?php if($dados->AuxTipo == 'energia_eletrica'){ echo 'selected=selected';} ?> value="energia_eletrica">Tarifa Social de Energia Elétrica</option>
            <option <?php if($dados->AuxTipo == 'emergencial_financeiro'){ echo 'selected=selected';} ?> value="emergencial_financeiro">Auxílio Emergencial Financeiro</option>
            <option <?php if($dados->AuxTipo == 'bolsa_verde'){ echo 'selected=selected';} ?> value="bolsa_verde">Bolsa Verde</option>
          </select>
        </div>
        @endif
      </div>
    </div>

    <div id="info" class="row">
      <div class="col-12 mt-2"><h3>INFORMAÇÕES FAMILIARES</h3></div>
      @foreach($familiares as $parente)

      <div class="container-fluid p-3">
        <div id="item-{{$parente->id}}" class="stage">
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="inputGrauParentesco">Grau de Parentesco</label>
                <select name="inputGrauParentesco" class="custom-select" form="updateParents<?php echo $parente->id; ?>">
                  <option selected>Selecione</option>
                  <option <?php if($parente->GrauParentesco === 'pai'){echo 'selected=selected';} ?> value="pai">Pai</option>
                  <option <?php if($parente->GrauParentesco === 'mae'){echo 'selected=selected';} ?> value="mae">Mãe</option>
                  <option <?php if($parente->GrauParentesco === 'madrasta'){echo 'selected=selected';} ?> value="madrasta">Madrasta</option>
                  <option <?php if($parente->GrauParentesco === 'padrasto'){echo 'selected=selected';} ?> value="padrasto">Padrasto</option>
                  <option <?php if($parente->GrauParentesco === 'irmao_a'){echo 'selected=selected';} ?> value="irmao_a">Irmão/ã</option>
                  <option <?php if($parente->GrauParentesco === 'avo'){echo 'selected=selected';} ?> value="avo">Avô/Avó</option>
                  <option <?php if($parente->GrauParentesco === 'primo_a'){echo 'selected=selected';} ?> value="primo_a">Primo/a</option>
                  <option <?php if($parente->GrauParentesco === 'sobrinho_a'){echo 'selected=selected';} ?> value="sobrinho_a">Sobrinho/a</option>
                  <option <?php if($parente->GrauParentesco === 'tio_a'){echo 'selected=selected';} ?> value="tio_a">Tio/a</option>
                </select>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="inputIdade">Idade</label>
                <input type="number" class="form-control" id="inputIdade" name="inputIdade" aria-describedby="inputIdadeHelp" value="{{ $parente->Idade }}" form="updateParents<?php echo $parente->id; ?>">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="inputEstadoCivil">Estado Civil</label>
                <select name="inputEstadoCivil" class="custom-select" form="updateParents<?php echo $parente->id; ?>">
                  <option selected>Selecione</option>
                  <option <?php if($parente->EstadoCivil === 'solteiro_a'){echo 'selected=selected';} ?> value="solteiro_a">Solteiro(a)</option>
                  <option <?php if($parente->EstadoCivil === 'casado_a'){echo 'selected=selected';} ?> value="casado_a">Casado(a)</option>
                  <option <?php if($parente->EstadoCivil === 'uniao_estavel'){echo 'selected=selected';} ?> value="uniao_estavel">União Estável</option>
                  <option <?php if($parente->EstadoCivil === 'divorciado_a'){echo 'selected=selected';} ?> value="divorciado_a">Divorciado(a)</option>
                  <option value="viuvo_a">Viúvo(a)</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="inputEscolaridade">Escolaridade</label>
                <select name="inputEscolaridade" class="custom-select" form="updateParents<?php echo $parente->id; ?>">
                  <option selected>Selecione</option>
                  <option <?php if($parente->Escolaridade === 'fundamental_completo'){echo 'selected=selected';} ?> value="fundamental_completo">Ensino Fundamental Completo</option>
                  <option <?php if($parente->Escolaridade === 'fundamental_incompleto'){echo 'selected=selected';} ?> value="fundamental_incompleto">Ensino Fundamental Incompleto</option>
                  <option <?php if($parente->Escolaridade === 'medio_completo'){echo 'selected=selected';} ?> value="medio_completo">Ensino Médio Completo</option>
                  <option <?php if($parente->Escolaridade === 'medio_incompleto'){echo 'selected=selected';} ?> value="medio_incompleto">Ensino Médio Incompleto</option>
                  <option <?php if($parente->Escolaridade === 'superior_completo'){echo 'selected=selected';} ?> value="superior_completo">Ensino Superior Completo</option>
                  <option <?php if($parente->Escolaridade === 'superior_incompleto'){echo 'selected=selected';} ?> value="superior_incompleto">Ensino Superior Incompleto</option>
                </select>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="inputProfissao">Profissão</label>
                <input type="text" class="form-control" id="inputProfissao" name="inputProfissao" aria-describedby="inputProfissaoHelp" value="{{ $parente->Profissao }}" form="updateParents<?php echo $parente->id; ?>">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="inputRenda">Renda Mensal R$</label>
                <input type="number" class="form-control" id="inputRenda" name="inputRenda" aria-describedby="inputRendaHelp" value="{{ $parente->Renda }}" form="updateParents<?php echo $parente->id; ?>">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-4">
              <button class="btn-update btn btn-success btn-block" type="button" name="button" onclick="updateParents(<?php echo $parente->id ?>)">Salvar Item</button>
            </div>
            <div class="col-4">
              <button class="btn-delete btn btn-danger btn-block" type="button" name="button" onclick="deleteParents(<?php echo $parente->id; ?>)">Remover Item</button>
            </div>
          </div>
          <hr>
        </div>
      </div>
      @endforeach
    </div>

    <div class="row">
      <div class="col">
        <button type="button" class="btn btn-lg btn-block btn-primary" data-toggle="modal" data-backdrop="true" data-keyboard="true" data-target=".modal-dados-familia">INFORMAÇÕES DA FAMÍLIA <strong>(OBRIGATÓRIO)</strong></button>
        <div class="text-center">
          <small>Relacione aqui todas as pessoas que residem em sua casa, incluindo você (em caso de pais separados, se houver pensão relacione-o também).</small>
        </div>
      </div>
    </div>
    <hr>
    -->
    <h3>DADOS ACADÊMICOS</h3>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputEnsFundamental">Ensino Fundamental</label><br>
          <div class="form-check form-check-inline">
            <input <?php if(strpos($dados->EnsFundamental, 'rede publica') !== FALSE){ echo 'checked=checked';} ?> class="form-check-input" name="inputEnsFundamental[]" type="checkbox" id="rede_publica" value="rede publica">
            <label class="form-check-label" for="inputEnsFundamental1">Rede Pública</label>
          </div>
          <div class="form-check form-check-inline">
            <input <?php if(strpos($dados->EnsFundamental, 'particular sem bolsa') !== FALSE){ echo 'checked=checked';} ?> class="form-check-input" name="inputEnsFundamental[]" type="checkbox" id="particular_sem_bolsa" value="particular sem bolsa">
            <label class="form-check-label" for="inputEnsFundamental2">Particular sem bolsa</label>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputPorcentagemBolsa">Particular com bolsa de:</label>
          <input max="100" pattern="[0-9]{1,3}" type="number" class="form-control" id="inputPorcentagemBolsa" name="inputPorcentagemBolsa" aria-describedby="inputPorcentagemBolsaHelp" value="{{ $dados->PorcentagemBolsa }}">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputEnsMedio">Ensino Médio</label><br>
          <div class="form-check form-check-inline">
            <input <?php if(strpos($dados->EnsMedio, 'rede publica') !== FALSE){ echo 'checked=checked';} ?> class="form-check-input" name="inputEnsMedio[]" type="checkbox" id="rede_publica" value="rede publica">
            <label class="form-check-label" for="inputEnsMedio1">Rede Pública</label>
          </div>
          <div class="form-check form-check-inline">
            <input <?php if(strpos($dados->EnsMedio, 'particular sem bolsa') !== FALSE){ echo 'checked=checked';} ?> class="form-check-input" name="inputEnsMedio[]" type="checkbox" id="particular_sem_bolsa" value="particular sem bolsa">
            <label class="form-check-label" for="inputEnsMedio2">Particular sem bolsa</label>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputPorcentagemBolsaMedio">Particular com bolsa de:</label>
          <input max="100" pattern="[0-9]{1,3}" type="number" class="form-control" id="inputPorcentagemBolsaMedio" name="inputPorcentagemBolsaMedio" aria-describedby="inputPorcentagemBolsaMedioHelp" value="{{ $dados->PorcentagemBolsaMedio }}">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputVestibular">Já prestou algum vestibular?</label>
          <br>
          <div id="Vestibular" class="form-check form-check-inline">
            <input <?php if($dados->Vestibular == 'sim'){ echo 'checked=checked';} ?> class="form-check-input" type="radio" name="inputVestibular" id="inputVestibular1" value="sim" onclick="showInput('.dados-faculdade')">
            <label class="form-check-label" for="inputVestibular1">Sim</label>
          </div>
          <div class="form-check form-check-inline">
            <input <?php if($dados->Vestibular == 'nao'){ echo 'checked=checked';} ?> class="form-check-input" type="radio" name="inputVestibular" id="inputVestibular2" value="nao" onclick="hideInput('.dados-faculdade')">
            <label class="form-check-label" for="inputVestibular2">Não</label>
          </div>
        </div>
      </div>
      <div class="col">
        @if($dados->Vestibular == 'sim')
        <div class="form-group dados-faculdade">
          <label for="inputFaculdadeTipo">Faculdade pública ou particular?</label>
          <br>
          <div class="form-check form-check-inline">
            <input <?php if($dados->FaculdadeTipo == 'publica'){ echo 'checked=checked';} ?> class="form-check-input" type="radio" name="inputFaculdadeTipo" id="inputFaculdadeTipo1" value="publica">
            <label class="form-check-label" for="inputFaculdadeTipo1">Pública</label>
          </div>
          <div class="form-check form-check-inline">
            <input <?php if($dados->FaculdadeTipo == 'particular'){ echo 'checked=checked';} ?> class="form-check-input" type="radio" name="inputFaculdadeTipo" id="inputFaculdadeTipo2" value="particular">
            <label class="form-check-label" for="inputFaculdadeTipo2">Particular</label>
          </div>
        </div>
        @endif
      </div>
      <div class="col">
        @if($dados->Vestibular == 'sim')
        <div class="form-group dados-faculdade">
          <label for="inputNomeFaculdade">Qual nome da Faculdade?</label>
          <input type="text" class="form-control" id="inputNomeFaculdade" name="inputNomeFaculdade" aria-describedby="inputNomeFaculdadeHelp" value="{{ $dados->NomeFaculdade }}">
        </div>
        @else
        <div class="form-group dados-faculdade" style="display:none;">
          <label for="inputNomeFaculdade">Qual nome da Faculdade?</label>
          <input type="text" class="form-control" id="inputNomeFaculdade" name="inputNomeFaculdade" aria-describedby="inputNomeFaculdadeHelp" value="{{ $dados->NomeFaculdade }}">
        </div>
        @endif
      </div>
    </div>
    <div class="row mb-2">
      <div class="col">
        @if($dados->Vestibular == 'sim')
        <div class="form-group dados-faculdade">
          <label for="inputCursoFaculdade">Curso</label>
          <input type="text" class="form-control" id="inputCursoFaculdade" name="inputCursoFaculdade" aria-describedby="inputCursoFaculdadeHelp" value="{{ $dados->CursoFaculdade }}">
        </div>
        @else
        <div class="form-group dados-faculdade" style="display:none;">
          <label for="inputCursoFaculdade">Curso</label>
          <input type="text" class="form-control" id="inputCursoFaculdade" name="inputCursoFaculdade" aria-describedby="inputCursoFaculdadeHelp" value="{{ $dados->CursoFaculdade }}">
        </div>
        @endif
      </div>
      <div class="col">
        @if($dados->Vestibular == 'sim')
        <div class="form-group dados-faculdade">
          <label for="inputAnoFaculdade">Ano</label>
          <select name="inputAnoFaculdade" class="custom-select">
            <option value="" selected>Selecione</option>
            <option <?php if($dados->AnoFaculdade == '1969'){ echo 'selected=selected';} ?> value="1969">1969</option>
            <option <?php if($dados->AnoFaculdade == '1970'){ echo 'selected=selected';} ?> value="1970">1970</option>
            <option <?php if($dados->AnoFaculdade == '1971'){ echo 'selected=selected';} ?> value="1971">1971</option>
            <option <?php if($dados->AnoFaculdade == '1972'){ echo 'selected=selected';} ?> value="1972">1972</option>
            <option <?php if($dados->AnoFaculdade == '1973'){ echo 'selected=selected';} ?> value="1973">1973</option>
            <option <?php if($dados->AnoFaculdade == '1974'){ echo 'selected=selected';} ?> value="1974">1974</option>
            <option <?php if($dados->AnoFaculdade == '1975'){ echo 'selected=selected';} ?> value="1975">1975</option>
            <option <?php if($dados->AnoFaculdade == '1976'){ echo 'selected=selected';} ?> value="1976">1976</option>
            <option <?php if($dados->AnoFaculdade == '1977'){ echo 'selected=selected';} ?> value="1977">1977</option>
            <option <?php if($dados->AnoFaculdade == '1978'){ echo 'selected=selected';} ?> value="1978">1978</option>
            <option <?php if($dados->AnoFaculdade == '1979'){ echo 'selected=selected';} ?> value="1979">1979</option>
            <option <?php if($dados->AnoFaculdade == '1980'){ echo 'selected=selected';} ?> value="1980">1980</option>
            <option <?php if($dados->AnoFaculdade == '1981'){ echo 'selected=selected';} ?> value="1981">1981</option>
            <option <?php if($dados->AnoFaculdade == '1982'){ echo 'selected=selected';} ?> value="1982">1982</option>
            <option <?php if($dados->AnoFaculdade == '1983'){ echo 'selected=selected';} ?> value="1983">1983</option>
            <option <?php if($dados->AnoFaculdade == '1984'){ echo 'selected=selected';} ?> value="1984">1984</option>
            <option <?php if($dados->AnoFaculdade == '1985'){ echo 'selected=selected';} ?> value="1985">1985</option>
            <option <?php if($dados->AnoFaculdade == '1986'){ echo 'selected=selected';} ?> value="1986">1986</option>
            <option <?php if($dados->AnoFaculdade == '1987'){ echo 'selected=selected';} ?> value="1987">1987</option>
            <option <?php if($dados->AnoFaculdade == '1988'){ echo 'selected=selected';} ?> value="1988">1988</option>
            <option <?php if($dados->AnoFaculdade == '1989'){ echo 'selected=selected';} ?> value="1989">1989</option>
            <option <?php if($dados->AnoFaculdade == '1990'){ echo 'selected=selected';} ?> value="1990">1990</option>
            <option <?php if($dados->AnoFaculdade == '1991'){ echo 'selected=selected';} ?> value="1991">1991</option>
            <option <?php if($dados->AnoFaculdade == '1992'){ echo 'selected=selected';} ?> value="1992">1992</option>
            <option <?php if($dados->AnoFaculdade == '1993'){ echo 'selected=selected';} ?> value="1993">1993</option>
            <option <?php if($dados->AnoFaculdade == '1994'){ echo 'selected=selected';} ?> value="1994">1994</option>
            <option <?php if($dados->AnoFaculdade == '1995'){ echo 'selected=selected';} ?> value="1995">1995</option>
            <option <?php if($dados->AnoFaculdade == '1996'){ echo 'selected=selected';} ?> value="1996">1996</option>
            <option <?php if($dados->AnoFaculdade == '1997'){ echo 'selected=selected';} ?> value="1997">1997</option>
            <option <?php if($dados->AnoFaculdade == '1998'){ echo 'selected=selected';} ?> value="1998">1998</option>
            <option <?php if($dados->AnoFaculdade == '1999'){ echo 'selected=selected';} ?> value="1999">1999</option>
            <option <?php if($dados->AnoFaculdade == '2000'){ echo 'selected=selected';} ?> value="2000">2000</option>
            <option <?php if($dados->AnoFaculdade == '2001'){ echo 'selected=selected';} ?> value="2001">2001</option>
            <option <?php if($dados->AnoFaculdade == '2002'){ echo 'selected=selected';} ?> value="2002">2002</option>
            <option <?php if($dados->AnoFaculdade == '2003'){ echo 'selected=selected';} ?> value="2003">2003</option>
            <option <?php if($dados->AnoFaculdade == '2004'){ echo 'selected=selected';} ?> value="2004">2004</option>
            <option <?php if($dados->AnoFaculdade == '2005'){ echo 'selected=selected';} ?> value="2005">2005</option>
            <option <?php if($dados->AnoFaculdade == '2006'){ echo 'selected=selected';} ?> value="2006">2006</option>
            <option <?php if($dados->AnoFaculdade == '2007'){ echo 'selected=selected';} ?> value="2007">2007</option>
            <option <?php if($dados->AnoFaculdade == '2008'){ echo 'selected=selected';} ?> value="2008">2008</option>
            <option <?php if($dados->AnoFaculdade == '2009'){ echo 'selected=selected';} ?> value="2009">2009</option>
            <option <?php if($dados->AnoFaculdade == '2010'){ echo 'selected=selected';} ?> value="2010">2010</option>
            <option <?php if($dados->AnoFaculdade == '2011'){ echo 'selected=selected';} ?> value="2011">2011</option>
            <option <?php if($dados->AnoFaculdade == '2012'){ echo 'selected=selected';} ?> value="2012">2012</option>
            <option <?php if($dados->AnoFaculdade == '2013'){ echo 'selected=selected';} ?> value="2013">2013</option>
            <option <?php if($dados->AnoFaculdade == '2014'){ echo 'selected=selected';} ?> value="2014">2014</option>
            <option <?php if($dados->AnoFaculdade == '2015'){ echo 'selected=selected';} ?> value="2015">2015</option>
            <option <?php if($dados->AnoFaculdade == '2016'){ echo 'selected=selected';} ?> value="2016">2016</option>
            <option <?php if($dados->AnoFaculdade == '2017'){ echo 'selected=selected';} ?> value="2017">2017</option>
            <option <?php if($dados->AnoFaculdade == '2018'){ echo 'selected=selected';} ?> value="2018">2018</option>
            <option <?php if($dados->AnoFaculdade == '2019'){ echo 'selected=selected';} ?> value="2019">2019</option>
            <option <?php if($dados->AnoFaculdade == '2020'){ echo 'selected=selected';} ?> value="2020">2020</option>
            <option <?php if($dados->AnoFaculdade == '2021'){ echo 'selected=selected';} ?> value="2021">2021</option>
          </select>
        </div>
        @else
        <div class="form-group dados-faculdade" style="display:none;">
          <label for="inputAnoFaculdade">Ano</label>
          <select name="inputAnoFaculdade" class="custom-select">
            <option value="" selected>Selecione</option>
            <option <?php if($dados->AnoFaculdade == '1969'){ echo 'selected=selected';} ?> value="1969">1969</option>
            <option <?php if($dados->AnoFaculdade == '1970'){ echo 'selected=selected';} ?> value="1970">1970</option>
            <option <?php if($dados->AnoFaculdade == '1971'){ echo 'selected=selected';} ?> value="1971">1971</option>
            <option <?php if($dados->AnoFaculdade == '1972'){ echo 'selected=selected';} ?> value="1972">1972</option>
            <option <?php if($dados->AnoFaculdade == '1973'){ echo 'selected=selected';} ?> value="1973">1973</option>
            <option <?php if($dados->AnoFaculdade == '1974'){ echo 'selected=selected';} ?> value="1974">1974</option>
            <option <?php if($dados->AnoFaculdade == '1975'){ echo 'selected=selected';} ?> value="1975">1975</option>
            <option <?php if($dados->AnoFaculdade == '1976'){ echo 'selected=selected';} ?> value="1976">1976</option>
            <option <?php if($dados->AnoFaculdade == '1977'){ echo 'selected=selected';} ?> value="1977">1977</option>
            <option <?php if($dados->AnoFaculdade == '1978'){ echo 'selected=selected';} ?> value="1978">1978</option>
            <option <?php if($dados->AnoFaculdade == '1979'){ echo 'selected=selected';} ?> value="1979">1979</option>
            <option <?php if($dados->AnoFaculdade == '1980'){ echo 'selected=selected';} ?> value="1980">1980</option>
            <option <?php if($dados->AnoFaculdade == '1981'){ echo 'selected=selected';} ?> value="1981">1981</option>
            <option <?php if($dados->AnoFaculdade == '1982'){ echo 'selected=selected';} ?> value="1982">1982</option>
            <option <?php if($dados->AnoFaculdade == '1983'){ echo 'selected=selected';} ?> value="1983">1983</option>
            <option <?php if($dados->AnoFaculdade == '1984'){ echo 'selected=selected';} ?> value="1984">1984</option>
            <option <?php if($dados->AnoFaculdade == '1985'){ echo 'selected=selected';} ?> value="1985">1985</option>
            <option <?php if($dados->AnoFaculdade == '1986'){ echo 'selected=selected';} ?> value="1986">1986</option>
            <option <?php if($dados->AnoFaculdade == '1987'){ echo 'selected=selected';} ?> value="1987">1987</option>
            <option <?php if($dados->AnoFaculdade == '1988'){ echo 'selected=selected';} ?> value="1988">1988</option>
            <option <?php if($dados->AnoFaculdade == '1989'){ echo 'selected=selected';} ?> value="1989">1989</option>
            <option <?php if($dados->AnoFaculdade == '1990'){ echo 'selected=selected';} ?> value="1990">1990</option>
            <option <?php if($dados->AnoFaculdade == '1991'){ echo 'selected=selected';} ?> value="1991">1991</option>
            <option <?php if($dados->AnoFaculdade == '1992'){ echo 'selected=selected';} ?> value="1992">1992</option>
            <option <?php if($dados->AnoFaculdade == '1993'){ echo 'selected=selected';} ?> value="1993">1993</option>
            <option <?php if($dados->AnoFaculdade == '1994'){ echo 'selected=selected';} ?> value="1994">1994</option>
            <option <?php if($dados->AnoFaculdade == '1995'){ echo 'selected=selected';} ?> value="1995">1995</option>
            <option <?php if($dados->AnoFaculdade == '1996'){ echo 'selected=selected';} ?> value="1996">1996</option>
            <option <?php if($dados->AnoFaculdade == '1997'){ echo 'selected=selected';} ?> value="1997">1997</option>
            <option <?php if($dados->AnoFaculdade == '1998'){ echo 'selected=selected';} ?> value="1998">1998</option>
            <option <?php if($dados->AnoFaculdade == '1999'){ echo 'selected=selected';} ?> value="1999">1999</option>
            <option <?php if($dados->AnoFaculdade == '2000'){ echo 'selected=selected';} ?> value="2000">2000</option>
            <option <?php if($dados->AnoFaculdade == '2001'){ echo 'selected=selected';} ?> value="2001">2001</option>
            <option <?php if($dados->AnoFaculdade == '2002'){ echo 'selected=selected';} ?> value="2002">2002</option>
            <option <?php if($dados->AnoFaculdade == '2003'){ echo 'selected=selected';} ?> value="2003">2003</option>
            <option <?php if($dados->AnoFaculdade == '2004'){ echo 'selected=selected';} ?> value="2004">2004</option>
            <option <?php if($dados->AnoFaculdade == '2005'){ echo 'selected=selected';} ?> value="2005">2005</option>
            <option <?php if($dados->AnoFaculdade == '2006'){ echo 'selected=selected';} ?> value="2006">2006</option>
            <option <?php if($dados->AnoFaculdade == '2007'){ echo 'selected=selected';} ?> value="2007">2007</option>
            <option <?php if($dados->AnoFaculdade == '2008'){ echo 'selected=selected';} ?> value="2008">2008</option>
            <option <?php if($dados->AnoFaculdade == '2009'){ echo 'selected=selected';} ?> value="2009">2009</option>
            <option <?php if($dados->AnoFaculdade == '2010'){ echo 'selected=selected';} ?> value="2010">2010</option>
            <option <?php if($dados->AnoFaculdade == '2011'){ echo 'selected=selected';} ?> value="2011">2011</option>
            <option <?php if($dados->AnoFaculdade == '2012'){ echo 'selected=selected';} ?> value="2012">2012</option>
            <option <?php if($dados->AnoFaculdade == '2013'){ echo 'selected=selected';} ?> value="2013">2013</option>
            <option <?php if($dados->AnoFaculdade == '2014'){ echo 'selected=selected';} ?> value="2014">2014</option>
            <option <?php if($dados->AnoFaculdade == '2015'){ echo 'selected=selected';} ?> value="2015">2015</option>
            <option <?php if($dados->AnoFaculdade == '2016'){ echo 'selected=selected';} ?> value="2016">2016</option>
            <option <?php if($dados->AnoFaculdade == '2017'){ echo 'selected=selected';} ?> value="2017">2017</option>
            <option <?php if($dados->AnoFaculdade == '2018'){ echo 'selected=selected';} ?> value="2018">2018</option>
            <option <?php if($dados->AnoFaculdade == '2019'){ echo 'selected=selected';} ?> value="2019">2019</option>
            <option <?php if($dados->AnoFaculdade == '2020'){ echo 'selected=selected';} ?> value="2020">2020</option>
            <option <?php if($dados->AnoFaculdade == '2021'){ echo 'selected=selected';} ?> value="2021">2021</option>
          </select>
        </div>
        @endif
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <p>Para qual (quais) curso(s) pretende prestar vestibular?</p>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputOpcoesVestibular1">Primeira Opção</label>
          <input type="text" class="form-control" id="inputOpcoesVestibular1" name="inputOpcoesVestibular1" aria-describedby="inputOpcoesVestibular1Help" value="{{ $dados->OpcoesVestibular1 }}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputOpcoesVestibular2">Segunda Opção</label>
          <input type="text" class="form-control" id="inputOpcoesVestibular2" name="inputOpcoesVestibular2" aria-describedby="inputOpcoesVestibular2Help" value="{{ $dados->OpcoesVestibular2 }}">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputVestibularOutraCidade">Quanto à Universidade, tem disponibilidade/interesse de estudar em outras cidades?</label>
          <select name="inputVestibularOutraCidade" class="custom-select">
            <option value="" selected>Selecione</option>
            <option <?php if($dados->VestibularOutraCidade == 'sim'){ echo 'selected=selected';} ?> value="sim">Sim</option>
            <option <?php if($dados->VestibularOutraCidade == 'nao'){ echo 'selected=selected';} ?> value="nao">Não</option>
          </select>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputComoSoube">Como você ficou sabendo do cursinho pré-vestibular da UNEafro Brasil?</label>
          <select id="comoSoube" name="inputComoSoube" class="custom-select" onchange="checkComosoube()">
            <option value="" selected>Selecione</option>
            <option <?php if($dados->ComoSoube == 'internet'){ echo 'selected=selected';} ?> value="internet">Internet</option>
            <option <?php if($dados->ComoSoube == 'panfleto'){ echo 'selected=selected';} ?> value="panfleto">Panfleto</option>
            <option <?php if($dados->ComoSoube == 'amigos'){ echo 'selected=selected';} ?> value="amigos">Amigos</option>
            <option <?php if($dados->ComoSoube == 'jornal'){ echo 'selected=selected';} ?> value="jornal">Jornal</option>
            <option <?php if($dados->ComoSoube == 'outros'){ echo 'selected=selected';} ?> value="outros">Outros</option>
          </select>
        </div>
      </div>
      <div class="col">
        @if($dados->ComoSoube == 'outros')
        <div id="ComoSoubeOutros" class="form-group">
          <label for="inputComoSoubeOutros">Qual?</label><br><br>
          <input type="text" class="form-control" id="inputComoSoubeOutros" name="inputComoSoubeOutros" aria-describedby="inputComoSoubeOutrosHelp" value="{{ $dados->ComoSoubeOutros }}">
        </div>
        @else
        <div id="ComoSoubeOutros" class="form-group" style="display:none;">
          <label for="inputComoSoubeOutros">Qual?</label><br><br>
          <input type="text" class="form-control" id="inputComoSoubeOutros" name="inputComoSoubeOutros" aria-describedby="inputComoSoubeOutrosHelp" value="{{ $dados->ComoSoubeOutros }}">
        </div>
        @endif
      </div>
    </div>
    <div class="row mb-5">
      <div class="col">
        <button type="submit" class="btn btn-lg btn-block btn-danger">Salvar Dados</button>
      </div>
      <div class="col">
        <a class="btn btn-lg btn-block btn-success" href="/alunos">Voltar</a>
      </div>
    </div>
  </form>

  <!-- FAMILIA INFO MODAL -->
  <div id="modal-dados-familia" class="modal fade modal-dados-familia" tabindex="-1" role="dialog" aria-labelledby="ModalFamilyInfoLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Informações da Família</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="parentesForm" method="POST" action="/alunos/familiares/add">
          @csrf
          <input type="hidden" name="inputIdUser" value="{{ $dados->id_user }}">
          <input type="hidden" name="inputIdAluno" value="{{ $dados->id }}">
          <div class="container-fluid p-3">
            <div id="item" class="stage">
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="inputGrauParentesco">Grau de Parentesco</label>
                    <select name="inputGrauParentesco" class="custom-select">
                      <option selected>Selecione</option>
                      <option value="pai">Pai</option>
                      <option value="mae">Mãe</option>
                      <option value="madrasta">Madrasta</option>
                      <option value="padrasto">Padrasto</option>
                      <option value="irmao_a">Irmão/ã</option>
                      <option value="avo">Avô/Avó</option>
                      <option value="primo_a">Primo/a</option>
                      <option value="sobrinho_a">Sobrinho/a</option>
                      <option value="tio_a">Tio/a</option>
                    </select>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="inputIdade">Idade</label>
                    <input type="number" class="form-control" id="inputIdade" name="inputIdade" aria-describedby="inputIdadeHelp" placeholder="Idade">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="inputEstadoCivil">Estado Civil</label>
                    <select name="inputEstadoCivil" class="custom-select">
                      <option selected>Selecione</option>
                      <option value="solteiro_a">Solteiro(a)</option>
                      <option value="casado_a">Casado(a)</option>
                      <option value="uniao_estavel">União Estável</option>
                      <option value="divorciado_a">Divorciado(a)</option>
                      <option value="viuvo_a">Viúvo(a)</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="inputEscolaridade">Escolaridade</label>
                    <select name="inputEscolaridade" class="custom-select">
                      <option selected>Selecione</option>
                      <option value="fundamental_completo">Ensino Fundamental Completo</option>
                      <option value="fundamental_incompleto">Ensino Fundamental Incompleto</option>
                      <option value="medio_completo">Ensino Médio Completo</option>
                      <option value="medio_incompleto">Ensino Médio Incompleto</option>
                      <option value="superior_completo">Ensino Superior Completo</option>
                      <option value="superior_incompleto">Ensino Superior Incompleto</option>
                    </select>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="inputProfissao">Profissão</label>
                    <input type="text" class="form-control" id="inputProfissao" name="inputProfissao" aria-describedby="inputProfissaoHelp" placeholder="Profissão">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="inputRenda">Renda Mensal R$</label>
                    <input type="number" class="form-control" id="inputRenda" name="inputRenda" aria-describedby="inputRendaHelp" placeholder="Ex: 1.200,00">
                  </div>
                </div>
              </div>
              <hr>
            </div>
            <div class="row">
              <div class="col-6 m-auto">
                <button type="button" class="btn btn-primary btn-block" onclick="sendParents()">Salvar Item</button>
              </div>
              <div class="col-6 m-auto">
                <button type="button" class="btn btn-danger btn-block" data-dismiss="modal" aria-label="Close">Fechar Aba</button>
              </div>
            </div>
            <hr>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- FAMILIA INFO MODAL END -->

</div>
<script>
$(document).ready(function(){
  $("#modal-dados-familia").on('hidden.bs.modal', function(){
    location.reload();
  });
});
</script>
@endsection
