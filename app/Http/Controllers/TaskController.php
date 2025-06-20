<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::paginate(15);
        return response()->json($tasks);
        // return view('tasks.index', compact('tasks'));
    }


    /**
     * Store a newly created resource in storage.
     */

public function store(Request $request)
{
    try {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date'    => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    // converte ao fuso de SP
                    $clientDate = Carbon::parse($value, 'America/Sao_Paulo')->startOfDay();
                    $today      = Carbon::today('America/Sao_Paulo')->startOfDay();
                    if ($clientDate->lt($today)) {
                        $fail('A data de vencimento não pode ser anterior a hoje.');
                    }
                },
            ],
            'priority'    => 'required|in:baixa,media,alta',
            'category'    => 'required|in:pessoal,trabalho,estudos,casa,saude',
        ]);

        $data['done'] = false;
        $task = Task::create($data);

        return response()->json([
            'message' => 'Tarefa criada com sucesso!',
            'task'    => $task,
        ], 201);
    } catch (ValidationException $e) {
        return response()->json([
            'errors'  => $e->errors(),
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
public function update(Request $request, $id)
{
    $task = Task::findOrFail($id);
    $task->done = $request->input('done');
    $task->save();
    return response()->json($task);
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
