<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarefa;

class TarefaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Implementação da pesquisa
        $query = Tarefa::query();

        if ($request->has('search') && !empty($request->search)) {
            $query->where('titulo', 'like', '%' . $request->search . '%');
        }

        // Ordena tarefas: pendentes primeiro, concluídas por último
        $tarefas = $query->orderBy('concluida')->get();

        return view('tarefas.index', compact('tarefas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tarefas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
        ]);

        Tarefa::create([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
        ]);

        return redirect()->route('tarefas.index')
            ->with('success', 'Tarefa criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tarefa = Tarefa::findOrFail($id);
        return view('tarefas.show', compact('tarefa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tarefa = Tarefa::findOrFail($id);
        return view('tarefas.edit', compact('tarefa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
        ]);

        $tarefa = Tarefa::findOrFail($id);
        $tarefa->update([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'concluida' => $request->has('concluida'), // Verifica checkbox
        ]);

        return redirect()->route('tarefas.index')
            ->with('success', 'Tarefa atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tarefa = Tarefa::findOrFail($id);
        $tarefa->delete();

        return redirect()->route('tarefas.index')
            ->with('success', 'Tarefa excluída com sucesso!');
    }

    /**
     * Marcar uma tarefa como concluída.
     */
    public function concluir(Tarefa $tarefa)
    {
        $tarefa->concluida = true;
        $tarefa->save();

        return redirect()->route('tarefas.index')
            ->with('success', 'Tarefa concluída com sucesso!');
    }
}
