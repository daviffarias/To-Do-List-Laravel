<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tarefas</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <header>
            <h1>Lista de Tarefas</h1>
            <form action="{{ route('tarefas.index') }}" method="GET">
                <input type="text" name="search" placeholder="Buscar tarefa">
                <button type="submit">Buscar</button>
            </form>
        </header>

        <ul>
            @foreach($tarefas as $tarefa)
                <li class="{{ $tarefa->concluida ? 'completed' : '' }}">
                    <span>{{ $tarefa->titulo }}</span>
                    <div>
                        @if (!$tarefa->concluida)
                            <form action="{{ route('tarefas.concluir', $tarefa) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit">Concluir</button>
                            </form>
                        @endif
                        <a href="{{ route('tarefas.edit', $tarefa->id) }}">Editar</a>
                        <form action="{{ route('tarefas.destroy', $tarefa->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Excluir</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>

        <form class="create-form" action="{{ route('tarefas.store') }}" method="POST">
            @csrf
            <input type="text" name="titulo" placeholder="Título da tarefa" required>
            <textarea name="descricao" placeholder="Descrição da tarefa"></textarea>
            <button type="submit">Adicionar Tarefa</button>
        </form>
    </div>
</body>
</html>
