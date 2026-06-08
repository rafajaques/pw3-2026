<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use Illuminate\Http\Request;

class KeepController extends Controller
{
    public function index()
    {
        $notas = Nota::all();

        return view('keep/index', [
            'notas' => $notas,
        ]);
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            dd($request);
            $dados = $request->validate([
                'nota' => 'required|min:5|max:255',
                'cor' => 'required'
            ]);

            Nota::create($dados);
            return redirect()->route('keep.index')->with('mensagem', 'Nota criada com sucesso.');
        }

        return view('keep/create');
    }

    public function edit(Request $request, Nota $nota)
    {
        if ($request->isMethod('put')) {

            $dados = $request->validate([
                'nota' => 'required|min:5|max:255',
                'cor' => 'required'
            ]);

            $nota->update($dados);
            return redirect()->route('keep.index')->with('mensagem', 'Nota atualizada com sucesso.');
        }
        return view('keep.create', [
            'nota' => $nota,
        ]);
    }

    public function delete(Nota $nota)
    {
        if (request()->isMethod('delete')) {
            // Desativa operações com timestamp temporariamente para evitar que o campo "updated_at" seja atualizado.
            $nota->timestamps = false;
            $nota->delete();

            return redirect()->route('keep.index')->with('mensagem', 'Nota excluída com sucesso.');
        }

        return view('keep.delete', [
            'nota' => $nota,
        ]);
    }

    public function trash()
    {
        $notas = Nota::onlyTrashed()->get();

        return view('keep.trash', [
            'notas' => $notas,
        ]);
    }

    public function restore(Nota $nota)
    {
        $nota->timestamps = false;
        $nota->restore();

        return redirect()->route('keep.index')->with('mensagem', 'Nota restaurada com sucesso.');
    }
}
