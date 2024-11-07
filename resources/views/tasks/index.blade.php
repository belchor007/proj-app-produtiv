@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Lista de Tarefas</h2>

    <!-- Exibir Mensagens de Sucesso -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulário de criação de tarefa -->
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Título da Tarefa</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Adicionar Tarefa</button>
    </form>

    <!-- Listar Tarefas -->
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Concluída</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->title }}</td>
                    <td>
                        <form action="{{ route('tasks.toggleComplete', $task) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="checkbox" name="completed" onclick="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-secondary">Editar</a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
