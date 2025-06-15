<!DOCTYPE html>
<html>
<head>
    <title>Detalhes da tarefa</title>
</head>
<body>

    <a href={{route('tasks.index')}}>Voltar a lista de tarefas</a>

    <h1>{{$task->title}}</h1>
    <p><strong>Descriçao:</strong>{{$task->description}}</p>
    <p><strong>Prioridade:</strong>{{$task->priority}}</p>
    <p><strong>Categoria:</strong>{{$task->category}}</p>
    <p><strong>Data do vencimento:</strong>{{\Carbon\Carbon::parse($task->due_date)->format('d/m/y')}}</p>

    <form action={{route('tasks.destroy', $task->id)}} method="post" onsubmit="return confirm('tem certeza que deseja excluir?')">
        @csrf
        @method('DELETE')
        <button type="submit">Deletar</button>
    </form>

</body>
</html>