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
            <td><img class="rounded-circle" src="{{ asset('storage') }}/{{ $dados->Foto }}" alt="{{ $dados->Foto }}"></td>
            @else
            <td><img class="rounded-circle" src="{{ asset('images') }}/user.png" alt="Avatar"></td>
            @endif
    </div>
  </div>

  <div class="row mt-4 mb-4">
    <div class="col-2">
      <a class="btn btn-block btn-danger" href="/alunos/edit/{{ $dados->id }}"><i class="fas fa-user-edit"></i> Editar Dados</a>
    </div>
    <div class="col-2">
      <a class="btn btn-block btn-primary" href="/alunos"><i class="fas fa-arrow-left"></i> Voltar</a>
    </div>
    <div class="col-2">
      <a class="btn btn-block btn-success text-light" href="javascript:window.print()"><i class="fas fa-print"></i> Imprimir</a>
    </div>
    @if($user->role === 'administrador')
    <div class="col-2">
      <a class="btn btn-block btn-info text-light" href="/alunos/log/{{ $dados->id }}"><i class="fas fa-info-circle"></i> Registro de ações</a>
    </div>
    @endif
  </div>
  <h3>DADOS PESSOAIS</h3>
  <div class="row">
    <div class="col">
      <div class="form-group">
        <span for="inputNomeAluno">Nome do aluno</span>
        <input type="text" class="form-control" id="inputNomeAluno" name="inputNomeAluno" aria-describedby="inputNomeAlunoHelp" value="{{ $dados->NomeAluno }}" disabled>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <label for="inputNomeSocial">Nome Social do aluno</label>
        <input type="text" class="form-control" id="inputNomeSocial" name="inputNomeSocial" aria-describedby="inputNomeSocialHelp" value="{{ $dados->NomeSocial }}" disabled>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <span for="inputNucleo">Núcleo</span>
        <select name="inputNucleo" class="custom-select" disabled>
          <option selected>Selecione</option>
          @foreach($nucleos as $nucleo)
          <option  <?php if($nucleo->id == $dados->id_nucleo){ echo 'selected=selected';} ?> value="{{ $nucleo->id }}">{{ $nucleo->NomeNucleo }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <!--<label for="inputListaEspera">Lista de Espera</label>--><br />
        <div class="form-check form-check-inline">
          @if($user->role === 'administrador' || $user->role === 'coordenador')
          <input class="form-check-input" name="inputListaEspera" type="checkbox" value="{{ $dados->ListaEspera }}" @if($dados->ListaEspera)checked @else @endif disabled>
          <label class="form-check-label" for="inputListaEspera">Lista de Espera</label>
          @endif
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <!--<div class="col">
      <div class="form-group">
        <span for="inputCPF">CPF</span>
        <input type="text" class="form-control" id="inputCPF" name="inputCPF" aria-describedby="inputCPFHelp" data-mask="000.000.000-00" value="{{ $dados->CPF }}" disabled>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <span for="inputRG">RG</span>
        <input type="text" class="form-control" id="inputRG" name="inputRG" aria-describedby="inputRGHelp" data-mask="00.000.000-00" value="{{ $dados->RG }}" disabled>
      </div>
    </div>-->
    <div class="col">
      <label for="temFilhos">Tem filhos?</label>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="temFilhos" id="temFilhos1" value="1" @if($dados->temFilhos === 1) {{ 'checked' }} @endif disabled>
        <label class="form-check-label" for="temFilhos1">
          Sim
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="temFilhos" id="temFilhos2" value="0" @if($dados->temFilhos === 0) {{ 'checked' }} @endif disabled>
        <label class="form-check-label" for="temFilhos2">
          Não
        </label>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <label for="filhosQt">Quantos?</label>
        <input class="form-control" type="number" id="filhosQt" name="filhosQt" value="{{ $dados->filhosQt }}" disabled>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <label for="inputEmail">Email</label>
        <input type="email" class="form-control" id="inputEmail" name="inputEmail" aria-describedby="inputEmailHelp" value="{{ $dados->Email }}" disabled>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="form-group">
        <span for="inputRaca">Raça / Cor</span>
        <select name="inputRaca" class="custom-select" disabled>
          <option selected>Selecione</option>
          <option <?php if($dados->Raca == 'negra'){ echo 'selected=selected';} ?> value="negra">Preta</option>
          <option <?php if($dados->Raca == 'branca'){ echo 'selected=selected';} ?> value="branca">Branca</option>
          <option <?php if($dados->Raca == 'parda'){ echo 'selected=selected';} ?> value="parda">Parda</option>
          <option <?php if($dados->Raca == 'amarela'){ echo 'selected=selected';} ?> value="amarela">Amarela</option>
          <option <?php if($dados->Raca == 'indigena'){ echo 'selected=selected';} ?> value="indigena">Indígena</option>
        </select>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <span for="inputGenero">Identidade de Gênero</span>
        <select name="inputGenero" class="custom-select" disabled>
          <option selected>Selecione</option>
          <option <?php if($dados->Genero == 'mulher' || $dados->Genero == 'mulher_trans_cis'){ echo 'selected=selected';} ?> value="mulher">Mulher (Cis/Trans)</option>
          <option <?php if($dados->Genero == 'homem' || $dados->Genero == 'homem_trans_cis'){ echo 'selected=selected';} ?> value="homem">Homem (Cis/Trans)</option>
          <option <?php if($dados->Genero == 'nao_binarie'){ echo 'selected=selected';} ?> value="mulher_trans_cis">Não Binárie</option>
        </select>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="form-group">
        <span for="inputEstadoCivil">Estado Civil</span>
        <select name="inputEstadoCivil" class="custom-select" disabled>
          <option selected>Selecione</option>
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
        <span for="inputNascimento">Data de Nascimento</span>
        <input type="date" class="form-control" id="inputNascimento" name="inputNascimento" aria-describedby="inputNascimentoHelp" value="{{ $dados->Nascimento }}" onblur="getAge()" disabled>
      </div>
    </div>

    <div class="col-12 col-md-6">
      <div class="form-group">
        <label for="concordaSexoDesignado">Você se identifica com o gênero designado ao nascer?</label>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="concordaSexoDesignado" id="concordaSexoDesignado1" value="1" @if( $dados->concordaSexoDesignado ) {{ 'checked' }} @endif disabled>
          <label class="form-check-label" for="concordaSexoDesignado1">
            Sim
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="concordaSexoDesignado" id="concordaSexoDesignado2" value="0" @if( !$dados->concordaSexoDesignado ) {{ 'checked' }} @endif disabled >
          <label class="form-check-label" for="concordaSexoDesignado2">
            Não
          </label>
        </div>
      </div>
    </div>

  </div>

  <div class="row">
    <div class="col-12">
      <div class="form-group">
        <label for="responsavelCuidadoOutraPessoa">É responsável pelo cuidado de outra pessoa?</label>
        <select name="responsavelCuidadoOutraPessoa" class="custom-select" disabled>
          <option value="Não" @if( $dados->responsavelCuidadoOutraPessoa === 'Não' ) {{ 'selected' }} @endif >Não</option>
          <option value="Sim, por uma criança" @if( $dados->responsavelCuidadoOutraPessoa === 'Sim, por uma criança' ) {{ 'selected' }} @endif >Sim, por uma criança</option>
          <option value="Sim, por uma pessoa idosa ou pessoa adulta que demanda cuidados especiais" @if( $dados->responsavelCuidadoOutraPessoa === 'Sim, por uma pessoa idosa ou pessoa adulta que demanda cuidados especiais' ) {{ 'selected' }} @endif >Sim, por uma pessoa idosa ou pessoa adulta que demanda cuidados especiais</option>
        </select>
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
        <span for="inputCEP">CEP (Somente números)</span>
        <input type="text" class="form-control" id="inputCEP" name="inputCEP" aria-describedby="inputCEPHelp" data-mask="00000-000" value="{{ $dados->CEP }}" onblur="checkCEP('#inputCEP')" disabled>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <span for="inputEndereco">Rua</span>
        <input pattern="([^\s][A-zÀ-ž\s]+)" type="text" class="form-control" id="inputEndereco" name="inputEndereco" aria-describedby="inputEnderecoHelp" value="{{ $dados->Endereco }}" disabled>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <span for="inputNumero">Número</span>
        <input type="number" class="form-control" id="inputNumero" name="inputNumero" aria-describedby="inputNumeroHelp" value="{{ $dados->Numero }}" disabled>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="form-group">
        <span for="inputBairro">Distrito</span>
        <input type="text" class="form-control" id="inputBairro" name="inputBairro" aria-describedby="inputBairroHelp" value="{{ $dados->Bairro }}" disabled>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <span for="inputCidade">Cidade</span>
        <input type="text" class="form-control" id="inputCidade" name="inputCidade" aria-describedby="inputCidadeHelp" value="{{ $dados->Cidade }}" disabled>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="form-group">
        <span for="inputEstado">Estado</span>
        <select name="inputEstado" class="custom-select" disabled>
          <option selected>Selecione</option>
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
        <span for="inputComplemento">Complemento</span>
        <input type="text" class="form-control" id="inputComplemento" name="inputComplemento" aria-describedby="inputComplementoHelp" value="{{ $dados->Complemento }}" disabled>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="form-group">
        <span for="inputFoneComercial">Telefone Comercial</span>
        <input type="phone" class="form-control" id="inputFoneComercial" name="inputFoneComercial" aria-describedby="inputFoneComercialHelp" data-mask="(00) 0000-0000" value="{{ $dados->FoneComercial }}" disabled>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <span for="inputFoneResidencial">Telefone Residencial</span>
        <input type="phone" class="form-control" id="inputFoneResidencial" name="inputFoneResidencial" aria-describedby="inputFoneResidencialHelp" data-mask="(00) 0000-0000" value="{{ $dados->FoneResidencial }}" disabled>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <span for="inputFoneCelular">Telefone Celular</span>
        <input type="phone" class="form-control" id="inputFoneCelular" name="inputFoneCelular" aria-describedby="inputFoneCelularHelp" data-mask="(00) 0 0000-0000" value="{{ $dados->FoneCelular }}" disabled>
      </div>
    </div>
  </div>
  <hr>
  <h3>DADOS PROFISSIONAIS</h3>
  <div class="row">
    <div class="col-12 col-md-6">
      <div class="form-group">
        <label for="inputRamoAtuacao">Você trabalha no ramo da:</label>
        <select id="inputRamoAtuacao" name="inputRamoAtuacao" class="custom-select" disabled>
          <option value="Educação" @if( $dados->RamoAtuacao == 'Educação' ) {{ 'selected' }} @endif >Educação</option>
          <option value="Pesquisa" @if( $dados->RamoAtuacao == 'Pesquisa' ) {{ 'selected' }} @endif >Pesquisa</option>
          <option value="Telemarketing" @if( $dados->RamoAtuacao == 'Telemarketing' ) {{ 'selected' }} @endif >Telemarketing</option>
          <option value="Comércio" @if( $dados->RamoAtuacao == 'Comércio' ) {{ 'selected' }} @endif >Comércio</option>
          <option value="Indústria" @if( $dados->RamoAtuacao == 'Indústria' ) {{ 'selected' }} @endif >Indústria</option>
          <option value="Construção Civil" @if( $dados->RamoAtuacao == 'Construção Civil' ) {{ 'selected' }} @endif >Construção Civil</option>
          <option value="Beleza e Cuidados" @if( $dados->RamoAtuacao == 'Beleza e Cuidados' ) {{ 'selected' }} @endif >Beleza e Cuidados</option>
          <option value="Serviços gerais" @if( $dados->RamoAtuacao == 'Serviços gerais' ) {{ 'selected' }} @endif >Serviços gerais</option>
          <option value="Limpeza e Higiene" @if( $dados->RamoAtuacao == 'Limpeza e Higiene' ) {{ 'selected' }} @endif >Limpeza e Higiene</option>
          <option value="Gastronomia/Alimentação" @if( $dados->RamoAtuacao == 'Gastronomia/Alimentação' ) {{ 'selected' }} @endif >Gastronomia/Alimentação</option>
          <option value="Entrega/Delivery" @if( $dados->RamoAtuacao == 'Entrega/Delivery' ) {{ 'selected' }} @endif >Entrega/Delivery</option>
          <option value="Saúde/Bem-Estar" @if( $dados->RamoAtuacao == 'Saúde/Bem-Estar' ) {{ 'selected' }} @endif >Saúde/Bem-Estar</option>
          <option value="Segurança" @if( $dados->RamoAtuacao == 'Segurança' ) {{ 'selected' }} @endif >Segurança</option>
          <option value="Transporte de pessoas/Aplicativos" @if( $dados->RamoAtuacao == 'Transporte de pessoas/Aplicativos' ) {{ 'selected' }} @endif >Transporte de pessoas/Aplicativos</option>
          <option value="Outros" @if( $dados->RamoAtuacao == 'Outros' ) {{ 'selected' }} @endif >Outros</option>
        </select>
      </div>
    </div>
    <div class="col-12 col-md-6">
      <label for="inputRamoAtuacaoOutros">&nbsp;</label>
      <input type="text" class="form-control" id="inputRamoAtuacaoOutros" name="inputRamoAtuacaoOutros" aria-describedby="inputRamoAtuacaoOutrosHelp" placeholder="Outros (Especifique)" value="{{ $dados->RamoAtuacaoOutros }}" disabled>
    </div>
  </div>
  <!--<div class="row">
    <div class="col">
      <div class="form-group">
        <span for="inputEmpresa">Nome da Empresa</span>
        <input type="text" class="form-control" id="inputEmpresa" name="inputEmpresa" aria-describedby="inputEmpresaHelp" value="{{ $dados->Empresa }}" disabled>
      </div>
    </div>
  </div>-->
  <!--<div class="row">
    <div class="col">
      <div class="form-group">
        <span for="inputCEPEmpresa">CEP</span>
        <input type="text" class="form-control" id="inputCEPEmpresa" name="inputCEPEmpresa" aria-describedby="inputCEPEmpresaHelp" data-mask="00000-000" value="{{ $dados->CEPEmpresa }}" onblur="checkCEP('#inputCEPEmpresa')" disabled>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <span for="inputEnderecoEmpresa">Rua</span>
        <input pattern="([^\s][A-zÀ-ž\s]+)" type="text" class="form-control" id="inputEnderecoEmpresa" name="inputEnderecoEmpresa" aria-describedby="inputEnderecoEmpresaHelp" value="{{ $dados->EnderecoEmpresa }}" disabled>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <span for="inputNumeroEmpresa">Número</span>
        <input type="text" class="form-control" id="inputNumeroEmpresa" name="inputNumeroEmpresa" aria-describedby="inputNumeroEmpresaHelp" value="{{ $dados->NumeroEmpresa }}" disabled>
      </div>
    </div>
  </div>-->
  <!--<div class="row">
    <div class="col">
      <div class="form-group">
        <span for="inputBairroEmpresa">Bairro</span>
        <input type="text" class="form-control" id="inputBairroEmpresa" name="inputBairroEmpresa" aria-describedby="inputBairroEmpresaHelp" value="{{ $dados->BairroEmpresa }}" disabled>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <span for="inputCidadeEmpresa">Cidade</span>
        <input type="text" class="form-control" id="inputCidadeEmpresa" name="inputCidadeEmpresa" aria-describedby="inputCidadeEmpresaHelp" value="{{ $dados->CidadeEmpresa }}" disabled>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <span for="inputComplementoEmpresa">Complemento</span>
        <input type="text" class="form-control" id="inputComplementoEmpresa" name="inputComplementoEmpresa" aria-describedby="inputComplementoEmpresaHelp" value="{{ $dados->ComplementoEmpresa }}" disabled>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <span for="inputEstadoEmpresa">Estado</span>
        <select name="inputEstadoEmpresa" class="custom-select" disabled>
          <option selected>Selecione</option>
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
  </div>-->
  <!--<div class="row">
    <div class="col">
      <div class="form-group">
        <span for="inputCargo">Cargo/Função</span>
        <input type="text" class="form-control" id="inputCargo" name="inputCargo" aria-describedby="inputCargoHelp" value="{{ $dados->Cargo }}" disabled>
      </div>
    </div>
  </div>-->
  <!--<div class="row">
    <div class="col-12">
      <p>Horário de Trabalho</p>
    </div>
    <div class="col">
      <div class="form-group">
        <span for="inputHorarioFrom">De</span>
        <input type="time" class="form-control" id="inputHorarioFrom" name="inputHorarioFrom" aria-describedby="inputHorarioFromHelp" value="{{ $dados->HorarioFrom }}" disabled>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <span for="inputHorarioTo">Até</span>
        <input type="time" class="form-control" id="inputHorarioTo" name="inputHorarioTo" aria-describedby="inputHorarioToHelp" value="{{ $dados->HorarioTo }}" disabled>
      </div>
    </div>
  </div>-->
  <hr>
  <!--
  <h3>DADOS FAMILIARES</h3>
  <div class="row">
    <div class="col">
      <div class="form-group">
        <span for="inputNomeMae">Nome da Mãe</span>
        <input type="text" class="form-control" id="inputNomeMae" name="inputNomeMae" aria-describedby="inputNomeMaeHelp" value="{{ $dados->NomeMae }}" disabled>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <span for="inputNomePai">Nome do Pai</span>
        <input type="text" class="form-control" id="inputNomePai" name="inputNomePai" aria-describedby="inputNomePaiHelp" value="{{ $dados->NomePai }}" disabled>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="form-group">
        <span for="inputCEPFamilia">CEP</span>
        <input type="text" class="form-control" id="inputCEPFamilia" name="inputCEPFamilia" aria-describedby="inputCEPFamiliaHelp" data-mask="00000-000" value="{{ $dados->CEPFamilia }}" onblur="checkCEP('#inputCEPFamilia')" disabled>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <span for="inputEnderecoFamilia">Rua</span>
        <input pattern="([^\s][A-zÀ-ž\s]+)" type="text" class="form-control" id="inputEnderecoFamilia" name="inputEnderecoFamilia" aria-describedby="inputEnderecoFamiliaHelp" value="{{ $dados->EnderecoFamilia }}" disabled>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <span for="inputNumeroFamilia">Número</span>
        <input type="number" class="form-control" id="inputNumeroFamilia" name="inputNumeroFamilia" aria-describedby="inputNumeroFamiliaHelp" value="{{ $dados->NumeroFamilia }}" disabled>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="form-group">
        <span for="inputComplementoFamilia">Complemento</span>
        <input type="text" class="form-control" id="inputComplementoFamilia" name="inputComplementoFamilia" aria-describedby="inputComplementoFamiliaHelp" value="{{ $dados->ComplementoFamilia }}" disabled>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <span for="inputBairroFamilia">Bairro</span>
        <input type="text" class="form-control" id="inputBairroFamilia" name="inputBairroFamilia" aria-describedby="inputBairroFamiliaHelp" value="{{ $dados->BairroFamilia }}" disabled>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <span for="inputCidadeFamilia">Cidade</span>
        <input type="text" class="form-control" id="inputCidadeFamilia" name="inputCidadeFamilia" aria-describedby="inputCidadeFamiliaHelp" value="{{ $dados->CidadeFamilia }}" disabled>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <span for="inputEstadoFamilia">Estado</span>
        <select id="inputEstadoFamilia" name="inputEstadoFamilia" class="custom-select" disabled>
          <option selected>Selecione</option>
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
        <span for="inputTelefoneFamilia">Telefone</span>
        <input type="text" class="form-control" id="inputTelefoneFamilia" name="inputTelefoneFamilia" aria-describedby="inputTelefoneFamiliaHelp" data-mask="(00) 0000-0000" value="{{ $dados->TelefoneFamilia }}" disabled>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <label for="inputAuxGoverno">A família recebe algumn tipo de auxílio do Governo?</label>
        <div id="AuxGoverno" class="form-check form-check-inline">
          <input <?php if($dados->AuxGoverno == 'sim'){ echo 'checked=checked';} ?> class="form-check-input" type="radio" name="inputAuxGoverno" id="inputAuxGoverno1" value="sim" disabled>
          <label class="form-check-label" for="inputTaxaInscricao1">Sim</label>
        </div>
        <div class="form-check form-check-inline">
          <input <?php if($dados->AuxGoverno == 'nao'){ echo 'checked=checked';} ?> class="form-check-input" type="radio" name="inputAuxGoverno" id="inputAuxGoverno2" value="nao" disabled>
          <label class="form-check-label" for="inputTaxaInscricao2">Não</label>
        </div>
      </div>
    </div>
    <div class="col">
      @if($dados->AuxGoverno == 'sim')
      <div id="AuxTipo" class="form-group">
        <label for="inputAuxTipo">Qual?</label>
        <select name="inputAuxTipo" class="custom-select" disabled>
          <option selected>Selecione</option>
          <option <?php if($dados->AuxTipo == 'bolsa_familia'){ echo 'selected=selected';} ?> value="bolsa_familia">Programa Bolsa Família</option>
          <option <?php if($dados->AuxTipo == 'energia_eletrica'){ echo 'selected=selected';} ?> value="energia_eletrica">Tarifa Social de Energia Elétrica</option>
          <option <?php if($dados->AuxTipo == 'emergencial_financeiro'){ echo 'selected=selected';} ?> value="emergencial_financeiro">Auxílio Emergencial Financeiro</option>
          <option <?php if($dados->AuxTipo == 'bolsa_verde'){ echo 'selected=selected';} ?> value="bolsa_verde">Bolsa Verde</option>
        </select>
      </div>
      @endif
    </div>
  </div>
  <div class="row">
    <div class="col-12 mt-2"><h3>INFORMAÇÕES FAMILIARES</h3></div>
    @foreach($familiares as $parente)

    <div class="container-fluid p-3">
      <div id="item" class="stage">
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="inputGrauParentesco">Grau de Parentesco</label>
              <select name="inputGrauParentesco" class="custom-select" disabled>
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
              <input type="number" class="form-control" id="inputIdade" name="inputIdade" aria-describedby="inputIdadeHelp" value="{{ $parente->Idade }}" disabled>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="inputEstadoCivil">Estado Civil</label>
              <select name="inputEstadoCivil" class="custom-select" disabled>
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
              <select name="inputEscolaridade" class="custom-select" disabled>
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
              <input type="text" class="form-control" id="inputProfissao" name="inputProfissao" aria-describedby="inputProfissaoHelp" value="{{ $parente->Profissao }}" disabled>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="inputRenda">Renda Mensal R$</label>
              <input type="number" class="form-control" id="inputRenda" name="inputRenda" aria-describedby="inputRendaHelp" value="{{ $parente->Renda }}" disabled>
            </div>
          </div>
        </div>
      </div>
      <hr>
    </div>
    @endforeach
  </div>
  -->
  <h3>DADOS ACADÊMICOS</h3>

  <div class="row">
    <div class="col">
      <div class="form-group">
        <label for="inputEscolaridade">Qual a sua escolaridade</label>
        <select name="inputEscolaridade" class="custom-select" disabled>
          <option selected>Selecione</option>
          <option value="Ensino fundamental completo" @if( $dados->Escolaridade === 'Ensino fundamental completo' ) {{ 'selected' }} @endif >Ensino fundamental completo</option>
          <option value="Ensino fundamental incompleto" @if( $dados->Escolaridade === 'Ensino fundamental incompleto' ) {{ 'selected' }} @endif >Ensino fundamental incompleto</option>
          <option value="Ensino fundamental cursando" @if( $dados->Escolaridade === 'Ensino fundamental cursando' ) {{ 'selected' }} @endif >Ensino fundamental cursando</option>
          <option value="Ensino médio completo" @if( $dados->Escolaridade === 'Ensino médio completo' ) {{ 'selected' }} @endif >Ensino médio completo</option>
          <option value="Ensino médio incompleto" @if( $dados->Escolaridade === 'Ensino médio incompleto' ) {{ 'selected' }} @endif >Ensino médio incompleto</option>
          <option value="Ensino médio cursando" @if( $dados->Escolaridade === 'Ensino médio cursando' ) {{ 'selected' }} @endif >Ensino médio cursando</option>
          <option value="Ensino Superior completo" @if( $dados->Escolaridade === 'Ensino Superior completo' ) {{ 'selected' }} @endif >Ensino Superior completo</option>
          <option value="Ensino Superior incompleto" @if( $dados->Escolaridade === 'Ensino Superior incompleto' ) {{ 'selected' }} @endif >Ensino Superior incompleto</option>
          <option value="Ensino Superior cursando" @if( $dados->Escolaridade === 'Ensino Superior cursando' ) {{ 'selected' }} @endif >Ensino Superior cursando</option>
        </select>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="form-group">
        <span for="inputEnsFundamental">Ensino Fundamental</span><br>
        <div class="form-check form-check-inline">
          <input <?php if(strpos($dados->EnsFundamental, 'rede publica') !== FALSE){ echo 'checked=checked';} ?> class="form-check-input" name="inputEnsFundamental[]" type="checkbox" id="rede_publica" value="rede publica" disabled>
          <span class="form-check-span" for="inputEnsFundamental1">Rede Pública</span>
        </div>
        <div class="form-check form-check-inline">
          <input <?php if(strpos($dados->EnsFundamental, 'particular sem bolsa') !== FALSE){ echo 'checked=checked';} ?> class="form-check-input" name="inputEnsFundamental[]" type="checkbox" id="particular_sem_bolsa" value="particular sem bolsa" disabled>
          <span class="form-check-span" for="inputEnsFundamental2">Particular sem bolsa</span>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <span for="inputPorcentagemBolsa">Particular com bolsa de:</span>
        <input max="100" pattern="[0-9]{1,3}" type="number" class="form-control" id="inputPorcentagemBolsa" name="inputPorcentagemBolsa" aria-describedby="inputPorcentagemBolsaHelp" value="{{ $dados->PorcentagemBolsa }}" disabled>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="form-group">
        <span for="inputEnsMedio">Ensino Médio</span><br>
        <div class="form-check form-check-inline">
          <input <?php if(strpos($dados->EnsMedio, 'rede publica') !== FALSE){ echo 'checked=checked';} ?> class="form-check-input" name="inputEnsMedio[]" type="checkbox" id="rede_publica" value="rede publica" disabled>
          <span class="form-check-span" for="inputEnsMedio1">Rede Pública</span>
        </div>
        <div class="form-check form-check-inline">
          <input <?php if(strpos($dados->EnsMedio, 'particular sem bolsa') !== FALSE){ echo 'checked=checked';} ?> class="form-check-input" name="inputEnsMedio[]" type="checkbox" id="particular_sem_bolsa" value="particular sem bolsa" disabled>
          <span class="form-check-span" for="inputEnsMedio2">Particular sem bolsa</span>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <span for="inputPorcentagemBolsaMedio">Particular com bolsa de:</span>
        <input max="100" pattern="[0-9]{1,3}" type="number" class="form-control" id="inputPorcentagemBolsaMedio" name="inputPorcentagemBolsaMedio" aria-describedby="inputPorcentagemBolsaMedioHelp" value="{{ $dados->PorcentagemBolsaMedio }}" disabled>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="form-group">
        <label for="inputVestibular">Já prestou algum vestibular?</label>
        <br>
        <div id="Vestibular" class="form-check form-check-inline">
          <input <?php if($dados->Vestibular == 'Sim'){ echo 'checked=checked';} ?> class="form-check-input" type="radio" name="inputVestibular" id="inputVestibular1" value="Sim" onclick="showInput('.dados-faculdade')" disabled>
          <label class="form-check-label" for="inputVestibular1">Sim</label>
        </div>
        <div class="form-check form-check-inline">
          <input <?php if($dados->Vestibular == 'Não'){ echo 'checked=checked';} ?> class="form-check-input" type="radio" name="inputVestibular" id="inputVestibular2" value="Não" onclick="hideInput('.dados-faculdade')" disabled>
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
          <input <?php if($dados->FaculdadeTipo == 'publica'){ echo 'checked=checked';} ?> class="form-check-input" type="radio" name="inputFaculdadeTipo" id="inputFaculdadeTipo1" value="publica" disabled>
          <label class="form-check-label" for="inputFaculdadeTipo1">Pública</label>
        </div>
        <div class="form-check form-check-inline">
          <input <?php if($dados->FaculdadeTipo == 'particular'){ echo 'checked=checked';} ?> class="form-check-input" type="radio" name="inputFaculdadeTipo" id="inputFaculdadeTipo2" value="particular" disabled>
          <label class="form-check-label" for="inputFaculdadeTipo2">Particular</label>
        </div>
      </div>
      @endif
    </div>
    <div class="col">
      @if($dados->Vestibular == 'sim')
      <div class="form-group dados-faculdade">
        <label for="inputNomeFaculdade">Qual nome da Faculdade?</label>
        <input type="text" class="form-control" id="inputNomeFaculdade" name="inputNomeFaculdade" aria-describedby="inputNomeFaculdadeHelp" value="{{ $dados->NomeFaculdade }}" disabled>
      </div>
      @endif
    </div>
  </div>
  <div class="row mb-2">
    <div class="col">
      @if($dados->Vestibular == 'sim')
      <div class="form-group dados-faculdade">
        <label for="inputCursoFaculdade">Curso</label>
        <input type="text" class="form-control" id="inputCursoFaculdade" name="inputCursoFaculdade" aria-describedby="inputCursoFaculdadeHelp" value="{{ $dados->CursoFaculdade }}" disabled>
      </div>
      @endif
    </div>
    <div class="col">
      <div class="form-group dados-faculdade">
        <label for="inputAnoFaculdade">Ano</label>
        <select name="inputAnoFaculdade" class="custom-select"  disabled>
          <option selected>Selecione</option>
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
    </div>
  </div>

  <div class="row">
    <div class="col-12 col-md-6">
      <div class="form-group">
        <label for="inputEnem">Já prestou Enem?</label>
        <br>
        <div id="enem" class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="inputEnem" id="inputEnem1" value="1" @if( $dados->Enem === 1 ) {{ 'checked' }} @endif disabled>
          <label class="form-check-label" for="inputEnem1">Sim</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="inputEnem" id="inputEnem2" value="0" @if( $dados->Enem === 0 ) {{ 'checked' }} @endif disabled >
          <label class="form-check-label" for="inputEnem2">Não</label>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <p>Para qual (quais) curso(s) pretende prestar vestibular?</p>
    </div>
    <div class="col">
      <div class="form-group">
        <span for="inputOpcoesVestibular1">Primeira Opção</span>
        <input type="text" class="form-control" id="inputOpcoesVestibular1" name="inputOpcoesVestibular1" aria-describedby="inputOpcoesVestibular1Help" value="{{ $dados->OpcoesVestibular1 }}" disabled>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <span for="inputOpcoesVestibular2">Segunda Opção</span>
        <input type="text" class="form-control" id="inputOpcoesVestibular2" name="inputOpcoesVestibular2" aria-describedby="inputOpcoesVestibular2Help" value="{{ $dados->OpcoesVestibular2 }}" disabled>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="form-group">
        <span for="inputVestibularOutraCidade">Quanto à Universidade, tem disponibilidade/interesse de estudar em outras cidades?</span>
        <select name="inputVestibularOutraCidade" class="custom-select" disabled>
          <option selected>Selecione</option>
          <option <?php if($dados->VestibularOutraCidade == 'sim'){ echo 'selected=selected';} ?> value="sim">Sim</option>
          <option <?php if($dados->VestibularOutraCidade == 'nao'){ echo 'selected=selected';} ?> value="nao">Não</option>
        </select>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <span for="inputComoSoube">Como você ficou sabendo do cursinho pré-vestibular da UNEafro Brasil?</span>
        <select name="inputComoSoube" class="custom-select" disabled>
          <option selected>Selecione</option>
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
        <label class="pb-3" for="inputComoSoubeOutros">Qual?</label>
        <input type="text" class="form-control" id="inputComoSoubeOutros" name="inputComoSoubeOutros" aria-describedby="inputComoSoubeOutrosHelp" value="{{ $dados->ComoSoubeOutros }}" disabled>
      </div>
      @endif
    </div>
  </div>

<hr />
Pré-cadastro feito em {{ $dados->created_at }}<br />
Atualizado em {{ $dados->updated_at }}

</div>
@endsection
