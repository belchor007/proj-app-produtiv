<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view ('tasks.index', compact('tasks'));
    }

    // Criar tarefa
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Task::create($request->all());

        return redirect()->route('tasks.index')->with('success', 'Tarefa criada com sucesso.');
        
    }
    // Editar Tarefa
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }
    

    //  Atualizar Tarefa
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $task->update($request->only('title'));

        return redirect()->route('tasks.index')->with('success', 'Tarefa atualizada com sucesso.');
    }

    
    //   Excluir Tarefa
     
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tarefa excluida com sucesso.');
    }
    // Selecionar Tarefa 
    public function toggleComplete(Task $task){
        $task->completed = !$task->completed;
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Status da tarefa selecionada com sucesso');
    }
}
