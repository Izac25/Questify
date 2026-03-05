<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Turma;
use Illuminate\Support\Facades\Auth;

class AlunoController extends Controller
{
    public function index(Request $request)
    {
        $instrutor = Auth::guard('instrutor')->user();
        $turnos = $instrutor->turnos ?? [];
        $busca = $request->query('busca');

        $query = Aluno::with('turma')
            ->whereIn('turno', $turnos);

        if ($busca) {
            $query->where(function($q) use ($busca) {
                $q->where('nome', 'like', "%{$busca}%")
                  ->orWhere('email', 'like', "%{$busca}%");
            });
        }

        $alunos = $query->orderBy('nome')->get();

        return view('alunos.index', compact('alunos', 'busca', 'turnos'));
    }

    public function edit($id)
    {
        $aluno = Aluno::with('turma')->findOrFail($id);
        $turmas = Turma::all();
        return view('alunos.edit', compact('aluno', 'turmas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email',
            'turno' => 'required|string',
            'fk_id_turma' => 'nullable|exists:turmas,id_turma',
        ]);

        $aluno = Aluno::findOrFail($id);
        $aluno->update([
            'nome' => $request->nome,
            'email' => $request->email,
            'turno' => $request->turno,
            'fk_id_turma' => $request->fk_id_turma,
        ]);

        return redirect('/alunos')->with('success', 'Aluno atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $aluno = Aluno::findOrFail($id);
        $aluno->delete();
        return redirect('/alunos')->with('success', 'Aluno deletado com sucesso!');
    }
}