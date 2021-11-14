@extends('layouts.app')

@section('content')
<div class="container">
  <!-- PAGE HEADER -->
  <div class="row">
      <div class="col-12 text-center">
        <h1>CADASTRO DE PROFESSORES</h1>
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

  <form method="POST" action="/professores/create" enctype="multipart/form-data">
    @csrf
    <h3>DADOS PESSOAIS</h3>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputNomeProfessor">Nome do professor</label>
          <input type="text" class="form-control" id="inputNomeProfessor" name="inputNomeProfessor" aria-describedby="inputNomeProfessorHelp" placeholder="Nome do novo professor" required>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputNomeSocial">Nome Social do professor</label>
          <input type="text" class="form-control" id="inputNomeSocial" name="inputNomeSocial" aria-describedby="inputNomeSocialHelp" placeholder="Nome social do professor">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputNucleo">Núcleo</label>
          <select name="inputNucleo" class="custom-select" required>
            <option selected>Selecione</option>
            @foreach($nucleos as $nucleo)
            <option value="{{ $nucleo->id }}">{{ $nucleo->NomeNucleo }}</option>
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
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputCPF">CPF</label>
          <input type="text" class="form-control" id="inputCPF" name="inputCPF" aria-describedby="inputCPFHelp" data-mask="000.000.000-00" placeholder="xxx.xxx.xxx-xx" onblur="checkCPF()">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputRG">RG</label>
          <input type="text" class="form-control" id="inputRG" name="inputRG" aria-describedby="inputRGHelp" data-mask="00.000.000-00" placeholder="xx.xxx.xxx-x">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputRaca">Raça / Cor</label>
          <select name="inputRaca" class="custom-select">
            <option selected>Selecione</option>
            <option value="negra">Negra</option>
            <option value="branca">Branca</option>
            <option value="parda">Parda</option>
            <option value="amarela">Amarela</option>
            <option value="indigena">Indígena</option>
          </select>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputGenero">Identidade de Gênero</label>
          <select name="inputGenero" class="custom-select">
            <option selected>Selecione</option>
            <option value="mulher">Mulher</option>
            <option value="homem">Homem</option>
            <option value="mulher_trans_cis">Mulher (Trans ou Cis)</option>
            <option value="homem_trans_cis">Homem (Trans ou Cis)</option>
          </select>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="concordaSexoDesignado">Você se identifica com o sexo designado ao nascer?</label>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="concordaSexoDesignado" id="concordaSexoDesignado1" value="1" checked>
            <label class="form-check-label" for="concordaSexoDesignado1">
              Sim
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="concordaSexoDesignado" id="concordaSexoDesignado2" value="0">
            <label class="form-check-label" for="concordaSexoDesignado2">
              Não
            </label>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
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
      <div class="col">
        <div class="form-group">
          <label for="inputNascimento">Data de Nascimento</label>
          <input type="date" class="form-control" id="inputNascimento" name="inputNascimento" aria-describedby="inputNascimentoHelp" onblur="getAge()">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputDisciplinas">Disciplinas Lecionadas</label><br>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputDisciplinas[]" type="checkbox" id="artes" value="artes">
            <label class="form-check-label" for="inlineCheckbox1">Artes</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputDisciplinas[]" type="checkbox" id="atualidades" value="atualidades">
            <label class="form-check-label" for="inlineCheckbox2">Atualidades</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputDisciplinas[]" type="checkbox" id="biologia" value="biologia">
            <label class="form-check-label" for="inlineCheckbox2">Biologia</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputDisciplinas[]" type="checkbox" id="direitos_humanos" value="direitos_humanos">
            <label class="form-check-label" for="inlineCheckbox2">Direitos humanos</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputDisciplinas[]" type="checkbox" id="ecologia" value="ecologia">
            <label class="form-check-label" for="inlineCheckbox2">Ecologia</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputDisciplinas[]" type="checkbox" id="espanhol" value="espanhol">
            <label class="form-check-label" for="inlineCheckbox2">Espanhol</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputDisciplinas[]" type="checkbox" id="filosofia" value="filosofia">
            <label class="form-check-label" for="inlineCheckbox2">Filosofia</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputDisciplinas[]" type="checkbox" id="fisica" value="fisica">
            <label class="form-check-label" for="inlineCheckbox2">Física</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputDisciplinas[]" type="checkbox" id="formacao_politica" value="formacao_politica">
            <label class="form-check-label" for="inlineCheckbox2">Formação política</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputDisciplinas[]" type="checkbox" id="geografia_geral" value="geografia_geral">
            <label class="form-check-label" for="inlineCheckbox2">Geografia geral</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputDisciplinas[]" type="checkbox" id="genetica" value="genetica">
            <label class="form-check-label" for="inlineCheckbox2">Genética</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputDisciplinas[]" type="checkbox" id="geografia" value="geografia_1">
            <label class="form-check-label" for="inlineCheckbox2">Geografia</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputDisciplinas[]" type="checkbox" id="geografia_do_brasil" value="geografia_do_brasil">
            <label class="form-check-label" for="inlineCheckbox2">Geografia do Brasil</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputDisciplinas[]" type="checkbox" id="geometria" value="geometria">
            <label class="form-check-label" for="inlineCheckbox2">Geometria</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputDisciplinas[]" type="checkbox" id="geopolitica" value="geopolitica">
            <label class="form-check-label" for="inlineCheckbox2">Geopolítica</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputDisciplinas[]" type="checkbox" id="gramatica" value="gramatica">
            <label class="form-check-label" for="inlineCheckbox2">Gramática</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputDisciplinas[]" type="checkbox" id="historia" value="historia_1">
            <label class="form-check-label" for="inlineCheckbox2">História</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputDisciplinas[]" type="checkbox" id="historia_da_africa" value="historia_da_africa">
            <label class="form-check-label" for="inlineCheckbox2">História da África</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputDisciplinas[]" type="checkbox" id="historia_da_arte" value="historia_da_arte">
            <label class="form-check-label" for="inlineCheckbox2">História da Arte</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputDisciplinas[]" type="checkbox" id="historia_do_brasil" value="historia_do_brasil">
            <label class="form-check-label" for="inlineCheckbox2">História do Brasil</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputDisciplinas[]" type="checkbox" id="historia_geral" value="historia_geral">
            <label class="form-check-label" for="inlineCheckbox2">História Geral</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputDisciplinas[]" type="checkbox" id="historia_latino_americana" value="historia_latino_americana">
            <label class="form-check-label" for="inlineCheckbox2">História Latino Americana</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputDisciplinas[]" type="checkbox" id="historia_moderna_e_contemporanea" value="historia_moderna_e_contemporanea">
            <label class="form-check-label" for="inlineCheckbox2">História Moderna e Contemporânea</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputDisciplinas[]" type="checkbox" id="ingles" value="ingles">
            <label class="form-check-label" for="inlineCheckbox2">Inglês</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputDisciplinas[]" type="checkbox" id="interpretacao_textual" value="interpretacao_textual">
            <label class="form-check-label" for="inlineCheckbox2">Interpretação textual</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputDisciplinas[]" type="checkbox" id="literatura" value="literatura_1">
            <label class="form-check-label" for="inlineCheckbox2">Literatura</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputDisciplinas[]" type="checkbox" id="literatura_brasileira" value="literatura_brasileira">
            <label class="form-check-label" for="inlineCheckbox2">Literatura brasileira</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputDisciplinas[]" type="checkbox" id="literatura_portuguesa" value="literatura_portuguesa">
            <label class="form-check-label" for="inlineCheckbox2">Literatura Portuguesa</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputDisciplinas[]" type="checkbox" id="matematica" value="matematica">
            <label class="form-check-label" for="inlineCheckbox2">Matemática</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputDisciplinas[]" type="checkbox" id="orientacao_profissional" value="orientacao_profissional">
            <label class="form-check-label" for="inlineCheckbox2">Orientação profissional</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputDisciplinas[]" type="checkbox" id="quimica" value="quimica_1">
            <label class="form-check-label" for="inlineCheckbox2">Química</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputDisciplinas[]" type="checkbox" id="quimica_organica" value="quimica_organica">
            <label class="form-check-label" for="inlineCheckbox2">Química orgânica</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputDisciplinas[]" type="checkbox" id="redacao" value="redacao">
            <label class="form-check-label" for="inlineCheckbox2">Redação</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputDisciplinas[]" type="checkbox" id="sociologia" value="sociologia">
            <label class="form-check-label" for="inlineCheckbox2">Sociologia</label>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputEscolaridade">Qual a sua escolaridade</label>
          <select name="inputEscolaridade" class="custom-select">
            <option selected>Selecione</option>
            <option value="Ensino Médio">Ensino Médio</option>
            <option value="Ensino Superior Completo">Ensino Superior Completo</option>
            <option value="Ensino Superior Cursando">Ensino Superior Cursando</option>
            <option value="Ensino Superior Incompleto">Ensino Superior Incompleto</option>
            <option value="Pós Graduação Completa/Incompleta/Cursando">Pós Graduação Completa/Incompleta/Cursando</option>
          </select>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputOutrosNucleos">Você atua em mais de um núcleo? Qual?</label><br>
          @foreach($nucleos as $nucleo)
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="inputOutrosNucleos[]" type="checkbox" id="artes" value="{{ $nucleo->id }}">
            <label class="form-check-label" for="inlineCheckbox1">{{ $nucleo->NomeNucleo }}</label>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputFormacaoSuperior">Se você esteve/está no ensino superior, qual a sua formação?</label>
          <input type="text" class="form-control" id="inputFormacaoSuperior" name="inputFormacaoSuperior" aria-describedby="inputFormacaoSuperiorHelp" placeholder="Sua formação no ensino superior">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputAnoInicioUneafro">Desde que ano você está na UNEAFRO?</label>
          <br><br>
          <input type="text" class="form-control" id="inputAnoInicioUneafro" name="inputAnoInicioUneafro" aria-describedby="inputAnoInicioUneafroHelp" placeholder="4 dígitos (Ex. 2021)">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="aulasForaUneafro">Fora da UNEAFRO, você dá aulas?</label>
          <br><br>
          <select name="aulasForaUneafro" class="custom-select">
            <option selected>Selecione</option>
            <option value="Não" selected>Não</option>
            <option value="Sim, em escola regular">Sim, em escola regular</option>
            <option value="Sim, em escola pública ou privada">Sim, em escola pública ou privada</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputDiasHorarios">Quais são os dias e horários das suas aulas (por mês)?</label>
          <br>
          <textarea class="form-control" name="inputDiasHorarios" rows="8" placeholder="Exemplos:
