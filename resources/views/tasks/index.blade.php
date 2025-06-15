<!DOCTYPE html>
<html>
<head>
    <h1>Lista de tarefas</h1>
</head>
<body>
    <h1>Tarefas</h1>

    <a href={{route('tasks.create')}}>Crian nova taefa</a>
    <ul>
        @foreach ($tasks as $task)
            <strong>{{$task->title}}</strong> - {{$task->priority}} - {{$task->category}} - {{$task->due_date->format('d/m/y')}};
            <td>
                <a href={{route('tasks.show', $task->id)}}>Ver detalhes da tarefa</a><br>
            </td>
            <p>{{$task->description}}</p><br><br>      
        @endforeach
        {{$tasks->links()}}
    </ul>
</body>
</html>