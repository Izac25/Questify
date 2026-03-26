<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Atividade;
use App\Models\Entrega;
use App\Models\Aluno;
use App\Models\Turma;
use App\Models\Instrutor;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Notificar;
use App\Events\NotificacaoAluno; // Adicionado o import do Evento

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
        // Buscar o instrutor autenticado
        $instrutor = Auth::guard('instrutor')->user();
        
        if (!$instrutor) {
            return redirect('/login')->with('error', 'Você precisa estar autenticado');
        }

        // Pegar apenas as turmas do instrutor nos turnos permitidos
        $turnosPermitidos = $instrutor->turnos ?? [];
        $turmas = Turma::where('fk_id_instrutor', $instrutor->id_instrutor)
            ->whereIn('turno', $turnosPermitidos)
            ->get();

        return view('atividades.create', compact('turmas', 'turnosPermitidos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'pontos' => 'required|integer|min:0',
            'fk_id_turma' => 'required|integer|exists:turmas,id_turma',
            'data_limite' => 'nullable|date',
        ]);

        if (Auth::guard('admin')->check()) {
            $id_instrutor = $request->fk_id_instrutor;
        } else {
            $id_instrutor = Auth::guard('instrutor')->user()->id_instrutor;
        }

        // Buscar a turma selecionada
        $turma = Turma::findOrFail($request->fk_id_turma);

        // Verificar se a turma pertence ao instrutor
        if ($turma->fk_id_instrutor !== $id_instrutor) {
            return redirect('/atividades')->with('error', 'Você não tem permissão para criar atividades nesta turma!');
        }

        // Verificar se o instrutor tem permissão para este turno
        $instrutor = Instrutor::find($id_instrutor);
        $turnosPermitidos = $instrutor->turnos ?? [];

        if (!in_array($turma->turno, $turnosPermitidos)) {
            return redirect('/atividades')->with('error', 'Você não tem permissão para criar atividades no turno: ' . $turma->turno);
        }

        // Criar a atividade
        $atividade = Atividade::create([
            'fk_id_instrutor' => $id_instrutor,
            'fk_id_turma' => $request->fk_id_turma,
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'pontos' => $request->pontos,
            'turno' => $turma->turno,
            'data_limite' => $request->data_limite,
        ]);

        // Log
        $usuario = Auth::guard('admin')->user() ?? Auth::guard('instrutor')->user();
        activity()
            ->causedBy($usuario)
            ->log('Instrutor "' . $usuario->nome . '" criou a atividade "' . $atividade->titulo . '" — ' . $atividade->pontos . ' pts — Turma: ' . $turma->nome);

        // Notifica todos os alunos da turma selecionada
        $alunos = Aluno::where('fk_id_turma', $request->fk_id_turma)->get();
        foreach ($alunos as $aluno) {
            $msg = 'Nova atividade disponível: "' . $atividade->titulo . '" — ' . $atividade->pontos . ' pts';
            
            // Mantém sua notificação atual no site
            Notificar::aluno(
                $aluno->id_aluno,
                $msg,
                'purple',
                '📚',
                0
            );

            // DISPARA O E-MAIL (via Evento que configuramos)
            event(new NotificacaoAluno($aluno->id_aluno, $msg, 'purple', '📚', $atividade->pontos));
        }

        return redirect('/atividades')->with('success', 'Atividade criada com sucesso!');
    }

    public function destroy($id)
    {
        $atividade = Atividade::findOrFail($id);

        // Log
        $usuario = Auth::guard('admin')->user() ?? Auth::guard('instrutor')->user();
        activity()
            ->causedBy($usuario)
            ->log('Atividade "' . $atividade->titulo . '" foi deletada por "' . $usuario->nome . '"');

        $atividade->delete();
        return redirect('/atividades')->with('success', 'Atividade deletada com sucesso!');
    }

    public function entregas($id)
    {
        $atividade = Atividade::findOrFail($id);
        $entregas = Entrega::where('fk_id_atividade', $id)->with('aluno')->get();
        $alunos = Aluno::where('fk_id_turma', $atividade->fk_id_turma)->get();
        return view('atividades.entregas', compact('atividade', 'entregas', 'alunos'));
    }

    public function confirmar($id)
    {
        $entrega = Entrega::findOrFail($id);
        $entrega->update(['status' => 'confirmado']);
        $aluno = Aluno::findOrFail($entrega->fk_id_aluno);
        $pontos = $entrega->atividade->pontos;
        $aluno->update(['pontos' => $aluno->pontos + $pontos]);

        // Log
        $usuario = Auth::guard('admin')->user() ?? Auth::guard('instrutor')->user();
        activity()
            ->causedBy($usuario)
            ->log('Entrega de "' . $aluno->nome . '" na atividade "' . $entrega->atividade->titulo . '" confirmada — +' . $pontos . ' pts');

        $msgConfirmacao = 'Sua entrega de "' . $entrega->atividade->titulo . '" foi confirmada! +' . $pontos . ' pts';

        // Notifica o aluno no site
        Notificar::aluno(
            $aluno->id_aluno,
            $msgConfirmacao,
            'green',
            '✅',
            $pontos
        );

        // DISPARA O E-MAIL de confirmação
        event(new NotificacaoAluno($aluno->id_aluno, $msgConfirmacao, 'green', '✅', $pontos));

        // Verifica badges - recarrega os dados do aluno
        $alunoAtualizado = Aluno::findOrFail($aluno->id_aluno);
        Notificar::verificarBadges($alunoAtualizado);

        return back()->with('success', 'Entrega confirmada e pontos adicionados!');
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

        // Log
        activity()
            ->causedBy($aluno)
            ->log('Aluno "' . $aluno->nome . '" entregou a atividade "' . Atividade::findOrFail($id)->titulo . '"');

        // Verifica badges por atividades entregues - recarrega os dados do aluno
        $alunoAtualizado = Aluno::findOrFail($aluno->id_aluno);
        Notificar::verificarBadges($alunoAtualizado);

        // Notifica o instrutor
        $atividade = Atividade::findOrFail($id);
        Notificar::instrutor(
            $atividade->fk_id_instrutor,
            'O aluno "' . $aluno->nome . '" entregou a atividade "' . $atividade->titulo . '"',
            'blue',
            '📝'
        );

        return back()->with('success', 'Atividade marcada como entregue!');
    }
}