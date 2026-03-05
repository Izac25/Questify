<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turma;
use Illuminate\Support\Facades\Auth;

class TurmaController extends Controller
{
    // Listar turmas do instrutor logado
    public function index()
    {
        $turmas = Turma::where('fk_id_instrutor', Auth::guard('instrutor')->user()->id_instrutor)->get();
        return view('turmas.index', compact('turmas'));
    }

    // Mostrar formulário de criar turma
    public function create()
    {
        return view('turmas.create');
    }

    // Salvar turma
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'sala' => 'required|string|max:255',
            'turno' => 'required|string|max:255',
        ]);

        Turma::create([
            'fk_id_instrutor' => Auth::guard('instrutor')->user()->id_instrutor,
            'nome' => $request->nome,
            'sala' => $request->sala,
            'turno' => $request->turno,
        ]);

        return redirect('/turmas')->with('success', 'Turma criada com sucesso!');
    }

    // Mostrar formulário de editar turma
    public function edit($id)
    {
        $turma = Turma::findOrFail($id);
        return view('turmas.edit', compact('turma'));
    }

    // Atualizar turma
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'sala' => 'required|string|max:255',
            'turno' => 'required|string|max:255',
        ]);

        $turma = Turma::findOrFail($id);
        $turma->update([
            'nome' => $request->nome,
            'sala' => $request->sala,
            'turno' => $request->turno,
        ]);

        return redirect('/turmas')->with('success', 'Turma atualizada com sucesso!');
    }

    // Deletar turma
    public function destroy($id)
    {
        $turma = Turma::findOrFail($id);
        $turma->delete();
        return redirect('/turmas')->with('success', 'Turma deletada com sucesso!');
    }
}