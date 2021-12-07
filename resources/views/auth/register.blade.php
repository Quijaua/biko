@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Pré-cadastro') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row">
                          <div class="col-12">
                            <h2>Dados Pessoais</h2>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="name">{{ __('Nome') }}</label>
                              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                              <small id="nameHelp" class="form-text text-muted">Por favor, informe seu nome completo, da mesma forma em que consta em seu RG.</small>
                            </div>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="NomeSocial">{{ __('Nome Social') }}</label>
                              <input id="NomeSocial" type="text" class="form-control @error('NomeSocial') is-invalid @enderror" name="NomeSocial" value="{{ old('NomeSocial') }}" autocomplete="NomeSocial" autofocus>
                              <small id="NomeSocialHelp" class="form-text text-muted">Qual nome você gostaria que aparecesse na lista de chamada e fosse usado nas aulas?</small>
                            </div>
                            @error('NomeSocial')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-12 col-md-4">
                            <div class="form-group">
                              <label for="phone">{{ __('Celular') }}</label><br><br>
                              <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" data-mask="(00) 0 0000-0000" required autocomplete="phone" autofocus>
                              <small id="phoneHelp" class="form-text text-muted">Por favor, informe o número do seu celular, com DDD</small>
                            </div>
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                          <div class="col-12 col-md-4">
                            <div class="form-group">
                              <label for="email">{{ __('E-Mail') }}</label><br><br>
                              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                              <small id="emailHelp" class="form-text text-muted">Todos os e-mails do sistema serão enviados para este endereço.</small>
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }} <a href="/password/reset/">Clique aqui</a> para cadastrar ou alterar a sua senha no sistema.</strong>
                                </span>
                            @enderror
                          </div>
                          <div class="col-12 col-md-4">
                            <div class="form-group">
                              <label for="inputNucleo">Tem preferência por fazer as aulas em algum núcleo?</label>
                              <?php $nucleos = DB::table('nucleos')->where('status', 1)->orderBy('Regiao','asc')->get(); ?>
                              <select name="inputNucleo" class="custom-select" required>
                                <option value="">Selecione</option>
                                @foreach($nucleos as $nucleo)
                                <option value="{{ $nucleo->id }}">{{ $nucleo->Regiao }} - {{ $nucleo->NomeNucleo }} - {{ $nucleo->InfoInscricao }}</option>
                                @endforeach
                              </select>
                              <small id="nucleoHelp" class="form-text text-muted">Por favor, informe o núcleo do seu interesse.</small>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="inputRaca">Raça / Cor</label>
                              <select name="inputRaca" class="custom-select" required>
                                <option value="" selected>Selecione</option>
                                <option value="preta">Preta</option>
                                <option value="branca">Branca</option>
                                <option value="parda">Parda</option>
                                <option value="amarela">Amarela</option>
                                <option value="indigena">Indígena</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="inputGenero">Identidade de Gênero</label>
                              <select name="inputGenero" class="custom-select" required>
                                <option value="" selected>Selecione</option>
                                <option value="mulher">Mulher</option>
                                <!--<option value="homem">Homem</option>-->
                                <option value="mulher_trans_cis">Mulher (Trans ou Cis)</option>
                                <option value="homem_trans_cis">Homem (Trans ou Cis)</option>
                                <option value="nao_binarie">Não Binarie</option>
                              </select>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="concordaSexoDesignado">Você se identifica com o gênero designado ao nascer?</label>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="concordaSexoDesignado" id="concordaSexoDesignado1" value="1">
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
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="inputNascimento">Data de Nascimento</label>
                              <input type="date" class="form-control" id="inputNascimento" name="inputNascimento" aria-describedby="inputNascimentoHelp" onblur="getAge()" required>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-12">
                            <div class="form-group">
                              <label for="responsavelCuidadoOutraPessoa">É responsável pelo cuidado de outra pessoa?</label>
                              <select name="responsavelCuidadoOutraPessoa" class="custom-select">
                                <option value="Não">Não</option>
                                <option value="Sim, por uma criança">Sim, por uma criança</option>
                                <option value="Sim, por uma pessoa idosa ou pessoa adulta que demanda cuidados especiais">Sim, por uma pessoa idosa ou pessoa adulta que demanda cuidados especiais</option>
                              </select>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="temFilhos">Tem filhos?</label>
                              <select class="custom-select" name="temFilhos">
                                <option value="1">Sim</option>
                                <option value="0" selected>Não</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div id="filhos_qt_wrapper" style="display: none;">
                              <div class="form-group">
                                <label for="filhosQt">Quantos?</label>
                                <input class="form-control" type="number" name="filhosQt">
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-12">
                            <hr>
                            <h2>Endereço</h2>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="inputCEP">CEP (Somente números)</label>
                              <input type="text" class="form-control" id="inputCEP" name="inputCEP" aria-describedby="inputCEPHelp" data-mask="00000000" placeholder="xx.xxx-xxx" onblur="checkCEP('#inputCEP')" required>
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="inputEndereco">Logradouro</label>
                              <input pattern="([^\s][A-zÀ-ž\s]+)" type="text" class="form-control" id="inputEndereco" name="inputEndereco" aria-describedby="inputEnderecoHelp" placeholder="Rua, Avenida, Logradoouro" required>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="inputNumero">Número</label>
                              <input type="number" class="form-control" id="inputNumero" name="inputNumero" aria-describedby="inputNumeroHelp" placeholder="Número" required>
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="inputComplemento">Complemento</label>
                              <input type="text" class="form-control" id="inputComplemento" name="inputComplemento" aria-describedby="inputComplementoHelp" placeholder="Complemento">
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-12">
                            <div class="form-group">
                              <label for="inputCEPProprio">Esse CEP é seu ou uma referência?</label>
                              <select id="inputCEPProprio" name="inputCEPProprio" class="custom-select" required>
                                <option value="1">Sim, é meu</option>
                                <option value="0">Não, esse CEP é uma referência</option>
                              </select>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="inputBairro">Distrito</label>
                              <input type="text" class="form-control" id="inputBairro" name="inputBairro" aria-describedby="inputBairroHelp" placeholder="Distrito" required>
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="inputCidade">Cidade</label>
                              <input type="text" class="form-control" id="inputCidade" name="inputCidade" aria-describedby="inputCidadeHelp" required>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="inputEstado">Estado</label>
                              <select id="inputEstado" name="inputEstado" class="custom-select" required>
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
                          <div class="col-12">
                            <hr>
                            <h2>Escolaridade</h2>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label for="inputEscolaridade">Qual a sua escolaridade</label>
                              <select name="inputEscolaridade" class="custom-select" required>
                                <option selected>Selecione</option>
                                <option value="Ensino fundamental completo">Ensino fundamental completo</option>
                                <option value="Ensino fundamental incompleto">Ensino fundamental incompleto</option>
                                <option value="Ensino fundamental cursando">Ensino fundamental cursando</option>
                                <option value="Ensino médio completo">Ensino médio completo</option>
                                <option value="Ensino médio incompleto">Ensino médio incompleto</option>
                                <option value="Ensino médio cursando">Ensino médio cursando</option>
                                <option value="Ensino Superior completo">Ensino Superior completo</option>
                                <option value="Ensino Superior incompleto">Ensino Superior incompleto</option>
                                <option value="Ensino Superior cursando">Ensino Superior cursando</option>
                              </select>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="inputEnsFundamental">Ensino Fundamental</label><br>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" name="inputEnsFundamental[]" type="checkbox" id="rede_publica" value="rede publica">
                                <label class="form-check-label" for="inputEnsFundamental1">Rede Pública</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" name="inputEnsFundamental[]" type="checkbox" id="particular_sem_bolsa" value="particular sem bolsa">
                                <label class="form-check-label" for="inputEnsFundamental2">Particular sem bolsa</label>
                              </div>
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="inputPorcentagemBolsa">Particular com bolsa de:</label>
                              <input max="100" pattern="[0-9]{1,3}" type="number" class="form-control" id="inputPorcentagemBolsa" name="inputPorcentagemBolsa" aria-describedby="inputPorcentagemBolsaHelp" placeholder="%">
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="inputEnsMedio">Ensino Médio</label><br>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" name="inputEnsMedio[]" type="checkbox" id="rede_publica" value="rede publica">
                                <label class="form-check-label" for="inputEnsMedio1">Rede Pública</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" name="inputinputEnsMedio[]" type="checkbox" id="particular_sem_bolsa" value="particular sem bolsa">
                                <label class="form-check-label" for="inputEnsMedio2">Particular sem bolsa</label>
                              </div>
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="inputPorcentagemBolsaMedio">Particular com bolsa de:</label>
                              <input max="100" pattern="[0-9]{1,3}" type="number" class="form-control" id="inputPorcentagemBolsaMedio" name="inputPorcentagemBolsaMedio" aria-describedby="inputPorcentagemBolsaMedioHelp" placeholder="%">
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="inputVestibular">Já prestou vestibular?</label>
                              <br>
                              <div id="Vestibular" class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inputVestibular" id="inputVestibular1" value="Sim">
                                <label class="form-check-label" for="inputVestibular1">Sim</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inputVestibular" id="inputVestibular2" value="Não">
                                <label class="form-check-label" for="inputVestibular2">Não</label>
                              </div>
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="inputEnem">Já prestou Enem?</label>
                              <br>
                              <div id="enem" class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inputEnem" id="inputEnem1" value="1">
                                <label class="form-check-label" for="inputEnem1">Sim</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inputEnem" id="inputEnem2" value="0">
                                <label class="form-check-label" for="inputEnem2">Não</label>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-12">
                            <p>Para qual (quais) curso(s) pretende prestar vestibular?</p>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="inputOpcoesVestibular1">Primeira Opção</label>
                              <input type="text" class="form-control" id="inputOpcoesVestibular1" name="inputOpcoesVestibular1" aria-describedby="inputOpcoesVestibular1Help" placeholder="Informe a primeira opção" required>
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="inputOpcoesVestibular2">Segunda Opção</label>
                              <input type="text" class="form-control" id="inputOpcoesVestibular2" name="inputOpcoesVestibular2" aria-describedby="inputOpcoesVestibular2Help" placeholder="Informe a segunda opção" required>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-12 col-md-4">
                            <div class="form-group">
                              <label for="inputVestibularOutraCidade">Quanto à Universidade, tem disponibilidade/interesse de estudar em outras cidades?</label>
                              <select name="inputVestibularOutraCidade" class="custom-select">
                                <option value="" selected>Selecione</option>
                                <option value="sim">Sim</option>
                                <option value="nao">Não</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-12 col-md-4">
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
                          <div class="col-12 col-md-4">
                            <div id="ComoSoubeOutros" class="form-group">
                              <label for="inputComoSoubeOutros">Outros Qual?</label><br><br><br>
                              <input type="text" class="form-control" id="inputComoSoubeOutros" name="inputComoSoubeOutros" aria-describedby="inputComoSoubeOutrosHelp">
                            </div>
                          </div>
                          <input type="hidden" name="inputStatus" value="1">
                        </div>

                        <!--<div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                <small id="passwordHelp" class="form-text text-muted">A senha deve ter, no mínimo, 8 caracteres.</small>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>-->

                        <!--<div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                <small id="password-confirmHelp" class="form-text text-muted">Repita a mesma senha digitada no campo anterior.</small>

                                <input id="role" type="hidden" name="role" value="aluno">
                            </div>
                        </div>-->
                        <input id="role" type="hidden" name="role" value="aluno">

                        <div class="form-group row mt-3 mb-0">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Cadastrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
  $(document).ready(function () {
    $('select[name=temFilhos').change(function(){
      if( $(this).val() === '1' ) {
        $('#filhos_qt_wrapper').fadeIn();
      } else {
        $('#filhos_qt_wrapper').fadeOut();
      }
    });
  });
</script>
@endsection
