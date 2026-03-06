<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Aluno;
use App\Models\Instrutor;
use App\Models\Turma;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalAlunos = Aluno::count();
        $totalInstrutores = Instrutor::count();
        $totalTurmas = Turma::count();
        return view('admin.dashboard', compact('totalAlunos', 'totalInstrutores', 'totalTurmas'));
    }

    public function instrutores()
    {
        $instrutores = Instrutor::all();
        return view('admin.instrutores', compact('instrutores'));
    }

    public function criarInstrutor(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:instrutors,email',
            'senha' => 'required|min:6',
        ]);

        Instrutor::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'senha' => Hash::make($request->senha),
        ]);

        return redirect('/admin/instrutores')->with('success', 'Instrutor criado com sucesso!');
    }

    public function deletarInstrutor($id)
    {
        $instrutor = Instrutor::findOrFail($id);
        $instrutor->delete();
        return redirect('/admin/instrutores')->with('success', 'Instrutor deletado com sucesso!');
    }

    public function alunos()
    {
        $alunos = Aluno::with('turma')->get();
        $turmas = Turma::all();
        return view('admin.alunos', compact('alunos', 'turmas'));
    }

    public function moverAluno(Request $request, $id)
    {
        $request->validate([
            'fk_id_turma' => 'nullable|exists:turmas,id_turma',
        ]);

        $aluno = Aluno::findOrFail($id);
        $turma = $request->fk_id_turma ? Turma::findOrFail($request->fk_id_turma) : null;

        $aluno->update([
            'fk_id_turma' => $request->fk_id_turma,
            'turno' => $turma ? $turma->turno : null,
        ]);

        return redirect('/admin/alunos')->with('success', 'Aluno movido com sucesso!');
    }

    public function deletarAluno($id)
    {
        $aluno = Aluno::findOrFail($id);
        $aluno->delete();
        return redirect('/admin/alunos')->with('success', 'Aluno deletado com sucesso!');
    }

    // Turmas
    public function turmas()
    {
        $turmas = Turma::with('instrutor')->get();
        $instrutores = Instrutor::all();
        return view('admin.turmas', compact('turmas', 'instrutores'));
    }

    public function criarTurma(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'sala' => 'required|string|max:255',
            'turno' => 'required|string',
            'fk_id_instrutor' => 'required|exists:instrutors,id_instrutor',
        ]);

        Turma::create([
            'nome' => $request->nome,
            'sala' => $request->sala,
            'turno' => $request->turno,
            'fk_id_instrutor' => $request->fk_id_instrutor,
        ]);

        return redirect('/admin/turmas')->with('success', 'Turma criada com sucesso!');
    }

    public function editarTurma($id)
    {
        $turma = Turma::findOrFail($id);
        $instrutores = Instrutor::all();
        return view('admin.turmas_edit', compact('turma', 'instrutores'));
    }

    public function atualizarTurma(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'sala' => 'required|string|max:255',
            'turno' => 'required|string',
            'fk_id_instrutor' => 'required|exists:instrutors,id_instrutor',
        ]);

        $turma = Turma::findOrFail($id);
        $turma->update([
            'nome' => $request->nome,
            'sala' => $request->sala,
            'turno' => $request->turno,
            'fk_id_instrutor' => $request->fk_id_instrutor,
        ]);

        return redirect('/admin/turmas')->with('success', 'Turma atualizada com sucesso!');
    }

    public function deletarTurma($id)
    {
        $turma = Turma::findOrFail($id);
        $turma->delete();
        return redirect('/admin/turmas')->with('success', 'Turma deletada com sucesso!');
    }
}