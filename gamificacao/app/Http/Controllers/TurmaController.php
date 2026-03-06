<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turma;
use App\Models\Aluno;
use Illuminate\Support\Facades\Auth;

class TurmaController extends Controller
{
    public function index()
{
    if (Auth::guard('admin')->check()) {
        $turmas = Turma::all();
    } else {
        $turmas = Turma::where('fk_id_instrutor', Auth::guard('instrutor')->user()->id_instrutor)->get();
    }
    return view('turmas.index', compact('turmas'));
}

    public function show($id)
    {
        $instrutor = Auth::guard('instrutor')->user();
        $turma = Turma::findOrFail($id);
        $alunos = Aluno::where('fk_id_turma', $id)->get();

        return view('turmas.show', compact('turma', 'alunos'));
    }

    public function create()
    {
        return view('turmas.create');
    }

  public function store(Request $request)
{
    $request->validate([
        'nome' => 'required|string|max:255',
        'sala' => 'required|string|max:255',
        'turno' => 'required|string|max:255',
    ]);

    $id_instrutor = Auth::guard('admin')->check()
        ? $request->fk_id_instrutor
        : Auth::guard('instrutor')->user()->id_instrutor;

    Turma::create([
        'fk_id_instrutor' => $id_instrutor,
        'nome' => $request->nome,
        'sala' => $request->sala,
        'turno' => $request->turno,
    ]);

    return redirect('/turmas')->with('success', 'Turma criada com sucesso!');
}

    public function edit($id)
    {
        $turma = Turma::findOrFail($id);
        return view('turmas.edit', compact('turma'));
    }

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

    public function destroy($id)
    {
        $turma = Turma::findOrFail($id);
        $turma->delete();
        return redirect('/turmas')->with('success', 'Turma deletada com sucesso!');
    }
}