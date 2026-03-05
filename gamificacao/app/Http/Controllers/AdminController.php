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
    // Dashboard do admin
    public function dashboard()
    {
        $totalAlunos = Aluno::count();
        $totalInstrutores = Instrutor::count();
        $totalTurmas = Turma::count();
        return view('admin.dashboard', compact('totalAlunos', 'totalInstrutores', 'totalTurmas'));
    }

    // Listar instrutores
    public function instrutores()
    {
        $instrutores = Instrutor::all();
        return view('admin.instrutores', compact('instrutores'));
    }

    // Criar instrutor
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

    // Deletar instrutor
    public function deletarInstrutor($id)
    {
        $instrutor = Instrutor::findOrFail($id);
        $instrutor->delete();
        return redirect('/admin/instrutores')->with('success', 'Instrutor deletado com sucesso!');
    }

    // Listar alunos
    public function alunos()
    {
        $alunos = Aluno::with('turma')->get();
        $turmas = Turma::all();
        return view('admin.alunos', compact('alunos', 'turmas'));
    }

    // Mover aluno de sala
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

    // Deletar aluno
    public function deletarAluno($id)
    {
        $aluno = Aluno::findOrFail($id);
        $aluno->delete();
        return redirect('/admin/alunos')->with('success', 'Aluno deletado com sucesso!');
    }
}