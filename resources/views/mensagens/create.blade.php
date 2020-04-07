@extends('mensagens._mensagens')

@section('content_message')
    <div class="card">
        <div class="card-header">Nova mensagem</div>

        <div class="card-body">
            <form action="{{ route('messages.store') }}" id="mensagem-form" method="POST">
                @csrf

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="nucleos">Para os núcleos:</label>
                            <select name="nucleos[]" id="inputParaNucleo" class="custom-select" multiple>
                                <option value="null" selected>Todos os núcleos</option>
                                @foreach($nucleos as $nucleo)
                                    <option value="{{ $nucleo->id }}">{{ $nucleo->NomeNucleo }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row d-none" id="divAluno">
                    <div class="col">
                        <div class="form-group">
                            <label for="alunos">Para o alunos:</label>
                            <select name="alunos[]" id="inputParaAluno" class="custom-select" multiple>
                            </select>
                            <small class="form-text text-muted">Mantenha o campo vazio caso queira enviar para todos os alunos dos núcleos selecionados.</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group @if ($errors->has('mensagem')) has-error @endif">
                            <label for="editor">Mensagem:</label>
                            <div id="editor"></div>
                            <input type="hidden" id="mensagem" name="mensagem" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 offset-md-8 text-right">
                        <a class="btn btn-danger" href="{{ url()->previous() }}">Voltar</a>
                        <button type="submit" class="btn btn-success">Salvar Dados</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
