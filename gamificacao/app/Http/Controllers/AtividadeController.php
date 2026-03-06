<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Atividade;
use App\Models\Entrega;
use App\Models\Aluno;
use Illuminate\Support\Facades\Auth;

class AtividadeController extends Controller
{
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            $atividades = Atividade::orderBy('data_limite', 'asc')->get();
        } else {
            $atividades = Atividade::where('fk_id_instrutor', Auth::guard('instrutor')->user()->id_instrutor)
                ->orderBy('data_limite', 'asc')
                ->get();
        }
        return view('atividades.index', compact('atividades'));
    }

    public function create()
    {
        return view('atividades.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'pontos' => 'required|integer|min:0',
            'turno' => 'required|string',
            'data_limite' => 'nullable|date',
        ]);

        if (Auth::guard('admin')->check()) {
            $id_instrutor = $request->fk_id_instrutor;
        } else {
            $id_instrutor = Auth::guard('instrutor')->user()->id_instrutor;
        }

        Atividade::create([
            'fk_id_instrutor' => $id_instrutor,
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'pontos' => $request->pontos,
            'turno' => $request->turno,
            'data_limite' => $request->data_limite,
        ]);

        return redirect('/atividades')->with('success', 'Atividade criada com sucesso!');
    }

    public function destroy($id)
    {
        $atividade = Atividade::findOrFail($id);
        $atividade->delete();
        return redirect('/atividades')->with('success', 'Atividade deletada com sucesso!');
    }

    public function entregas($id)
    {
        $atividade = Atividade::findOrFail($id);
        $entregas = Entrega::where('fk_id_atividade', $id)->with('aluno')->get();
        $alunos = Aluno::where('turno', $atividade->turno)->get();
        return view('atividades.entregas', compact('atividade', 'entregas', 'alunos'));
    }

    public function confirmar($id)
    {
        $entrega = Entrega::findOrFail($id);
        $entrega->update(['status' => 'confirmado']);
        $aluno = Aluno::findOrFail($entrega->fk_id_aluno);
        $aluno->update(['pontos' => $aluno->pontos + $entrega->atividade->pontos]);
        return back()->with('success', 'Entrega confirmada e pontos adicionados!');
    }

    public function marcarPresenca(Request $request, $id)
    {
        $entrega = Entrega::findOrFail($id);
        $aluno = Aluno::findOrFail($entrega->fk_id_aluno);

        if ($entrega->presenca) {
            $entrega->update(['presenca' => false]);
            $aluno->update([
                'frequencia' => max(0, $aluno->frequencia - 1),
                'pontos' => max(0, $aluno->pontos - 2),
            ]);
        } else {
            $entrega->update(['presenca' => true]);
            $aluno->update([
                'frequencia' => $aluno->frequencia + 1,
                'pontos' => $aluno->pontos + 2,
            ]);
        }
        return back()->with('success', 'Presença atualizada!');
    }

    public function entregar($id)
    {
        $aluno = Auth::guard('web')->user();
        $jaEntregou = Entrega::where('fk_id_atividade', $id)
            ->where('fk_id_aluno', $aluno->id_aluno)
            ->first();

        if ($jaEntregou) {
            return back()->with('error', 'Você já entregou esta atividade!');
        }

        Entrega::create([
            'fk_id_atividade' => $id,
            'fk_id_aluno' => $aluno->id_aluno,
            'status' => 'entregue',
            'presenca' => false,
        ]);

        return back()->with('success', 'Atividade marcada como entregue!');
    }
}