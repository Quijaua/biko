@extends('mensagens._mensagens')

@section('content_message')
    <div class="card">
        <div class="card-header">Nova mensagem</div>

        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="inputParaNucleo">Para os núcleos:</label>
                        <select name="inputParaNucleo" id="inputParaNucleo" class="custom-select" multiple>
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
                        <label for="inputParaAluno">Para o alunos:</label>
                        <select name="inputParaAluno" id="inputParaAluno" class="custom-select" multiple>
                        </select>
                        <small class="form-text text-muted">Mantenha o campo vazio caso queira enviar para todos os alunos dos núcleos selecionados.</small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="editor">Mensagem:</label>
                        <div id="editor">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 offset-md-8 text-right">
                    <a class="btn btn-danger" href="{{ url()->previous() }}">Voltar</a>
                    <button type="submit" class="btn btn-success">Salvar Dados</button>
                </div>
            </div>
        </div>
    </div>
@endsection
