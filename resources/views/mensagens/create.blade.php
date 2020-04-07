@extends('mensagens._mensagens')

@section('content_message')
    <div class="card">
        <div class="card-header">Nova mensagem</div>

        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="inputPara">Para o núcleos:</label>
                        <select name="inputPara" id="inputPara" class="custom-select" multiple>
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
                        <label for="inputPara">Aluno</label>
                        <select name="inputPara" id="inputPara" class="custom-select">
                            <option value="null" selected>Todos os núcleos</option>
                            @foreach($nucleos as $nucleo)
                                <option value="{{ $nucleo->id }}">{{ $nucleo->NomeNucleo }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
