<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tarefas</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>Lista de Tarefas</h1>
    <form action="{{ route('tarefas.store') }}" method="POST">
        @csrf
        <input type="text" name="titulo" placeholder="Título" required>
        <textarea name="descricao" placeholder="Descrição"></textarea>
        <button type="submit">Criar Tarefa</button>
    </form>
    <ul>
        @foreach($tarefas as $tarefa)
            <li>
                {{ $tarefa->titulo }}
                <a href="{{ route('tarefas.edit', $tarefa->id) }}">Editar</a>
                <form action="{{ route('tarefas.destroy', $tarefa->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Deletar</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