Núcleo XX - 2 vezes por mês - segunda - das 19h às 20h30 / sábado - das 13h às 15h,
Núcleo YY - 1 vez por mês - aos sábados - das 9h às 11h"></textarea>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputGastoTransporte">Você tem gastos com transporte para chegar no cursinho? Se sim qual é o valor por dia?</label>
          <input type="text" class="form-control" id="inputGastoTransporte" name="inputGastoTransporte" aria-describedby="inputGastoTransporteHelp" placeholder="Ex: Sim. Gasto com metrô - R$ 8,60/dia.">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputTempoChegada">Quanto tempo você gasta para chegar no núcleo?</label>
          <input type="text" class="form-control" id="inputTempoChegada" name="inputTempoChegada" aria-describedby="inputTempoChegadaHelp" placeholder="Ex: 40 minutos">
        </div>
      </div>
    </div>
    <hr>
    <h3>ENDEREÇO</h3>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputCEP">CEP</label>
          <input type="text" class="form-control" id="inputCEP" name="inputCEP" aria-describedby="inputCEPHelp" data-mask="00000-000" placeholder="xxxxx-xxx" onblur="checkCEP('#inputCEP')">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputEndereco">Rua</label>
          <input pattern="([^\s][A-zÀ-ž\s]+)" type="text" class="form-control" id="inputEndereco" name="inputEndereco" aria-describedby="inputEnderecoHelp" placeholder="Rua, Avenida, Logradouro">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputNumero">Número</label>
          <input type="text" class="form-control" id="inputNumero" name="inputNumero" aria-describedby="inputNumeroHelp" placeholder="Número">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputBairro">Bairro</label>
          <input type="text" class="form-control" id="inputBairro" name="inputBairro" aria-describedby="inputBairroHelp" placeholder="Bairro">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputCidade">Cidade</label>
          <input type="text" class="form-control" id="inputCidade" name="inputCidade" aria-describedby="inputCidadeHelp" placeholder="Cidade/Município">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputEstado">Estado</label>
          <select id="inputEstado" name="inputEstado" class="custom-select">
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
        <div class="form-group">
          <label for="inputComplemento">Complemento</label>
          <input type="text" class="form-control" id="inputComplemento" name="inputComplemento" aria-describedby="inputComplementoHelp" placeholder="Complemento">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputFoneComercial">Telefone Comercial</label>
          <input type="text" class="form-control" id="inputFoneComercial" name="inputFoneComercial" aria-describedby="inputFoneComercialHelp" data-mask="(00) 0000-0000" placeholder="(xx)xxxx-xxxx">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputFoneResidencial">Telefone Residencial</label>
          <input type="text" class="form-control" id="inputFoneResidencial" name="inputFoneResidencial" aria-describedby="inputFoneResidencialHelp" data-mask="(00) 0000-0000" placeholder="(xx)xxxx-xxxx">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputFoneCelular">Telefone Celular</label>
          <input type="text" class="form-control" id="inputFoneCelular" name="inputFoneCelular" aria-describedby="inputFoneCelularHelp" data-mask="(00) 0 0000-0000" placeholder="(xx)xxxx-xxxx">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputEmail">Email</label>
          <input type="email" class="form-control" id="inputEmail" name="inputEmail" aria-describedby="inputEmailHelp" placeholder="Endereço de Email" required>
        </div>
      </div>
    </div>
    <hr>
    <h3>DADOS PROFISSIONAIS</h3>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputEmpresa">Nome da Empresa</label>
          <input type="text" class="form-control" id="inputEmpresa" name="inputEmpresa" aria-describedby="inputEmpresaHelp" placeholder="Nome da empresa onde trabalha">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputCEPEmpresa">CEP</label>
          <input type="text" class="form-control" id="inputCEPEmpresa" name="inputCEPEmpresa" aria-describedby="inputCEPEmpresaHelp" data-mask="00000-000" placeholder="xxxxx-xxx" onblur="checkCEP('#inputCEPEmpresa')">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputEnderecoEmpresa">Rua</label>
          <input pattern="([^\s][A-zÀ-ž\s]+)" type="text" class="form-control" id="inputEnderecoEmpresa" name="inputEnderecoEmpresa" aria-describedby="inputEnderecoEmpresaHelp" placeholder="Rua, Avenida, Logradouro">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputNumeroEmpresa">Número</label>
          <input type="text" class="form-control" id="inputNumeroEmpresa" name="inputNumeroEmpresa" aria-describedby="inputNumeroEmpresaHelp" placeholder="Número">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputComplementoEmpresa">Complemento</label>
          <input type="text" class="form-control" id="inputComplementoEmpresa" name="inputComplementoEmpresa" aria-describedby="inputComplementoEmpresaHelp" placeholder="Complemento">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputBairroEmpresa">Bairro</label>
          <input type="text" class="form-control" id="inputBairroEmpresa" name="inputBairroEmpresa" aria-describedby="inputBairroEmpresaHelp" placeholder="Bairro da empresa onde trabalha">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputCidadeEmpresa">Cidade da Empresa</label>
          <input type="text" class="form-control" id="inputCidadeEmpresa" name="inputCidadeEmpresa" aria-describedby="inputCidadeEmpresaHelp" placeholder="Cidade da empresa onde trabalha">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputEstadoEmpresa">Estado da Empresa</label>
          <select id="inputEstadoEmpresa" name="inputEstadoEmpresa" class="custom-select">
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
    <hr>
    <div class="row">
      <div class="col-6">
          <div class="form-group">
            <label for="inputProjetosRealizados">Já realizou trabalhos em projetos educacionais/Coletivos/Movimentos Sociais?</label>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inputProjetosRealizados" id="inputProjetosRealizados1" value="sim" onclick="showInput('.projeto-dados')">
              <label class="form-check-label" for="inputProjetosRealizados1">Sim</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inputProjetosRealizados" id="inputProjetosRealizados2" value="nao" onclick="hideInput('.projeto-dados')">
              <label class="form-check-label" for="inputProjetosRealizados2">Não</label>
            </div>
          </div>
      </div>
      <div class="col-3">
        <div class="form-group projeto-dados" style="display:none;">
          <label for="inputProjetosNome">Nome do projeto</label>
          <input type="text" class="form-control" id="inputProjetosNome" name="inputProjetosNome" aria-describedby="inputProjetosNomeHelp" placeholder="Nome do projeto">
        </div>
      </div>
      <div class="col-3">
        <div id="ProjetosQual" class="form-group projeto-dados" style="display:none;">
          <label for="inputProjetosFuncao">Função exercida</label>
          <input type="text" class="form-control" id="inputProjetosFuncao" name="inputProjetosFuncao" aria-describedby="inputProjetosFuncaoHelp" placeholder="Função exercida">
        </div>
      </div>
      <div class="col-6">
        <div class="form-group">
          <label for="inputComoSoube">Como você ficou sabendo do cursinho pré-vestibular da UNEafro Brasil?</label>
          <select id="comoSoube" name="inputComoSoube" class="custom-select" onchange="checkComosoube()">
            <option value="" selected>Selecione</option>
            <option value="internet">Internet</option>
            <option value="panfleto">Panfleto</option>
            <option value="amigos">Amigos</option>
            <option value="jornal">Jornal</option>
            <option value="outros">Outros</option>
          </select>
        </div>
      </div>
      <div class="col-6">
        <div id="ComoSoubeOutros" class="form-group" style="display:none;">
          <label for="inputComoSoubeOutros">Qual?</label>
          <input type="text" class="form-control" id="inputComoSoubeOutros" name="inputComoSoubeOutros" aria-describedby="inputComoSoubeOutrosHelp" placeholder="Qual">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputMotivoPrincipal">Qual foi o principal motivo que o/a levou a participar do Projeto?</label>
          <br>
          <textarea class="form-control" name="inputMotivoPrincipal" rows="8"></textarea>
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
            <option value="" selected>Selecione</option>
            <option value="em_curso">Em curso</option>
            <option value="completo">Completo</option>
            <option value="incompleto">Incompleto</option>
          </select>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputInstituicaoSuperior">Instituição</label>
          <input type="text" class="form-control" id="inputInstituicaoSuperior" name="inputInstituicaoSuperior" aria-describedby="inputInstituicaoSuperiorHelp" placeholder="Instituição em qual cursou">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputCursoSuperior1">Curso 1</label>
          <input type="text" class="form-control" id="inputCursoSuperior1" name="inputCursoSuperior1" aria-describedby="inputCursoSuperior1Help" placeholder="Informe o curso">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputAnoCursoSuperior1">Ano</label>
          <select name="inputAnoCursoSuperior1" class="custom-select">
            <option selected>Selecione</option>
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
      <div class="col">
        <div class="form-group">
          <label for="inputCursoSuperior2">Curso 2</label>
          <input type="text" class="form-control" id="inputCursoSuperior2" name="inputCursoSuperior2" aria-describedby="inputCursoSuperior2Help" placeholder="Informe o curso">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputAnoCursoSuperior2">Ano</label>
          <select name="inputAnoCursoSuperior2" class="custom-select">
            <option selected>Selecione</option>
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
    <hr>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputEspecializacao"><strong>Especialização</strong></label>
          <select name="inputEspecializacao" class="custom-select">
            <option value="" selected>Selecione</option>
            <option value="em_curso">Em curso</option>
            <option value="completo">Completo</option>
            <option value="incompleto">Incompleto</option>
          </select>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputInstEspecializacao">Instituição</label>
          <input type="text" class="form-control" id="inputInstEspecializacao" name="inputInstEspecializacao" aria-describedby="inputInstEspecializacaoHelp" placeholder="Informe a instituição">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputCursoEspecializacao">Curso</label>
          <input type="text" class="form-control" id="inputCursoEspecializacao" name="inputCursoEspecializacao" aria-describedby="inputCursoEspecializacaoHelp" placeholder="Informe o curso">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputAnoCursoEspecializacao">Ano de Conclusão</label>
          <select name="inputAnoCursoEspecializacao" class="custom-select">
            <option selected>Selecione</option>
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
    <hr>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputMestrado"><strong>Mestrado</strong></label>
          <select name="inputMestrado" class="custom-select">
            <option value="" selected>Selecione</option>
            <option value="em_curso">Em curso</option>
            <option value="completo">Completo</option>
            <option value="incompleto">Incompleto</option>
          </select>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputInstMestrado">Instituição</label>
          <input type="text" class="form-control" id="inputInstMestrado" name="inputInstMestrado" aria-describedby="inputInstMestradoHelp" placeholder="Informe a instituição">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="inputCursoMestrado">Curso</label>
          <input type="text" class="form-control" id="inputCursoMestrado" name="inputCursoMestrado" aria-describedby="inputCursoMestradoHelp" placeholder="Informe o curso">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="inputAnoCursoMestrado">Ano de Conclusão</label>
          <select name="inputAnoCursoMestrado" class="custom-select">
            <option selected>Selecione</option>
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
      <input type="hidden" name="inputStatus" value="1">
    </div>
    <button type="submit" class="btn btn-primary">Salvar Dados</button>
  </form>

</div>
@endsection

@section('js')
<script>
  $(document).ready(function(){
    $('#inputAnoInicioUneafro').mask('0000');
  });
</script>
@endsection
