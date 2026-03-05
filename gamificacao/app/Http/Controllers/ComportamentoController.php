<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comportamento;
use App\Models\Aluno;
use Illuminate\Support\Facades\Auth;

class ComportamentoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'fk_id_aluno' => 'required|exists:alunos,id_aluno',
            'motivo' => 'required|string',
            'motivo_livre' => 'nullable|string|max:255',
            'pontos' => 'required|integer',
        ]);

        $instrutor = Auth::guard('instrutor')->user();

        Comportamento::create([
            'fk_id_aluno' => $request->fk_id_aluno,
            'fk_id_instrutor' => $instrutor->id_instrutor,
            'motivo' => $request->motivo,
            'motivo_livre' => $request->motivo_livre,
            'pontos' => $request->pontos,
        ]);

        // Atualiza pontos de comportamento do aluno
        $aluno = Aluno::findOrFail($request->fk_id_aluno);
        $aluno->update([
            'pontos_comportamento' => $aluno->pontos_comportamento + $request->pontos
        ]);

        return back()->with('success', 'Comportamento registrado com sucesso!');
    }
}