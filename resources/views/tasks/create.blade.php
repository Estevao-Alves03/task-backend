<!DOCTYPE html>
<html>

<head>
    <title>Criar tarefa</title>
</head>

<body>
    <h1>Criar nova tarefa</h1><br>

    <form action={{ route('tasks.store') }} method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="csrf-token">
        @csrf

        <label>Titulo:</label><br>
        <input type="text" name="title" required><br><br>

        <label>Descriçao:</label><br>
        <textarea name="description"></textarea><br><br>

        <label>Nivel de prioridade:</label><br>
        <select name="priority" required>
            <option value="baixa">baixa</option>
            <option value="media">media</option>
            <option value="alta">alta</option>
        </select><br><br>

        <label>categoria:</label><br>
        <select name="category" required>
            <option value="pessoal">pessoal</option>
            <option value="trabalho">trabalho</option>
            <option value="estudos">estudos</option>
            <option value="casa">casa</option>
            <option value="saude">saude</option>
        </select><br><br>

        <label>Data de vencimento:</label><br>
        <input type="date" name="due_date" required><br><br>

        <button type="submit">Criar tarefa</button>
    </form>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</body>
</html>
