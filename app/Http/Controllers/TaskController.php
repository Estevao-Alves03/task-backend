<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::paginate(15);
        // return response()->json($tasks);
        return view('tasks.index', compact('tasks'));
    }


    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    try {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    if (strtotime($value) < strtotime('today')) {
                        $fail('A data de vencimento não pode ser anterior a hoje!');
                    }
                }
            ],
            'priority' => 'required|in:baixa,media,alta',
            'category' => 'required|in:pessoal,trabalho,estudos,casa,saude',
        ]);

        $task = Task::create($data);

        // Retorne JSON com a tarefa criada
        return response()->json([
            'message' => 'Tarefa criada com sucesso!',
            'task' => $task,
        ], 201);
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'errors' => $e->errors(),
            'message' => 'Verifique os campos destacados',
        ], 422);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Erro ao criar tarefa: ' . $e->getMessage(),
        ], 500);
    }
}


    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('message', 'tarefa excluida com sucesso');
    }

    // public function __construct()
    // {
    //     $this->middleware('auth:sanctum')->except(['index', 'show', 'create', 'store']);
    // }
}
