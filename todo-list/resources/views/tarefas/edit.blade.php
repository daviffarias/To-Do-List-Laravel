<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarefa</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
</head>
<body>
    <div class="edit-container">
        <h2>Editar Tarefa</h2>
        <form action="{{ route('tarefas.update', $tarefa->id) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="text" name="titulo" value="{{ $tarefa->titulo }}" required>
            <textarea name="descricao">{{ $tarefa->descricao }}</textarea>
            <label>
                <input type="checkbox" name="concluida" {{ $tarefa->concluida ? 'checked' : '' }}>
                Marcar como concluída
            </label>

            <button type="submit">Salvar Alterações</button>
        </form>
        <a href="{{ route('tarefas.index') }}">Voltar para Lista</a>
    </div>
</body>
</html>
