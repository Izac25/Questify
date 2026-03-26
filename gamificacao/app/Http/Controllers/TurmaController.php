<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turma;
use App\Models\Aluno;
use App\Models\Instrutor;
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

    public function show($id_turma)
    {
        // O middleware já validou, então você pode acessar tranquilo
        $turma = Turma::with('instrutor')->find($id_turma);

        return response()->json([
            'sucesso' => true,
            'turma' => $turma
        ]);
    }

    public function create()
    {
        // Buscar o instrutor autenticado
        $instrutor = Auth::guard('instrutor')->user();
        
        if (!$instrutor) {
            return redirect('/login')->with('error', 'Você precisa estar autenticado');
        }

        // Pegar os turnos permitidos do instrutor
        $turnosPermitidos = $instrutor->turnos ?? [];

        return view('turmas.create', compact('turnosPermitidos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'sala' => 'required|string|max:255',
            'turno' => 'required|string|in:manhã,tarde,noite',
        ]);

        // Determinar o ID do instrutor
        $id_instrutor = Auth::guard('admin')->check()
            ? $request->fk_id_instrutor
            : Auth::guard('instrutor')->user()->id_instrutor;

        // Buscar o instrutor
        $instrutor = Instrutor::find($id_instrutor);

        if (!$instrutor) {
            return redirect('/turmas')->with('error', 'Instrutor não encontrado!');
        }

        // Verificar se o instrutor tem permissão para este turno
        $turnosPermitidos = $instrutor->turnos ?? [];

        if (!in_array($request->turno, $turnosPermitidos)) {
            return redirect('/turmas')->with('error', 'Você não tem permissão para criar turmas no turno: ' . $request->turno);
        }

        // Se passou na validação, cria a turma
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

    public function destroy($id)
    {
        $turma = Turma::findOrFail($id);
        $turma->delete();
        return redirect('/turmas')->with('success', 'Turma deletada com sucesso!');
    }

    public function update(Request $request, $id_turma)
    {
        $turma = Turma::find($id_turma);

        $validated = $request->validate([
            'nome' => 'sometimes|string',
            'turno' => 'sometimes|in:manhã,tarde,noite'
        ]);

        $turma->update($validated);

        return response()->json([
            'sucesso' => true,
            'mensagem' => 'Turma atualizada',
            'turma' => $turma
        ]);
    }
}