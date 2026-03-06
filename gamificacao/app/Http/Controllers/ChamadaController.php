<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chamada;
use App\Models\Aluno;
use App\Models\Turma;
use Illuminate\Support\Facades\Auth;

class ChamadaController extends Controller
{
    // Página de chamada por turma
    public function index($id_turma)
{
    $turma = Turma::findOrFail($id_turma);
    $alunos = Aluno::where('fk_id_turma', $id_turma)->get();
    $data = request('data', now()->format('Y-m-d'));

    $chamadas = Chamada::where('fk_id_turma', $id_turma)
        ->where('data', $data)
        ->pluck('presente', 'fk_id_aluno');

    $historico = Chamada::where('fk_id_turma', $id_turma)
        ->with('aluno')
        ->orderBy('data', 'desc')
        ->get()
        ->groupBy(fn($c) => $c->data->format('d/m/Y'));

    return view('chamada.index', compact('turma', 'alunos', 'data', 'chamadas', 'historico'));
}

    // Salvar chamada do dia
public function store(Request $request, $id_turma)
{
    if (Auth::guard('admin')->check()) {
        $id_instrutor = \App\Models\Turma::findOrFail($id_turma)->fk_id_instrutor;
    } else {
        $id_instrutor = Auth::guard('instrutor')->user()->id_instrutor;
    }

    $data = $request->data;
    $presentes = $request->presentes ?? [];
    $alunos = Aluno::where('fk_id_turma', $id_turma)->get();

    foreach ($alunos as $aluno) {
        $presente = in_array($aluno->id_aluno, $presentes);

        $chamada = Chamada::where('fk_id_aluno', $aluno->id_aluno)
            ->where('fk_id_turma', $id_turma)
            ->where('data', $data)
            ->first();

        if ($chamada) {
            if ($chamada->presente && !$presente) {
                $aluno->update([
                    'frequencia' => max(0, $aluno->frequencia - 1),
                    'pontos' => max(0, $aluno->pontos - 2),
                ]);
            } elseif (!$chamada->presente && $presente) {
                $aluno->update([
                    'frequencia' => $aluno->frequencia + 1,
                    'pontos' => $aluno->pontos + 2,
                ]);
            }
            $chamada->update(['presente' => $presente]);
        } else {
            Chamada::create([
                'fk_id_aluno' => $aluno->id_aluno,
                'fk_id_instrutor' => $id_instrutor,
                'fk_id_turma' => $id_turma,
                'data' => $data,
                'presente' => $presente,
            ]);

            if ($presente) {
                $aluno->update([
                    'frequencia' => $aluno->frequencia + 1,
                    'pontos' => $aluno->pontos + 2,
                ]);
            }
        }
    }

    return redirect("/chamada/{$id_turma}?data={$data}")->with('success', 'Chamada salva com sucesso!');
}
}