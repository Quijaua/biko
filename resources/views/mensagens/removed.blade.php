@extends('mensagens._mensagens')

@section('content_message')
    <div class="card">
        <div class="card-header">
            Mensagens removidas
        </div>

        <div class="card-body table-responsive">
            <table class="table table-striped">
                <tbody>
                @forelse($mensagensAluno as $mensagemAluno)
                    <tr>
                        <td>
                            <i class="fas {{ $mensagemAluno->is_visualizado ? 'fa-envelope-open' : 'fa-envelope' }}"></i>

                        </td>
                        <th width="55%" scope="row">
                            <a href="{{ route('messages.show', $mensagemAluno->mensagem->id) }}">
                                {{ $mensagemAluno->mensagem->titulo }}
                            </a>
                        </th>
                        <td>
                            {{ \Carbon\Carbon::parse($mensagemAluno->mensagem->created_at)->format('d/m/Y h:i') }}
                        </td>
                        <td>
                            <a
                                href="{{ route('messages.show', $mensagemAluno->mensagem->id) }}"
                                class="btn btn-sm btn-success"
                            >
                                Visualizar
                            </a>
                        </td>
                    </tr>
                @empty
                    <p>Nenhuma mensagem encontrada</p>
                @endforelse
                </tbody>
            </table>

            {{ $mensagensAluno->links() }}
        </div>
    </div>
@endsection
