<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Turma;

class VerificaTurnoTurma
{
    public function handle(Request $request, Closure $next)
    {
        // Pega o ID da turma da URL
        // Ajuste conforme sua rota (pode ser 'id_turma' ou 'turma' ou outro)
        $turmaId = $request->route('id_turma');
        
        // Pega o instrutor autenticado
        $instrutor = auth('instrutor')->user();

        if (!$instrutor) {
            return response()->json(['erro' => 'Instrutor não autenticado'], 401);
        }

        // Busca a turma
        $turma = Turma::find($turmaId);

        if (!$turma) {
            return response()->json(['erro' => 'Turma não encontrada'], 404);
        }

        // Verifica se é o instrutor dono da turma
        if ($turma->fk_id_instrutor !== $instrutor->id_instrutor) {
            return response()->json(['erro' => 'Você não é o instrutor desta turma'], 403);
        }

        // Verifica se o turno está permitido
        $turnosPermitidos = $instrutor->turnos ?? [];
        
        if (!in_array($turma->turno, $turnosPermitidos)) {
            return response()->json([
                'erro' => 'Acesso negado',
                'motivo' => 'Seu perfil não permite acesso ao turno: ' . $turma->turno,
                'turnos_permitidos' => $turnosPermitidos,
                'turno_da_turma' => $turma->turno
            ], 403);
        }

        return $next($request);
    }
}