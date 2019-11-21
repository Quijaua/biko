@extends('layouts.app')

@section('content')
<div class="container">
  <!-- PAGE HEADER -->
  <div class="row">
      <div class="col-12 text-center">
        <h1>CADASTRO DE COORDENADORES</h1>
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

  <form method="POST" action="/coordenadores/create" enctype="multipart/form-data">
    @csrf
    <h3>DADOS PESSOAIS</h3>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputNomeCoordenador">Nome do coordenador</label>
          <input type="text" class="form-control" id="inputNomeCoordenador" name="inputNomeCoordenador" aria-describedby="inputNomeCoordenadorHelp" placeholder="Nome completo" value="{{ old('inputNomeCoordenador') }}" required>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputNucleo">Núcleo</label>
          <select name="inputNucleo" class="custom-select" required>
            <option selected>Selecione</option>
            @foreach($nucleos as $nucleo)
            <option <?php if($nucleo->id == old('inputNucleo')){ echo 'selected=selected';} ?> value="{{ $nucleo->id }}">{{ $nucleo->NomeNucleo }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputFuncaoCoordenador">Função</label>
          <input type="text" class="form-control" id="inputFuncaoCoordenador" name="inputFuncaoCoordenador" aria-describedby="inputFuncaoCoordenadorHelp" placeholder="Função no núcleo" value="{{ old('inputFuncaoCoordenador') }}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputAnoIngresso">Ano de Ingresso</label>
          <select name="inputAnoIngresso" class="custom-select">
            <option selected>Selecione</option>
            <option <?php if(old('inputAnoIngresso') == '2009'){ echo 'selected=selected';} ?> value="2009">2009</option>
            <option <?php if(old('inputAnoIngresso') == '2010'){ echo 'selected=selected';} ?> value="2010">2010</option>
            <option <?php if(old('inputAnoIngresso') == '2011'){ echo 'selected=selected';} ?> value="2011">2011</option>
            <option <?php if(old('inputAnoIngresso') == '2012'){ echo 'selected=selected';} ?> value="2012">2012</option>
            <option <?php if(old('inputAnoIngresso') == '2013'){ echo 'selected=selected';} ?> value="2013">2013</option>
            <option <?php if(old('inputAnoIngresso') == '2014'){ echo 'selected=selected';} ?> value="2014">2014</option>
            <option <?php if(old('inputAnoIngresso') == '2015'){ echo 'selected=selected';} ?> value="2015">2015</option>
            <option <?php if(old('inputAnoIngresso') == '2016'){ echo 'selected=selected';} ?> value="2016">2016</option>
            <option <?php if(old('inputAnoIngresso') == '2017'){ echo 'selected=selected';} ?> value="2017">2017</option>
            <option <?php if(old('inputAnoIngresso') == '2018'){ echo 'selected=selected';} ?> value="2018">2018</option>
            <option <?php if(old('inputAnoIngresso') == '2019'){ echo 'selected=selected';} ?> value="2019">2019</option>
            <option <?php if(old('inputAnoIngresso') == '2020'){ echo 'selected=selected';} ?> value="2020">2020</option>
            <option <?php if(old('inputAnoIngresso') == '2021'){ echo 'selected=selected';} ?> value="2021">2021</option>
          </select>
        </div>
      </div>
      <div class="col">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="inputRepresentanteCGU" id="inputRepresentanteCGU" value="sim">
          <label class="form-check-label" for="inputRepresentanteCGU">Representante no CGU</label>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputFoto">Foto</label>
          <input name="inputFoto" type="file" class="form-control-file" id="inputFoto" value="{{ old('inputFoto') }}">
        </div>
      </div>
      <div class="col mt-2">
        <small class="form-text text-muted">Arquivos devem ter menos que <strong>8 MB</strong>.</small>
        <small class="form-text text-muted">Tipos de arquivos permitidos: <strong>png gif jpg jpeg</strong>.</small>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputCPF">CPF</label>
          <input type="text" class="form-control" id="inputCPF" name="inputCPF" aria-describedby="inputCPFHelp" data-mask="000.000.000-00" placeholder="xxx.xxx.xxx-xx" onblur="checkCPF()" value="{{ old('inputCPF') }}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputRG">RG</label>
          <input type="text" class="form-control" id="inputRG" name="inputRG" aria-describedby="inputRGHelp" data-mask="00.000.000-00" placeholder="xx.xxx.xxx-x" value="{{ old('inputRG') }}">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputRaca">Raça / Cor</label>
          <select name="inputRaca" class="custom-select">
            <option selected>Selecione</option>
            <option <?php if(old('inputRaca') == 'negra'){ echo 'selected=selected';} ?> value="negra">Negra</option>
            <option <?php if(old('inputRaca') == 'branca'){ echo 'selected=selected';} ?> value="branca">Branca</option>
            <option <?php if(old('inputRaca') == 'parda'){ echo 'selected=selected';} ?> value="parda">Parda</option>
            <option <?php if(old('inputRaca') == 'amarela'){ echo 'selected=selected';} ?> value="amarela">Amarela</option>
            <option <?php if(old('inputRaca') == 'indigena'){ echo 'selected=selected';} ?> value="indigena">Indígena</option>
          </select>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputGenero">Gênero</label>
          <select name="inputGenero" class="custom-select">
            <option selected>Selecione</option>
            <option <?php if(old('inputGenero') == 'mulher'){ echo 'selected=selected';} ?> value="mulher">Mulher</option>
            <option <?php if(old('inputGenero') == 'homem'){ echo 'selected=selected';} ?> value="homem">Homem</option>
            <option <?php if(old('inputGenero') == 'mulher_trans_cis'){ echo 'selected=selected';} ?> value="mulher_trans_cis">Mulher (Trans ou Cis)</option>
            <option <?php if(old('inputGenero') == 'homem_trans_cis'){ echo 'selected=selected';} ?> value="homem_trans_cis">Homem (Trans ou Cis)</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputEstadoCivil">Estado Civil</label>
          <select name="inputEstadoCivil" class="custom-select">
            <option selected>Selecione</option>
            <option <?php if(old('inputEstadoCivil') == 'solteiro_a'){ echo 'selected=selected';} ?> value="solteiro_a">Solteiro(a)</option>
            <option <?php if(old('inputEstadoCivil') == 'casado_a'){ echo 'selected=selected';} ?> value="casado_a">Casado(a)</option>
            <option <?php if(old('inputEstadoCivil') == 'uniao_estavel'){ echo 'selected=selected';} ?> value="uniao_estavel">União Estável</option>
            <option <?php if(old('inputEstadoCivil') == 'divorciado_a'){ echo 'selected=selected';} ?> value="divorciado_a">Divorciado(a)</option>
            <option <?php if(old('inputEstadoCivil') == 'viuvo_a'){ echo 'selected=selected';} ?> value="viuvo_a">Viúvo(a)</option>
          </select>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputNascimento">Data de Nascimento</label>
          <input type="date" class="form-control" id="inputNascimento" name="inputNascimento" aria-describedby="inputNascimentoHelp" onblur="getAge()" value="{{ old('inputNascimento') }}">
        </div>
      </div>
    </div>
    <hr>
    <h3>ENDEREÇO</h3>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputCEP">CEP</label>
          <input type="text" class="form-control" id="inputCEP" name="inputCEP" aria-describedby="inputCEPHelp" data-mask="00000-000" placeholder="xxxxx-xxx" onblur="checkCEP('#inputCEP')" value="{{ old('inputCEP') }}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputEndereco">Rua</label>
          <input pattern="([^\s][A-zÀ-ž\s]+)" type="text" class="form-control" id="inputEndereco" name="inputEndereco" aria-describedby="inputEnderecoHelp" placeholder="Rua, Avenida, Logradouro" value="{{ old('inputEndereco') }}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputNumero">Número</label>
          <input type="text" class="form-control" id="inputNumero" name="inputNumero" aria-describedby="inputNumeroHelp" placeholder="Número" value="{{ old('inputNumero') }}">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputBairro">Bairro</label>
          <input type="text" class="form-control" id="inputBairro" name="inputBairro" aria-describedby="inputBairroHelp" placeholder="Bairro" value="{{ old('inputBairro') }}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputCidade">Cidade</label>
          <input type="text" class="form-control" id="inputCidade" name="inputCidade" aria-describedby="inputCidadeHelp" placeholder="Cidade/Município" value="{{ old('inputCidade') }}">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputEstado">Estado</label>
          <select id="inputEstado" name="inputEstado" class="custom-select">
            <option selected>Selecione</option>
            <option <?php if(old('inputEstado') == 'AC'){ echo 'selected=selected';} ?> value="AC">Acre</option>
            <option <?php if(old('inputEstado') == 'AL'){ echo 'selected=selected';} ?> value="AL">Alagoas</option>
            <option <?php if(old('inputEstado') == 'AP'){ echo 'selected=selected';} ?> value="AP">Amapá</option>
            <option <?php if(old('inputEstado') == 'AM'){ echo 'selected=selected';} ?> value="AM">Amazonas</option>
            <option <?php if(old('inputEstado') == 'BA'){ echo 'selected=selected';} ?> value="BA">Bahia</option>
            <option <?php if(old('inputEstado') == 'CE'){ echo 'selected=selected';} ?> value="CE">Ceará</option>
            <option <?php if(old('inputEstado') == 'DF'){ echo 'selected=selected';} ?> value="DF">Distrito Federal</option>
            <option <?php if(old('inputEstado') == 'ES'){ echo 'selected=selected';} ?> value="ES">Espírito Santo</option>
            <option <?php if(old('inputEstado') == 'GO'){ echo 'selected=selected';} ?> value="GO">Goiás</option>
            <option <?php if(old('inputEstado') == 'MA'){ echo 'selected=selected';} ?> value="MA">Maranhão</option>
            <option <?php if(old('inputEstado') == 'MT'){ echo 'selected=selected';} ?> value="MT">Mato Grosso</option>
            <option <?php if(old('inputEstado') == 'MS'){ echo 'selected=selected';} ?> value="MS">Mato Grosso do Sul</option>
            <option <?php if(old('inputEstado') == 'MG'){ echo 'selected=selected';} ?> value="MG">Minas Gerais</option>
            <option <?php if(old('inputEstado') == 'PA'){ echo 'selected=selected';} ?> value="PA">Pará</option>
            <option <?php if(old('inputEstado') == 'PB'){ echo 'selected=selected';} ?> value="PB">Paraíba</option>
            <option <?php if(old('inputEstado') == 'PR'){ echo 'selected=selected';} ?> value="PR">Paraná</option>
            <option <?php if(old('inputEstado') == 'PE'){ echo 'selected=selected';} ?> value="PE">Pernambuco</option>
            <option <?php if(old('inputEstado') == 'PI'){ echo 'selected=selected';} ?> value="PI">Piauí</option>
            <option <?php if(old('inputEstado') == 'RJ'){ echo 'selected=selected';} ?> value="RJ">Rio de Janeiro</option>
            <option <?php if(old('inputEstado') == 'RN'){ echo 'selected=selected';} ?> value="RN">Rio Grande do Norte</option>
            <option <?php if(old('inputEstado') == 'RS'){ echo 'selected=selected';} ?> value="RS">Rio Grande do Sul</option>
            <option <?php if(old('inputEstado') == 'RO'){ echo 'selected=selected';} ?> value="RO">Rondônia</option>
            <option <?php if(old('inputEstado') == 'RR'){ echo 'selected=selected';} ?> value="RR">Roraima</option>
            <option <?php if(old('inputEstado') == 'SC'){ echo 'selected=selected';} ?> value="SC">Santa Catarina</option>
            <option <?php if(old('inputEstado') == 'SP'){ echo 'selected=selected';} ?> value="SP">São Paulo</option>
            <option <?php if(old('inputEstado') == 'SE'){ echo 'selected=selected';} ?> value="SE">Sergipe</option>
            <option <?php if(old('inputEstado') == 'TO'){ echo 'selected=selected';} ?> value="TO">Tocantins</option>
            <option <?php if(old('inputEstado') == 'EX'){ echo 'selected=selected';} ?> value="EX">Estrangeiro</option>
          </select>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputComplemento">Complemento</label>
          <input type="text" class="form-control" id="inputComplemento" name="inputComplemento" aria-describedby="inputComplementoHelp" placeholder="Complemento" value="{{ old('inputComplemento') }}">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputFoneComercial">Telefone Comercial</label>
          <input type="text" class="form-control" id="inputFoneComercial" name="inputFoneComercial" aria-describedby="inputFoneComercialHelp" data-mask="(00) 0000-0000" placeholder="(xx)xxxx-xxxx" value="{{ old('inputFoneComercial') }}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputFoneResidencial">Telefone Residencial</label>
          <input type="text" class="form-control" id="inputFoneResidencial" name="inputFoneResidencial" aria-describedby="inputFoneResidencialHelp" data-mask="(00) 0000-0000" placeholder="(xx)xxxx-xxxx" value="{{ old('inputFoneResidencial') }}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputFoneCelular">Telefone Celular</label>
          <input type="text" class="form-control" id="inputFoneCelular" name="inputFoneCelular" aria-describedby="inputFoneCelularHelp" data-mask="(00) 0 0000-0000" placeholder="(xx)xxxx-xxxx" value="{{ old('inputFoneCelular') }}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputEmail">Email</label>
          <input type="email" class="form-control" id="inputEmail" name="inputEmail" aria-describedby="inputEmailHelp" placeholder="Endereço de Email" value="{{ old('inputEmail') }}" required>
        </div>
      </div>
    </div>
    <hr>
    <h3>DADOS PROFISSIONAIS</h3>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputEmpresa">Nome da Empresa</label>
          <input type="text" class="form-control" id="inputEmpresa" name="inputEmpresa" aria-describedby="inputEmpresaHelp" placeholder="Nome da empresa onde trabalha" value="{{ old('inputEmpresa') }}">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputCEPEmpresa">CEP</label>
          <input type="text" class="form-control" id="inputCEPEmpresa" name="inputCEPEmpresa" aria-describedby="inputCEPEmpresaHelp" data-mask="00000-000" placeholder="xxxxx-xxx" onblur="checkCEP('#inputCEPEmpresa')" value="{{ old('inputCEPEmpresa') }}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputEnderecoEmpresa">Rua</label>
          <input pattern="([^\s][A-zÀ-ž\s]+)" type="text" class="form-control" id="inputEnderecoEmpresa" name="inputEnderecoEmpresa" aria-describedby="inputEnderecoEmpresaHelp" placeholder="Rua, Avenida, Logradouro" value="{{ old('inputEnderecoEmpresa') }}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputNumeroEmpresa">Número</label>
          <input type="text" class="form-control" id="inputNumeroEmpresa" name="inputNumeroEmpresa" aria-describedby="inputNumeroEmpresaHelp" placeholder="Número da empresa" value="{{ old('inputNumeroEmpresa') }}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputComplementoEmpresa">Complemento</label>
          <input type="text" class="form-control" id="inputComplementoEmpresa" name="inputComplementoEmpresa" aria-describedby="inputComplementoEmpresaHelp" placeholder="Complemento" value="{{ old('inputComplementoEmpresa') }}">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputBairroEmpresa">Bairro</label>
          <input type="text" class="form-control" id="inputBairroEmpresa" name="inputBairroEmpresa" aria-describedby="inputBairroEmpresaHelp" placeholder="Bairro da empresa onde trabalha" value="{{ old('inputBairroEmpresa') }}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputCidadeEmpresa">Cidade da Empresa</label>
          <input type="text" class="form-control" id="inputCidadeEmpresa" name="inputCidadeEmpresa" aria-describedby="inputCidadeEmpresaHelp" placeholder="Cidade da empresa onde trabalha" value="{{ old('inputCidadeEmpresa') }}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputEstadoEmpresa">Estado da Empresa</label>
          <select id="inputEstadoEmpresa" name="inputEstadoEmpresa" class="custom-select">
            <option selected>Selecione</option>
            <option <?php if(old('inputEstadoEmpresa') == 'AC'){ echo 'selected=selected';} ?> value="AC">Acre</option>
            <option <?php if(old('inputEstadoEmpresa') == 'AL'){ echo 'selected=selected';} ?> value="AL">Alagoas</option>
            <option <?php if(old('inputEstadoEmpresa') == 'AP'){ echo 'selected=selected';} ?> value="AP">Amapá</option>
            <option <?php if(old('inputEstadoEmpresa') == 'AM'){ echo 'selected=selected';} ?> value="AM">Amazonas</option>
            <option <?php if(old('inputEstadoEmpresa') == 'BA'){ echo 'selected=selected';} ?> value="BA">Bahia</option>
            <option <?php if(old('inputEstadoEmpresa') == 'CE'){ echo 'selected=selected';} ?> value="CE">Ceará</option>
            <option <?php if(old('inputEstadoEmpresa') == 'DF'){ echo 'selected=selected';} ?> value="DF">Distrito Federal</option>
            <option <?php if(old('inputEstadoEmpresa') == 'ES'){ echo 'selected=selected';} ?> value="ES">Espírito Santo</option>
            <option <?php if(old('inputEstadoEmpresa') == 'GO'){ echo 'selected=selected';} ?> value="GO">Goiás</option>
            <option <?php if(old('inputEstadoEmpresa') == 'MA'){ echo 'selected=selected';} ?> value="MA">Maranhão</option>
            <option <?php if(old('inputEstadoEmpresa') == 'MT'){ echo 'selected=selected';} ?> value="MT">Mato Grosso</option>
            <option <?php if(old('inputEstadoEmpresa') == 'MS'){ echo 'selected=selected';} ?> value="MS">Mato Grosso do Sul</option>
            <option <?php if(old('inputEstadoEmpresa') == 'MG'){ echo 'selected=selected';} ?> value="MG">Minas Gerais</option>
            <option <?php if(old('inputEstadoEmpresa') == 'PA'){ echo 'selected=selected';} ?> value="PA">Pará</option>
            <option <?php if(old('inputEstadoEmpresa') == 'PB'){ echo 'selected=selected';} ?> value="PB">Paraíba</option>
            <option <?php if(old('inputEstadoEmpresa') == 'PR'){ echo 'selected=selected';} ?> value="PR">Paraná</option>
            <option <?php if(old('inputEstadoEmpresa') == 'PE'){ echo 'selected=selected';} ?> value="PE">Pernambuco</option>
            <option <?php if(old('inputEstadoEmpresa') == 'PI'){ echo 'selected=selected';} ?> value="PI">Piauí</option>
            <option <?php if(old('inputEstadoEmpresa') == 'RJ'){ echo 'selected=selected';} ?> value="RJ">Rio de Janeiro</option>
            <option <?php if(old('inputEstadoEmpresa') == 'RN'){ echo 'selected=selected';} ?> value="RN">Rio Grande do Norte</option>
            <option <?php if(old('inputEstadoEmpresa') == 'RS'){ echo 'selected=selected';} ?> value="RS">Rio Grande do Sul</option>
            <option <?php if(old('inputEstadoEmpresa') == 'RO'){ echo 'selected=selected';} ?> value="RO">Rondônia</option>
            <option <?php if(old('inputEstadoEmpresa') == 'RR'){ echo 'selected=selected';} ?> value="RR">Roraima</option>
            <option <?php if(old('inputEstadoEmpresa') == 'SC'){ echo 'selected=selected';} ?> value="SC">Santa Catarina</option>
            <option <?php if(old('inputEstadoEmpresa') == 'SP'){ echo 'selected=selected';} ?> value="SP">São Paulo</option>
            <option <?php if(old('inputEstadoEmpresa') == 'SE'){ echo 'selected=selected';} ?> value="SE">Sergipe</option>
            <option <?php if(old('inputEstadoEmpresa') == 'TO'){ echo 'selected=selected';} ?> value="TO">Tocantins</option>
            <option <?php if(old('inputEstadoEmpresa') == 'EX'){ echo 'selected=selected';} ?> value="EX">Estrangeiro</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputCargo">Cargo/Função</label>
          <input type="text" class="form-control" id="inputCargo" name="inputCargo" aria-describedby="inputCargoHelp" placeholder="Cargo ocupado na empresa" value="{{ old('inputCargo') }}">
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
          <input type="time" class="form-control" id="inputHorarioFrom" name="inputHorarioFrom" aria-describedby="inputHorarioFromHelp" value="{{ old('inputHorarioFrom') }}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputHorarioTo">Até</label>
          <input type="time" class="form-control" id="inputHorarioTo" name="inputHorarioTo" aria-describedby="inputHorarioToHelp" value="{{ old('inputHorarioTo') }}">
        </div>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-6">
          <div class="form-group">
            <label for="inputProjetosRealizados">Já realizou trabalhos em projetos educacionais/Coletivos/Movimentos Sociais?</label>
            <div class="form-check form-check-inline">
              <input <?php if(old('inputProjetosRealizados') == 'sim'){ echo 'checked=checked';} ?> class="form-check-input" type="radio" name="inputProjetosRealizados" id="inputProjetosRealizados1" value="sim" onclick="showInput('.projeto-dados')">
              <label class="form-check-label" for="inputProjetosRealizados1">Sim</label>
            </div>
            <div class="form-check form-check-inline">
              <input <?php if(old('inputProjetosRealizados') == 'nao'){ echo 'checked=checked';} ?> class="form-check-input" type="radio" name="inputProjetosRealizados" id="inputProjetosRealizados2" value="nao" onclick="hideInput('.projeto-dados')">
              <label class="form-check-label" for="inputProjetosRealizados2">Não</label>
            </div>
          </div>
      </div>
      <div class="col-3">
        <div class="form-group projeto-dados" style="display:none;">
          <label for="inputProjetosNome">Nome do projeto</label>
          <input type="text" class="form-control" id="inputProjetosNome" name="inputProjetosNome" aria-describedby="inputProjetosNomeHelp" placeholder="Nome do projeto" value="{{ old('inputProjetosNome') }}">
        </div>
      </div>
      <div class="col-3">
        <div id="ProjetosQual" class="form-group projeto-dados" style="display:none;">
          <label for="inputProjetosFuncao">Função exercida</label>
          <input type="text" class="form-control" id="inputProjetosFuncao" name="inputProjetosFuncao" aria-describedby="inputProjetosFuncaoHelp" placeholder="Função exercida" value="{{ old('inputProjetosFuncao') }}">
        </div>
      </div>
      <div class="col-6">
        <div class="form-group">
          <label for="inputComoSoube">Como você ficou sabendo do cursinho pré-vestibular da UNEafro Brasil?</label>
          <select id="comoSoube" name="inputComoSoube" class="custom-select" onchange="checkComosoube()">
            <option selected>Selecione</option>
            <option <?php if(old('inputComoSoube') == 'internet'){ echo 'selected=selected';} ?> value="internet">Internet</option>
            <option <?php if(old('inputComoSoube') == 'panfleto'){ echo 'selected=selected';} ?> value="panfleto">Panfleto</option>
            <option <?php if(old('inputComoSoube') == 'amigos'){ echo 'selected=selected';} ?> value="amigos">Amigos</option>
            <option <?php if(old('inputComoSoube') == 'jornal'){ echo 'selected=selected';} ?> value="jornal">Jornal</option>
            <option <?php if(old('inputComoSoube') == 'outros'){ echo 'selected=selected';} ?> value="outros">Outros</option>
          </select>
        </div>
      </div>
      <div class="col-6">
        <div id="ComoSoubeOutros" class="form-group" style="display:none;">
          <label for="inputComoSoubeOutros">Qual?</label>
          <input type="text" class="form-control" id="inputComoSoubeOutros" name="inputComoSoubeOutros" aria-describedby="inputComoSoubeOutrosHelp" placeholder="Qual" value="{{ old('inputComoSoubeOutros') }}">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputMotivoPrincipal">Qual foi o principal motivo que o/a levou a participar do Projeto?</label>
          <br>
          <textarea class="form-control" name="inputMotivoPrincipal" rows="8">{{ old('inputMotivoPrincipal') }}</textarea>
        </div>
      </div>
    </div>
    <hr>
    <h3>DADOS ACADÊMICOS</h3>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputEnsinoSuperior"><strong>Ensino Superior</strong></label>
          <select name="inputEnsinoSuperior" class="custom-select">
            <option selected>Selecione</option>
            <option <?php if(old('inputEnsinoSuperior') == 'em_curso'){ echo 'selected=selected';} ?> value="em_curso">Em curso</option>
            <option <?php if(old('inputEnsinoSuperior') == 'completo'){ echo 'selected=selected';} ?> value="completo">Completo</option>
            <option <?php if(old('inputEnsinoSuperior') == 'incompleto'){ echo 'selected=selected';} ?> value="incompleto">Incompleto</option>
          </select>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputInstituicaoSuperior">Instituição</label>
          <input type="text" class="form-control" id="inputInstituicaoSuperior" name="inputInstituicaoSuperior" aria-describedby="inputInstituicaoSuperiorHelp" placeholder="Instituição em qual cursou" value="{{ old('inputInstituicaoSuperior') }}">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputCursoSuperior1">Curso 1</label>
          <input type="text" class="form-control" id="inputCursoSuperior1" name="inputCursoSuperior1" aria-describedby="inputCursoSuperior1Help" placeholder="Informe o curso" value="{{ old('inputCursoSuperior1') }}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputAnoCursoSuperior1">Ano</label>
          <select name="inputAnoCursoSuperior1" class="custom-select">
            <option selected>Selecione</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '1972'){ echo 'selected=selected';} ?> value="1972">1972</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '1973'){ echo 'selected=selected';} ?> value="1973">1973</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '1974'){ echo 'selected=selected';} ?> value="1974">1974</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '1975'){ echo 'selected=selected';} ?> value="1975">1975</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '1976'){ echo 'selected=selected';} ?> value="1976">1976</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '1977'){ echo 'selected=selected';} ?> value="1977">1977</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '1978'){ echo 'selected=selected';} ?> value="1978">1978</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '1979'){ echo 'selected=selected';} ?> value="1979">1979</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '1980'){ echo 'selected=selected';} ?> value="1980">1980</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '1981'){ echo 'selected=selected';} ?> value="1981">1981</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '1982'){ echo 'selected=selected';} ?> value="1982">1982</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '1983'){ echo 'selected=selected';} ?> value="1983">1983</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '1984'){ echo 'selected=selected';} ?> value="1984">1984</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '1985'){ echo 'selected=selected';} ?> value="1985">1985</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '1986'){ echo 'selected=selected';} ?> value="1986">1986</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '1987'){ echo 'selected=selected';} ?> value="1987">1987</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '1988'){ echo 'selected=selected';} ?> value="1988">1988</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '1989'){ echo 'selected=selected';} ?> value="1989">1989</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '1990'){ echo 'selected=selected';} ?> value="1990">1990</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '1991'){ echo 'selected=selected';} ?> value="1991">1991</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '1992'){ echo 'selected=selected';} ?> value="1992">1992</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '1993'){ echo 'selected=selected';} ?> value="1993">1993</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '1994'){ echo 'selected=selected';} ?> value="1994">1994</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '1995'){ echo 'selected=selected';} ?> value="1995">1995</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '1996'){ echo 'selected=selected';} ?> value="1996">1996</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '1997'){ echo 'selected=selected';} ?> value="1997">1997</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '1998'){ echo 'selected=selected';} ?> value="1998">1998</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '1999'){ echo 'selected=selected';} ?> value="1999">1999</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '2000'){ echo 'selected=selected';} ?> value="2000">2000</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '2001'){ echo 'selected=selected';} ?> value="2001">2001</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '2002'){ echo 'selected=selected';} ?> value="2002">2002</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '2003'){ echo 'selected=selected';} ?> value="2003">2003</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '2004'){ echo 'selected=selected';} ?> value="2004">2004</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '2005'){ echo 'selected=selected';} ?> value="2005">2005</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '2006'){ echo 'selected=selected';} ?> value="2006">2006</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '2007'){ echo 'selected=selected';} ?> value="2007">2007</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '2008'){ echo 'selected=selected';} ?> value="2008">2008</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '2009'){ echo 'selected=selected';} ?> value="2009">2009</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '2010'){ echo 'selected=selected';} ?> value="2010">2010</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '2011'){ echo 'selected=selected';} ?> value="2011">2011</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '2012'){ echo 'selected=selected';} ?> value="2012">2012</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '2013'){ echo 'selected=selected';} ?> value="2013">2013</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '2014'){ echo 'selected=selected';} ?> value="2014">2014</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '2015'){ echo 'selected=selected';} ?> value="2015">2015</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '2016'){ echo 'selected=selected';} ?> value="2016">2016</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '2017'){ echo 'selected=selected';} ?> value="2017">2017</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '2018'){ echo 'selected=selected';} ?> value="2018">2018</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '2019'){ echo 'selected=selected';} ?> value="2019">2019</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '2020'){ echo 'selected=selected';} ?> value="2020">2020</option>
            <option <?php if(old('inputAnoCursoSuperior1') == '2021'){ echo 'selected=selected';} ?> value="2021">2021</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputCursoSuperior2">Curso 2</label>
          <input type="text" class="form-control" id="inputCursoSuperior2" name="inputCursoSuperior2" aria-describedby="inputCursoSuperior2Help" placeholder="Informe o curso" value="{{ old('inputCursoSuperior2') }}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputAnoCursoSuperior2">Ano</label>
          <select name="inputAnoCursoSuperior2" class="custom-select">
            <option selected>Selecione</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '1972'){ echo 'selected=selected';} ?> value="1972">1972</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '1973'){ echo 'selected=selected';} ?> value="1973">1973</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '1974'){ echo 'selected=selected';} ?> value="1974">1974</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '1975'){ echo 'selected=selected';} ?> value="1975">1975</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '1976'){ echo 'selected=selected';} ?> value="1976">1976</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '1977'){ echo 'selected=selected';} ?> value="1977">1977</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '1978'){ echo 'selected=selected';} ?> value="1978">1978</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '1979'){ echo 'selected=selected';} ?> value="1979">1979</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '1980'){ echo 'selected=selected';} ?> value="1980">1980</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '1981'){ echo 'selected=selected';} ?> value="1981">1981</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '1982'){ echo 'selected=selected';} ?> value="1982">1982</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '1983'){ echo 'selected=selected';} ?> value="1983">1983</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '1984'){ echo 'selected=selected';} ?> value="1984">1984</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '1985'){ echo 'selected=selected';} ?> value="1985">1985</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '1986'){ echo 'selected=selected';} ?> value="1986">1986</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '1987'){ echo 'selected=selected';} ?> value="1987">1987</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '1988'){ echo 'selected=selected';} ?> value="1988">1988</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '1989'){ echo 'selected=selected';} ?> value="1989">1989</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '1990'){ echo 'selected=selected';} ?> value="1990">1990</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '1991'){ echo 'selected=selected';} ?> value="1991">1991</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '1992'){ echo 'selected=selected';} ?> value="1992">1992</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '1993'){ echo 'selected=selected';} ?> value="1993">1993</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '1994'){ echo 'selected=selected';} ?> value="1994">1994</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '1995'){ echo 'selected=selected';} ?> value="1995">1995</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '1996'){ echo 'selected=selected';} ?> value="1996">1996</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '1997'){ echo 'selected=selected';} ?> value="1997">1997</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '1998'){ echo 'selected=selected';} ?> value="1998">1998</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '1999'){ echo 'selected=selected';} ?> value="1999">1999</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '2000'){ echo 'selected=selected';} ?> value="2000">2000</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '2001'){ echo 'selected=selected';} ?> value="2001">2001</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '2002'){ echo 'selected=selected';} ?> value="2002">2002</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '2003'){ echo 'selected=selected';} ?> value="2003">2003</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '2004'){ echo 'selected=selected';} ?> value="2004">2004</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '2005'){ echo 'selected=selected';} ?> value="2005">2005</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '2006'){ echo 'selected=selected';} ?> value="2006">2006</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '2007'){ echo 'selected=selected';} ?> value="2007">2007</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '2008'){ echo 'selected=selected';} ?> value="2008">2008</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '2009'){ echo 'selected=selected';} ?> value="2009">2009</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '2010'){ echo 'selected=selected';} ?> value="2010">2010</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '2011'){ echo 'selected=selected';} ?> value="2011">2011</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '2012'){ echo 'selected=selected';} ?> value="2012">2012</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '2013'){ echo 'selected=selected';} ?> value="2013">2013</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '2014'){ echo 'selected=selected';} ?> value="2014">2014</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '2015'){ echo 'selected=selected';} ?> value="2015">2015</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '2016'){ echo 'selected=selected';} ?> value="2016">2016</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '2017'){ echo 'selected=selected';} ?> value="2017">2017</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '2018'){ echo 'selected=selected';} ?> value="2018">2018</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '2019'){ echo 'selected=selected';} ?> value="2019">2019</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '2020'){ echo 'selected=selected';} ?> value="2020">2020</option>
            <option <?php if(old('inputAnoCursoSuperior2') == '2021'){ echo 'selected=selected';} ?> value="2021">2021</option>
          </select>
        </div>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputEspecializacao"><strong>Especialização</strong></label>
          <select name="inputEspecializacao" class="custom-select">
            <option selected>Selecione</option>
            <option <?php if(old('inputEspecializacao') == 'em_curso'){ echo 'selected=selected';} ?> value="em_curso">Em curso</option>
            <option <?php if(old('inputEspecializacao') == 'completo'){ echo 'selected=selected';} ?> value="completo">Completo</option>
            <option <?php if(old('inputEspecializacao') == 'incompleto'){ echo 'selected=selected';} ?> value="incompleto">Incompleto</option>
          </select>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputInstEspecializacao">Instituição</label>
          <input type="text" class="form-control" id="inputInstEspecializacao" name="inputInstEspecializacao" aria-describedby="inputInstEspecializacaoHelp" placeholder="Informe a instituição" value="{{ old('inputInstEspecializacao') }}">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputCursoEspecializacao">Curso</label>
          <input type="text" class="form-control" id="inputCursoEspecializacao" name="inputCursoEspecializacao" aria-describedby="inputCursoEspecializacaoHelp" placeholder="Informe o curso" value="{{ old('inputCursoEspecializacao') }}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputAnoCursoEspecializacao">Ano de Conclusão</label>
          <select name="inputAnoCursoEspecializacao" class="custom-select">
            <option selected>Selecione</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '1972'){ echo 'selected=selected';} ?> value="1972">1972</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '1973'){ echo 'selected=selected';} ?> value="1973">1973</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '1974'){ echo 'selected=selected';} ?> value="1974">1974</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '1975'){ echo 'selected=selected';} ?> value="1975">1975</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '1976'){ echo 'selected=selected';} ?> value="1976">1976</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '1977'){ echo 'selected=selected';} ?> value="1977">1977</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '1978'){ echo 'selected=selected';} ?> value="1978">1978</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '1979'){ echo 'selected=selected';} ?> value="1979">1979</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '1980'){ echo 'selected=selected';} ?> value="1980">1980</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '1981'){ echo 'selected=selected';} ?> value="1981">1981</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '1982'){ echo 'selected=selected';} ?> value="1982">1982</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '1983'){ echo 'selected=selected';} ?> value="1983">1983</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '1984'){ echo 'selected=selected';} ?> value="1984">1984</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '1985'){ echo 'selected=selected';} ?> value="1985">1985</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '1986'){ echo 'selected=selected';} ?> value="1986">1986</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '1987'){ echo 'selected=selected';} ?> value="1987">1987</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '1988'){ echo 'selected=selected';} ?> value="1988">1988</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '1989'){ echo 'selected=selected';} ?> value="1989">1989</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '1990'){ echo 'selected=selected';} ?> value="1990">1990</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '1991'){ echo 'selected=selected';} ?> value="1991">1991</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '1992'){ echo 'selected=selected';} ?> value="1992">1992</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '1993'){ echo 'selected=selected';} ?> value="1993">1993</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '1994'){ echo 'selected=selected';} ?> value="1994">1994</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '1995'){ echo 'selected=selected';} ?> value="1995">1995</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '1996'){ echo 'selected=selected';} ?> value="1996">1996</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '1997'){ echo 'selected=selected';} ?> value="1997">1997</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '1998'){ echo 'selected=selected';} ?> value="1998">1998</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '1999'){ echo 'selected=selected';} ?> value="1999">1999</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '2000'){ echo 'selected=selected';} ?> value="2000">2000</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '2001'){ echo 'selected=selected';} ?> value="2001">2001</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '2002'){ echo 'selected=selected';} ?> value="2002">2002</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '2003'){ echo 'selected=selected';} ?> value="2003">2003</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '2004'){ echo 'selected=selected';} ?> value="2004">2004</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '2005'){ echo 'selected=selected';} ?> value="2005">2005</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '2006'){ echo 'selected=selected';} ?> value="2006">2006</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '2007'){ echo 'selected=selected';} ?> value="2007">2007</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '2008'){ echo 'selected=selected';} ?> value="2008">2008</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '2009'){ echo 'selected=selected';} ?> value="2009">2009</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '2010'){ echo 'selected=selected';} ?> value="2010">2010</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '2011'){ echo 'selected=selected';} ?> value="2011">2011</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '2012'){ echo 'selected=selected';} ?> value="2012">2012</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '2013'){ echo 'selected=selected';} ?> value="2013">2013</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '2014'){ echo 'selected=selected';} ?> value="2014">2014</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '2015'){ echo 'selected=selected';} ?> value="2015">2015</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '2016'){ echo 'selected=selected';} ?> value="2016">2016</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '2017'){ echo 'selected=selected';} ?> value="2017">2017</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '2018'){ echo 'selected=selected';} ?> value="2018">2018</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '2019'){ echo 'selected=selected';} ?> value="2019">2019</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '2020'){ echo 'selected=selected';} ?> value="2020">2020</option>
            <option <?php if(old('inputAnoCursoEspecializacao') == '2021'){ echo 'selected=selected';} ?> value="2021">2021</option>
          </select>
        </div>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputMestrado"><strong>Mestrado</strong></label>
          <select name="inputMestrado" class="custom-select">
            <option selected>Selecione</option>
            <option value="em_curso">Em curso</option>
            <option value="completo">Completo</option>
            <option value="incompleto">Incompleto</option>
          </select>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputInstMestrado">Instituição</label>
          <input type="text" class="form-control" id="inputInstMestrado" name="inputInstMestrado" aria-describedby="inputInstMestradoHelp" placeholder="Informe a instituição" value="{{ old('inputInstMestrado') }}">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputCursoMestrado">Curso</label>
          <input type="text" class="form-control" id="inputCursoMestrado" name="inputCursoMestrado" aria-describedby="inputCursoMestradoHelp" placeholder="Informe o curso" value="{{ old('inputCursoMestrado') }}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputAnoCursoMestrado">Ano de Conclusão</label>
          <select name="inputAnoCursoMestrado" class="custom-select">
            <option selected>Selecione</option>
            <option <?php if(old('inputAnoCursoMestrado') == '1972'){ echo 'selected=selected';} ?> value="1972">1972</option>
            <option <?php if(old('inputAnoCursoMestrado') == '1973'){ echo 'selected=selected';} ?> value="1973">1973</option>
            <option <?php if(old('inputAnoCursoMestrado') == '1974'){ echo 'selected=selected';} ?> value="1974">1974</option>
            <option <?php if(old('inputAnoCursoMestrado') == '1975'){ echo 'selected=selected';} ?> value="1975">1975</option>
            <option <?php if(old('inputAnoCursoMestrado') == '1976'){ echo 'selected=selected';} ?> value="1976">1976</option>
            <option <?php if(old('inputAnoCursoMestrado') == '1977'){ echo 'selected=selected';} ?> value="1977">1977</option>
            <option <?php if(old('inputAnoCursoMestrado') == '1978'){ echo 'selected=selected';} ?> value="1978">1978</option>
            <option <?php if(old('inputAnoCursoMestrado') == '1979'){ echo 'selected=selected';} ?> value="1979">1979</option>
            <option <?php if(old('inputAnoCursoMestrado') == '1980'){ echo 'selected=selected';} ?> value="1980">1980</option>
            <option <?php if(old('inputAnoCursoMestrado') == '1981'){ echo 'selected=selected';} ?> value="1981">1981</option>
            <option <?php if(old('inputAnoCursoMestrado') == '1982'){ echo 'selected=selected';} ?> value="1982">1982</option>
            <option <?php if(old('inputAnoCursoMestrado') == '1983'){ echo 'selected=selected';} ?> value="1983">1983</option>
            <option <?php if(old('inputAnoCursoMestrado') == '1984'){ echo 'selected=selected';} ?> value="1984">1984</option>
            <option <?php if(old('inputAnoCursoMestrado') == '1985'){ echo 'selected=selected';} ?> value="1985">1985</option>
            <option <?php if(old('inputAnoCursoMestrado') == '1986'){ echo 'selected=selected';} ?> value="1986">1986</option>
            <option <?php if(old('inputAnoCursoMestrado') == '1987'){ echo 'selected=selected';} ?> value="1987">1987</option>
            <option <?php if(old('inputAnoCursoMestrado') == '1988'){ echo 'selected=selected';} ?> value="1988">1988</option>
            <option <?php if(old('inputAnoCursoMestrado') == '1989'){ echo 'selected=selected';} ?> value="1989">1989</option>
            <option <?php if(old('inputAnoCursoMestrado') == '1990'){ echo 'selected=selected';} ?> value="1990">1990</option>
            <option <?php if(old('inputAnoCursoMestrado') == '1991'){ echo 'selected=selected';} ?> value="1991">1991</option>
            <option <?php if(old('inputAnoCursoMestrado') == '1992'){ echo 'selected=selected';} ?> value="1992">1992</option>
            <option <?php if(old('inputAnoCursoMestrado') == '1993'){ echo 'selected=selected';} ?> value="1993">1993</option>
            <option <?php if(old('inputAnoCursoMestrado') == '1994'){ echo 'selected=selected';} ?> value="1994">1994</option>
            <option <?php if(old('inputAnoCursoMestrado') == '1995'){ echo 'selected=selected';} ?> value="1995">1995</option>
            <option <?php if(old('inputAnoCursoMestrado') == '1996'){ echo 'selected=selected';} ?> value="1996">1996</option>
            <option <?php if(old('inputAnoCursoMestrado') == '1997'){ echo 'selected=selected';} ?> value="1997">1997</option>
            <option <?php if(old('inputAnoCursoMestrado') == '1998'){ echo 'selected=selected';} ?> value="1998">1998</option>
            <option <?php if(old('inputAnoCursoMestrado') == '1999'){ echo 'selected=selected';} ?> value="1999">1999</option>
            <option <?php if(old('inputAnoCursoMestrado') == '2000'){ echo 'selected=selected';} ?> value="2000">2000</option>
            <option <?php if(old('inputAnoCursoMestrado') == '2001'){ echo 'selected=selected';} ?> value="2001">2001</option>
            <option <?php if(old('inputAnoCursoMestrado') == '2002'){ echo 'selected=selected';} ?> value="2002">2002</option>
            <option <?php if(old('inputAnoCursoMestrado') == '2003'){ echo 'selected=selected';} ?> value="2003">2003</option>
            <option <?php if(old('inputAnoCursoMestrado') == '2004'){ echo 'selected=selected';} ?> value="2004">2004</option>
            <option <?php if(old('inputAnoCursoMestrado') == '2005'){ echo 'selected=selected';} ?> value="2005">2005</option>
            <option <?php if(old('inputAnoCursoMestrado') == '2006'){ echo 'selected=selected';} ?> value="2006">2006</option>
            <option <?php if(old('inputAnoCursoMestrado') == '2007'){ echo 'selected=selected';} ?> value="2007">2007</option>
            <option <?php if(old('inputAnoCursoMestrado') == '2008'){ echo 'selected=selected';} ?> value="2008">2008</option>
            <option <?php if(old('inputAnoCursoMestrado') == '2009'){ echo 'selected=selected';} ?> value="2009">2009</option>
            <option <?php if(old('inputAnoCursoMestrado') == '2010'){ echo 'selected=selected';} ?> value="2010">2010</option>
            <option <?php if(old('inputAnoCursoMestrado') == '2011'){ echo 'selected=selected';} ?> value="2011">2011</option>
            <option <?php if(old('inputAnoCursoMestrado') == '2012'){ echo 'selected=selected';} ?> value="2012">2012</option>
            <option <?php if(old('inputAnoCursoMestrado') == '2013'){ echo 'selected=selected';} ?> value="2013">2013</option>
            <option <?php if(old('inputAnoCursoMestrado') == '2014'){ echo 'selected=selected';} ?> value="2014">2014</option>
            <option <?php if(old('inputAnoCursoMestrado') == '2015'){ echo 'selected=selected';} ?> value="2015">2015</option>
            <option <?php if(old('inputAnoCursoMestrado') == '2016'){ echo 'selected=selected';} ?> value="2016">2016</option>
            <option <?php if(old('inputAnoCursoMestrado') == '2017'){ echo 'selected=selected';} ?> value="2017">2017</option>
            <option <?php if(old('inputAnoCursoMestrado') == '2018'){ echo 'selected=selected';} ?> value="2018">2018</option>
            <option <?php if(old('inputAnoCursoMestrado') == '2019'){ echo 'selected=selected';} ?> value="2019">2019</option>
            <option <?php if(old('inputAnoCursoMestrado') == '2020'){ echo 'selected=selected';} ?> value="2020">2020</option>
            <option <?php if(old('inputAnoCursoMestrado') == '2021'){ echo 'selected=selected';} ?> value="2021">2021</option>
          </select>
        </div>
      </div>
      <input type="hidden" name="inputStatus" value="1">
    </div>
    <button type="submit" class="btn btn-primary">Salvar Dados</button>
  </form>

</div>
@endsection
