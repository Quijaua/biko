@extends('layouts.app')

@section('content')
<div class="container">
  <!-- PAGE HEADER -->
  <div class="row">
      <div class="col-12 text-center">
        <h1>CADASTRO DE ALUNOS</h1>
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
  @if(\Session::has('error'))
  <div class="row mt-2">
    <div class="col">
      <div class="alert alert-danger text-center" role="alert">
        {!! \Session::get('error') !!}
      </div>
    </div>
  </div>
  @endif

  <form method="POST" action="/alunos/create" enctype="multipart/form-data">
    @csrf
    <h3>DADOS PESSOAIS</h3>
    <div class="row">
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputNomeAluno">Nome do aluno</label>
          <input type="text" class="form-control" id="inputNomeAluno" name="inputNomeAluno" aria-describedby="inputNomeAlunoHelp" placeholder="Nome do novo aluno" required>
        </div>
      </div>
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputNomeSocial">Nome Social do aluno</label>
          <input type="text" class="form-control" id="inputNomeSocial" name="inputNomeSocial" aria-describedby="inputNomeSocialHelp" placeholder="Nome social do aluno">
        </div>
      </div>
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputNucleo">Núcleo</label>
          <select name="inputNucleo" class="form-select" required>
            <option selected>Selecione</option>
            @foreach($nucleos as $nucleo)
            @if($user->role === 'aluno')
            <option value="{{ $nucleo->id }}">{{ $nucleo->NomeNucleo }} - {{ $nucleo->InfoInscricao }}</option>
            @else
            <option value="{{ $nucleo->id }}">{{ $nucleo->NomeNucleo }}</option>
            @endif
            @endforeach
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputFoto">Foto</label>
          <input name="inputFoto" type="file" class="form-control-file" id="inputFoto">
        </div>
      </div>
      <div class="col mt-2">
        <small class="form-text text-muted">Arquivos devem ter menos que <strong>8 MB</strong>.</small>
        <small class="form-text text-muted">Tipos de arquivos permitidos: <strong>png gif jpg jpeg</strong>.</small>
      </div>
      <div class="col">
        <div class="mb-3">
          <!--<label class="form-label mb-2" for="inputListaEspera">Lista de Espera</label>--><br />
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputListaEspera" type="checkbox" value="Sim" checked>
            <label class="form-label mb-2" class="form-check-label" for="inputListaEspera">Lista de Espera</label>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <!--<div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputCPF">CPF</label>
          <input type="text" class="form-control" id="inputCPF" name="inputCPF" aria-describedby="inputCPFHelp" data-mask="000.000.000-00" placeholder="xxx.xxx.xxx-xx" onblur="checkCPF()" required>
        </div>
      </div>
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputRG">RG</label>
          <input type="text" class="form-control" id="inputRG" name="inputRG" aria-describedby="inputRGHelp" data-mask="00.000.000-00" placeholder="xx.xxx.xxx-x">
        </div>
      </div>-->
      <div class="col">
        <label class="form-label mb-2" for="temFilhos">Tem filhos?</label>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="temFilhos" id="temFilhos1" value="1">
          <label class="form-label mb-2" class="form-check-label" for="temFilhos1">
            Sim
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="temFilhos" id="temFilhos2" value="0" checked>
          <label class="form-label mb-2" class="form-check-label" for="temFilhos2">
            Não
          </label>
        </div>
      </div>
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="filhosQt">Quantos?</label>
          <input class="form-control" type="number" id="filhosQt" name="filhosQt">
        </div>
      </div>
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputEmail">Email</label>
          <input type="email" class="form-control" id="inputEmail" name="inputEmail" aria-describedby="inputEmailHelp" placeholder="Endereço de Email" required>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputRaca">Raça / Cor</label>
          <select name="inputRaca" class="form-select" required>
            <option value="" selected>Selecione</option>
            <option value="negra">Preta</option>
            <option value="branca">Branca</option>
            <option value="parda">Parda</option>
            <option value="amarela">Amarela</option>
            <option value="indigena">Indígena</option>
          </select>
        </div>
      </div>
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputGenero">Identidade de Gênero</label>
          <select name="inputGenero" class="form-select" required>
            <option value="" selected>Selecione</option>
            <option value="mulher">Mulher (Cis/Trans)</option>
            <option value="homem">Homem (Cis/Trans)</option>
            <option value="nao_binarie">Não Binárie</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputEstadoCivil">Estado Civil</label>
          <select name="inputEstadoCivil" class="form-select">
            <option value="" selected>Selecione</option>
            <option value="solteiro_a">Solteiro(a)</option>
            <option value="casado_a">Casado(a)</option>
            <option value="uniao_estavel">União Estável</option>
            <option value="divorciado_a">Divorciado(a)</option>
            <option value="viuvo_a">Viúvo(a)</option>
          </select>
        </div>
      </div>
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputNascimento">Data de Nascimento</label>
          <input type="date" class="form-control" id="inputNascimento" name="inputNascimento" aria-describedby="inputNascimentoHelp" onblur="getAge()" required>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputAuxGoverno">A família recebe algumn tipo de auxílio do Governo?</label>
          <div id="AuxGoverno" class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inputAuxGoverno" id="inputAuxGoverno1" value="sim" onclick="showInput('#AuxTipo')">
            <label class="form-label mb-2" class="form-check-label" for="inputTaxaInscricao1">Sim</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inputAuxGoverno" id="inputAuxGoverno2" value="nao" onclick="hideAuxInput('#AuxTipo')">
            <label class="form-label mb-2" class="form-check-label" for="inputTaxaInscricao2">Não</label>
          </div>
        </div>
      </div>
      <div class="col">
        <div id="AuxTipo" class="mb-3" style="display:none;">
          <label class="form-label mb-2" for="inputAuxTipo">Qual?</label>
          <select name="inputAuxTipo" class="form-select">
            <option value="" selected>Selecione</option>
            <option value="bolsa_familia">Programa Bolsa Família</option>
            <option value="energia_eletrica">Tarifa Social de Energia Elétrica</option>
            <option value="emergencial_financeiro">Auxílio Emergencial Financeiro</option>
            <option value="bolsa_verde">Bolsa Verde</option>
          </select>
        </div>
      </div>
    </div>
    <hr>
    <h3>ENDEREÇO</h3>
    <div class="row">
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputCEP">CEP (Somente números)</label>
          <input type="text" class="form-control" id="inputCEP" name="inputCEP" aria-describedby="inputCEPHelp" data-mask="00000-000" placeholder="xx.xxx-xxx" onblur="checkCEP('#inputCEP')">
        </div>
      </div>
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputEndereco">Rua</label>
          <input pattern="([^\s][A-zÀ-ž\s]+)" type="text" class="form-control" id="inputEndereco" name="inputEndereco" aria-describedby="inputEnderecoHelp" placeholder="Rua, Avenida, Logradoouro">
        </div>
      </div>
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputNumero">Número</label>
          <input type="number" class="form-control" id="inputNumero" name="inputNumero" aria-describedby="inputNumeroHelp" placeholder="Número">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputBairro">Distrito</label>
          <input type="text" class="form-control" id="inputBairro" name="inputBairro" aria-describedby="inputBairroHelp" placeholder="Bairro">
        </div>
      </div>
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputCidade">Cidade</label>
          <input type="text" class="form-control" id="inputCidade" name="inputCidade" aria-describedby="inputCidadeHelp" placeholder="Cidade/Município">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputEstado">Estado</label>
          <select id="inputEstado" name="inputEstado" class="form-select">
            <option value="" selected>Selecione</option>
            <option value="AC">Acre</option>
            <option value="AL">Alagoas</option>
            <option value="AP">Amapá</option>
            <option value="AM">Amazonas</option>
            <option value="BA">Bahia</option>
            <option value="CE">Ceará</option>
            <option value="DF">Distrito Federal</option>
            <option value="ES">Espírito Santo</option>
            <option value="GO">Goiás</option>
            <option value="MA">Maranhão</option>
            <option value="MT">Mato Grosso</option>
            <option value="MS">Mato Grosso do Sul</option>
            <option value="MG">Minas Gerais</option>
            <option value="PA">Pará</option>
            <option value="PB">Paraíba</option>
            <option value="PR">Paraná</option>
            <option value="PE">Pernambuco</option>
            <option value="PI">Piauí</option>
            <option value="RJ">Rio de Janeiro</option>
            <option value="RN">Rio Grande do Norte</option>
            <option value="RS">Rio Grande do Sul</option>
            <option value="RO">Rondônia</option>
            <option value="RR">Roraima</option>
            <option value="SC">Santa Catarina</option>
            <option value="SP">São Paulo</option>
            <option value="SE">Sergipe</option>
            <option value="TO">Tocantins</option>
            <option value="EX">Estrangeiro</option>
          </select>
        </div>
      </div>
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputComplemento">Complemento</label>
          <input type="text" class="form-control" id="inputComplemento" name="inputComplemento" aria-describedby="inputComplementoHelp" placeholder="Complemento">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputFoneComercial">Telefone Comercial</label>
          <input type="text" class="form-control" id="inputFoneComercial" name="inputFoneComercial" aria-describedby="inputFoneComercialHelp" data-mask="(00) 0000-0000" placeholder="(xx)xxxx-xxxx">
        </div>
      </div>
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputFoneResidencial">Telefone Residencial</label>
          <input type="text" class="form-control" id="inputFoneResidencial" name="inputFoneResidencial" aria-describedby="inputFoneResidencialHelp" data-mask="(00) 0000-0000" placeholder="(xx)xxxx-xxxx">
        </div>
      </div>
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputFoneCelular">Telefone Celular</label>
          <input type="text" class="form-control" id="inputFoneCelular" name="inputFoneCelular" aria-describedby="inputFoneCelularHelp" data-mask="(00) 0 0000-0000" placeholder="(xx)xxxx-xxxx">
        </div>
      </div>
    </div>
    <hr>
    <h3>DADOS PROFISSIONAIS</h3>
    <div class="row">
      <div class="col-12 col-md-6">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputRamoAtuacao">Você trabalha no ramo da:</label>
          <select id="inputRamoAtuacao" name="inputRamoAtuacao" class="form-select">
            <option value="Educação">Educação</option>
            <option value="Pesquisa">Pesquisa</option>
            <option value="Telemarketing">Telemarketing</option>
            <option value="Comércio">Comércio</option>
            <option value="Indústria">Indústria</option>
            <option value="Construção Civil">Construção Civil</option>
            <option value="Beleza e Cuidados">Beleza e Cuidados</option>
            <option value="Serviços gerais">Serviços gerais</option>
            <option value="Limpeza e Higiene">Limpeza e Higiene</option>
            <option value="Gastronomia/Alimentação">Gastronomia/Alimentação</option>
            <option value="Entrega/Delivery">Entrega/Delivery</option>
            <option value="Saúde/Bem-Estar">Saúde/Bem-Estar</option>
            <option value="Segurança">Segurança</option>
            <option value="Transporte de pessoas/Aplicativos">Transporte de pessoas/Aplicativos</option>
            <option value="Outros">Outros</option>
          </select>
        </div>
      </div>
      <div class="col-12 col-md-6">
        <label class="form-label mb-2" for="inputRamoAtuacaoOutros">&nbsp;</label>
        <input type="text" class="form-control" id="inputRamoAtuacaoOutros" name="inputRamoAtuacaoOutros" aria-describedby="inputRamoAtuacaoOutrosHelp" placeholder="Outros (Especifique)">
      </div>
    </div>
    <!--<div class="row">
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputEmpresa">Nome da Empresa</label>
          <input type="text" class="form-control" id="inputEmpresa" name="inputEmpresa" aria-describedby="inputEmpresaHelp" placeholder="Nome da empresa onde trabalha">
        </div>
      </div>
    </div>-->
    <!--<div class="row">
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputCEPEmpresa">CEP</label>
          <input type="text" class="form-control" id="inputCEPEmpresa" name="inputCEPEmpresa" aria-describedby="inputCEPEmpresaHelp" data-mask="00000-000" placeholder="xx.xxx-xxx" onblur="checkCEP('#inputCEPEmpresa')">
        </div>
      </div>
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputEnderecoEmpresa">Rua</label>
          <input pattern="([^\s][A-zÀ-ž\s]+)" type="text" class="form-control" id="inputEnderecoEmpresa" name="inputEnderecoEmpresa" aria-describedby="inputEnderecoEmpresaHelp" placeholder="Rua, Avenida, Logradouro">
        </div>
      </div>
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputNumeroEmpresa">Número</label>
          <input type="text" class="form-control" id="inputNumeroEmpresa" name="inputNumeroEmpresa" aria-describedby="inputNumeroEmpresaHelp" placeholder="Número">
        </div>
      </div>
    </div>-->
    <!--<div class="row">
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputBairroEmpresa">Bairro</label>
          <input type="text" class="form-control" id="inputBairroEmpresa" name="inputBairroEmpresa" aria-describedby="inputBairroEmpresaHelp" placeholder="Bairro da empresa onde trabalha">
        </div>
      </div>
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputCidadeEmpresa">Cidade</label>
          <input type="text" class="form-control" id="inputCidadeEmpresa" name="inputCidadeEmpresa" aria-describedby="inputCidadeEmpresaHelp" placeholder="Cidade da empresa onde trabalha">
        </div>
      </div>
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputComplementoEmpresa">Complemento</label>
          <input type="text" class="form-control" id="inputComplementoEmpresa" name="inputComplementoEmpresa" aria-describedby="inputComplementoEmpresaHelp" placeholder="Complemento">
        </div>
      </div>
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputEstadoEmpresa">Estado</label>
          <select id="inputEstadoEmpresa" name="inputEstadoEmpresa" class="form-select">
            <option value="" selected>Selecione</option>
            <option value="AC">Acre</option>
            <option value="AL">Alagoas</option>
            <option value="AP">Amapá</option>
            <option value="AM">Amazonas</option>
            <option value="BA">Bahia</option>
            <option value="CE">Ceará</option>
            <option value="DF">Distrito Federal</option>
            <option value="ES">Espírito Santo</option>
            <option value="GO">Goiás</option>
            <option value="MA">Maranhão</option>
            <option value="MT">Mato Grosso</option>
            <option value="MS">Mato Grosso do Sul</option>
            <option value="MG">Minas Gerais</option>
            <option value="PA">Pará</option>
            <option value="PB">Paraíba</option>
            <option value="PR">Paraná</option>
            <option value="PE">Pernambuco</option>
            <option value="PI">Piauí</option>
            <option value="RJ">Rio de Janeiro</option>
            <option value="RN">Rio Grande do Norte</option>
            <option value="RS">Rio Grande do Sul</option>
            <option value="RO">Rondônia</option>
            <option value="RR">Roraima</option>
            <option value="SC">Santa Catarina</option>
            <option value="SP">São Paulo</option>
            <option value="SE">Sergipe</option>
            <option value="TO">Tocantins</option>
            <option value="EX">Estrangeiro</option>
          </select>
        </div>
      </div>
    </div>-->
    <!--<div class="row">
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputCargo">Cargo/Função</label>
          <input type="text" class="form-control" id="inputCargo" name="inputCargo" aria-describedby="inputCargoHelp" placeholder="Cargo ocupado na empresa">
        </div>
      </div>
    </div>-->
    <!--<div class="row">
      <div class="col-12">
        <p>Horário de Trabalho</p>
      </div>
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputHorarioFrom">De</label>
          <input type="time" class="form-control" id="inputHorarioFrom" name="inputHorarioFrom" aria-describedby="inputHorarioFromHelp">
        </div>
      </div>
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputHorarioTo">Até</label>
          <input type="time" class="form-control" id="inputHorarioTo" name="inputHorarioTo" aria-describedby="inputHorarioToHelp">
        </div>
      </div>
    </div>-->
    <hr>
    <!--
    <h3>DADOS FAMILIARES</h3>
    <div class="row">
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputNomeMae">Nome da Mãe</label>
          <input type="text" class="form-control" id="inputNomeMae" name="inputNomeMae" aria-describedby="inputNomeMaeHelp" placeholder="Nome da mãe do aluno">
        </div>
      </div>
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputNomePai">Nome do Pai</label>
          <input type="text" class="form-control" id="inputNomePai" name="inputNomePai" aria-describedby="inputNomePaiHelp" placeholder="Nome do pai do aluno">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputCEPFamilia">CEP</label>
          <input type="text" class="form-control" id="inputCEPFamilia" name="inputCEPFamilia" aria-describedby="inputCEPFamiliaHelp" data-mask="00000-000" placeholder="xx.xxx-xxx" onblur="checkCEP('#inputCEPFamilia')">
        </div>
      </div>
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputEnderecoFamilia">Rua</label>
          <input pattern="([^\s][A-zÀ-ž\s]+)" type="text" class="form-control" id="inputEnderecoFamilia" name="inputEnderecoFamilia" aria-describedby="inputEnderecoFamiliaHelp" placeholder="Rua, Avenida, Logradouro">
        </div>
      </div>
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputNumeroFamilia">Número</label>
          <input type="text" class="form-control" id="inputNumeroFamilia" name="inputNumeroFamilia" aria-describedby="inputNumeroFamiliaHelp" placeholder="Número">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputComplementoFamilia">Complemento</label>
          <input type="text" class="form-control" id="inputComplementoFamilia" name="inputComplementoFamilia" aria-describedby="inputComplementoFamiliaHelp" placeholder="Complemento">
        </div>
      </div>
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputBairroFamilia">Bairro</label>
          <input type="text" class="form-control" id="inputBairroFamilia" name="inputBairroFamilia" aria-describedby="inputBairroFamiliaHelp" placeholder="Bairro da família do aluno">
        </div>
      </div>
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputCidadeFamilia">Cidade</label>
          <input type="text" class="form-control" id="inputCidadeFamilia" name="inputCidadeFamilia" aria-describedby="inputCidadeFamiliaHelp" placeholder="Cidade da família do aluno">
        </div>
      </div>
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputEstadoFamilia">Estado</label>
          <select id="inputEstadoFamilia" name="inputEstadoFamilia" class="form-select">
            <option value="" selected>Selecione</option>
            <option value="AC">Acre</option>
            <option value="AL">Alagoas</option>
            <option value="AP">Amapá</option>
            <option value="AM">Amazonas</option>
            <option value="BA">Bahia</option>
            <option value="CE">Ceará</option>
            <option value="DF">Distrito Federal</option>
            <option value="ES">Espírito Santo</option>
            <option value="GO">Goiás</option>
            <option value="MA">Maranhão</option>
            <option value="MT">Mato Grosso</option>
            <option value="MS">Mato Grosso do Sul</option>
            <option value="MG">Minas Gerais</option>
            <option value="PA">Pará</option>
            <option value="PB">Paraíba</option>
            <option value="PR">Paraná</option>
            <option value="PE">Pernambuco</option>
            <option value="PI">Piauí</option>
            <option value="RJ">Rio de Janeiro</option>
            <option value="RN">Rio Grande do Norte</option>
            <option value="RS">Rio Grande do Sul</option>
            <option value="RO">Rondônia</option>
            <option value="RR">Roraima</option>
            <option value="SC">Santa Catarina</option>
            <option value="SP">São Paulo</option>
            <option value="SE">Sergipe</option>
            <option value="TO">Tocantins</option>
            <option value="EX">Estrangeiro</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputTelefoneFamilia">Telefone</label>
          <input type="text" class="form-control" id="inputTelefoneFamilia" name="inputTelefoneFamilia" aria-describedby="inputTelefoneFamiliaHelp" data-mask="(00) 0000-0000" placeholder="(xx) xxxx-xxxx">
        </div>
      </div>
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputAuxGoverno">A família recebe algum tipo de auxílio do Governo?</label>
          <div id="AuxGoverno" class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inputAuxGoverno" id="inputAuxGoverno1" value="sim" onclick="showInput('#AuxTipo')">
            <label class="form-label mb-2" class="form-check-label" for="inputTaxaInscricao1">Sim</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inputAuxGoverno" id="inputAuxGoverno2" value="nao" onclick="hideInput('#AuxTipo')">
            <label class="form-label mb-2" class="form-check-label" for="inputTaxaInscricao2">Não</label>
          </div>
        </div>
      </div>
      <div class="col">
        <div id="AuxTipo" class="mb-3" style="display:none;">
          <label class="form-label mb-2" for="inputAuxTipo">Qual?</label>
          <select name="inputAuxTipo" class="form-select">
            <option value="" selected>Selecione</option>
            <option value="bolsa_familia">Programa Bolsa Família</option>
            <option value="energia_eletrica">Tarifa Social de Energia Elétrica</option>
            <option value="emergencial_financeiro">Auxílio Emergencial Financeiro</option>
            <option value="bolsa_verde">Bolsa Verde</option>
          </select>
        </div>
      </div>
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
        <div class="mb-3">
          <label class="form-label mb-2" for="inputEnsFundamental">Ensino Fundamental</label><br>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputEnsFundamental[]" type="checkbox" id="rede_publica" value="rede publica">
            <label class="form-label mb-2" class="form-check-label" for="inputEnsFundamental1">Rede Pública</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputEnsFundamental[]" type="checkbox" id="particular_sem_bolsa" value="particular sem bolsa">
            <label class="form-label mb-2" class="form-check-label" for="inputEnsFundamental2">Particular sem bolsa</label>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputPorcentagemBolsa">Particular com bolsa de:</label>
          <input max="100" pattern="[0-9]{1,3}" type="number" class="form-control" id="inputPorcentagemBolsa" name="inputPorcentagemBolsa" aria-describedby="inputPorcentagemBolsaHelp" placeholder="%">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputEnsMedio">Ensino Médio</label><br>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputEnsMedio[]" type="checkbox" id="rede_publica" value="rede publica">
            <label class="form-label mb-2" class="form-check-label" for="inputEnsMedio1">Rede Pública</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputinputEnsMedio[]" type="checkbox" id="particular_sem_bolsa" value="particular sem bolsa">
            <label class="form-label mb-2" class="form-check-label" for="inputEnsMedio2">Particular sem bolsa</label>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputPorcentagemBolsaMedio">Particular com bolsa de:</label>
          <input max="100" pattern="[0-9]{1,3}" type="number" class="form-control" id="inputPorcentagemBolsaMedio" name="inputPorcentagemBolsaMedio" aria-describedby="inputPorcentagemBolsaMedioHelp" placeholder="%">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputVestibular">Já prestou algum vestibular?</label>
          <br>
          <div id="Vestibular" class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inputVestibular" id="inputVestibular1" value="sim" onclick="showInput('.dados-faculdade')">
            <label class="form-label mb-2" class="form-check-label" for="inputVestibular1">Sim</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inputVestibular" id="inputVestibular2" value="nao" onclick="hideInput('.dados-faculdade')">
            <label class="form-label mb-2" class="form-check-label" for="inputVestibular2">Não</label>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="mb-3 dados-faculdade" style="display:none;">
          <label class="form-label mb-2" for="inputFaculdadeTipo">Faculdade pública ou particular?</label>
          <br>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inputFaculdadeTipo" id="inputFaculdadeTipo1" value="publica">
            <label class="form-label mb-2" class="form-check-label" for="inputFaculdadeTipo1">Pública</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inputFaculdadeTipo" id="inputFaculdadeTipo2" value="particular">
            <label class="form-label mb-2" class="form-check-label" for="inputFaculdadeTipo2">Particular</label>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="mb-3 dados-faculdade" style="display:none;">
          <label class="form-label mb-2" for="inputNomeFaculdade">Qual nome da Faculdade?</label>
          <input type="text" class="form-control" id="inputNomeFaculdade" name="inputNomeFaculdade" aria-describedby="inputNomeFaculdadeHelp" placeholder="Qual o nome da faculdade?">
        </div>
      </div>
    </div>
    <div class="row mb-2">
      <div class="col">
        <div class="mb-3 dados-faculdade" style="display:none;">
          <label class="form-label mb-2" for="inputCursoFaculdade">Curso</label>
          <input type="text" class="form-control" id="inputCursoFaculdade" name="inputCursoFaculdade" aria-describedby="inputCursoFaculdadeHelp" placeholder="Qual foi o curso?">
        </div>
      </div>
      <div class="col">
        <div class="mb-3 dados-faculdade" style="display:none;">
          <label class="form-label mb-2" for="inputAnoFaculdade">Ano</label>
          <select name="inputAnoFaculdade" class="form-select">
            <option value="" selected>Selecione</option>
            <option value="1969">1969</option>
            <option value="1970">1970</option>
            <option value="1971">1971</option>
            <option value="1972">1972</option>
            <option value="1973">1973</option>
            <option value="1974">1974</option>
            <option value="1975">1975</option>
            <option value="1976">1976</option>
            <option value="1977">1977</option>
            <option value="1978">1978</option>
            <option value="1979">1979</option>
            <option value="1980">1980</option>
            <option value="1981">1981</option>
            <option value="1982">1982</option>
            <option value="1983">1983</option>
            <option value="1984">1984</option>
            <option value="1985">1985</option>
            <option value="1986">1986</option>
            <option value="1987">1987</option>
            <option value="1988">1988</option>
            <option value="1989">1989</option>
            <option value="1990">1990</option>
            <option value="1991">1991</option>
            <option value="1992">1992</option>
            <option value="1993">1993</option>
            <option value="1994">1994</option>
            <option value="1995">1995</option>
            <option value="1996">1996</option>
            <option value="1997">1997</option>
            <option value="1998">1998</option>
            <option value="1999">1999</option>
            <option value="2000">2000</option>
            <option value="2001">2001</option>
            <option value="2002">2002</option>
            <option value="2003">2003</option>
            <option value="2004">2004</option>
            <option value="2005">2005</option>
            <option value="2006">2006</option>
            <option value="2007">2007</option>
            <option value="2008">2008</option>
            <option value="2009">2009</option>
            <option value="2010">2010</option>
            <option value="2011">2011</option>
            <option value="2012">2012</option>
            <option value="2013">2013</option>
            <option value="2014">2014</option>
            <option value="2015">2015</option>
            <option value="2016">2016</option>
            <option value="2017">2017</option>
            <option value="2018">2018</option>
            <option value="2019" selected="selected">2019</option>
            <option value="2020">2020</option>
            <option value="2021">2021</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <p>Para qual (quais) curso(s) pretende prestar vestibular?</p>
      </div>
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputOpcoesVestibular1">Primeira Opção</label>
          <input type="text" class="form-control" id="inputOpcoesVestibular1" name="inputOpcoesVestibular1" aria-describedby="inputOpcoesVestibular1Help" placeholder="Informe a primeira opção">
        </div>
      </div>
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputOpcoesVestibular2">Segunda Opção</label>
          <input type="text" class="form-control" id="inputOpcoesVestibular2" name="inputOpcoesVestibular2" aria-describedby="inputOpcoesVestibular2Help" placeholder="Informe a segunda opção">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputVestibularOutraCidade">Quanto à Universidade, tem disponibilidade/interesse de estudar em outras cidades?</label>
          <select name="inputVestibularOutraCidade" class="form-select">
            <option value="" selected>Selecione</option>
            <option value="sim">Sim</option>
            <option value="nao">Não</option>
          </select>
        </div>
      </div>
      <div class="col">
        <div class="mb-3">
          <label class="form-label mb-2" for="inputComoSoube">Como você ficou sabendo do cursinho pré-vestibular da UNEafro Brasil?</label>
          <select id="comoSoube" name="inputComoSoube" class="form-select" onchange="checkComosoube()">
            <option value="" selected>Selecione</option>
            <option value="internet">Internet</option>
            <option value="panfleto">Panfleto</option>
            <option value="amigos">Amigos</option>
            <option value="jornal">Jornal</option>
            <option value="outros">Outros</option>
          </select>
        </div>
      </div>
      <div class="col">
        <div id="ComoSoubeOutros" class="mb-3" style="display:none;">
          <label class="form-label mb-2" for="inputComoSoubeOutros">Qual?</label><br><br>
          <input type="text" class="form-control" id="inputComoSoubeOutros" name="inputComoSoubeOutros" aria-describedby="inputComoSoubeOutrosHelp">
        </div>
      </div>
      <input type="hidden" name="inputStatus" value="1">
    </div>
    <button type="submit" class="btn btn-primary">Salvar Dados</button>
  </form>

  <!-- FAMILIA INFO MODAL -->
  <!--<div id="modal-dados-familia" class="modal fade modal-dados-familia" tabindex="-1" role="dialog" aria-labelledby="ModalFamilyInfoLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Informações da Família</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="/alunos/familiares/add">
          @csrf
          <div class="container-fluid p-3">
            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <label class="form-label mb-2" for="inputGrauParentesco">Grau de Parentesco</label>
                  <select name="inputGrauParentesco" class="form-select">
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
                <div class="mb-3">
                  <label class="form-label mb-2" for="inputIdade">Idade</label>
                  <input type="number" class="form-control" id="inputIdade" name="inputIdade" aria-describedby="inputIdadeHelp" placeholder="Idade">
                </div>
              </div>
              <div class="col">
                <div class="mb-3">
                  <label class="form-label mb-2" for="inputEstadoCivil">Estado Civil</label>
                  <select name="inputEstadoCivil" class="form-select">
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
                <div class="mb-3">
                  <label class="form-label mb-2" for="inputEscolaridade">Escolaridade</label>
                  <select name="inputEscolaridade" class="form-select">
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
                <div class="mb-3">
                  <label class="form-label mb-2" for="inputProfissao">Profissão</label>
                  <input type="text" class="form-control" id="inputProfissao" name="inputProfissao" aria-describedby="inputProfissaoHelp" placeholder="Profissão">
                </div>
              </div>
              <div class="col">
                <div class="mb-3">
                  <label class="form-label mb-2" for="inputRenda">Renda Mensal R$</label>
                  <input type="number" class="form-control" id="inputRenda" name="inputRenda" aria-describedby="inputRendaHelp" placeholder="Ex: 1.200,00">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6 m-auto">
                <a class="btn btn-block btn-success" href="#">Adicionar outro item</a>
              </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-primary">Salvar Dados</button>
          </div>
        </form>
      </div>
    </div>
  </div>-->
  <!-- FAMILIA INFO MODAL END -->

</div>
@endsection
