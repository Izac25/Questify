@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('styles')
<style>
    .main-content {
        display: flex;
        flex-direction: column;
        gap: 20px;
        flex: 1;
    }
    .cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 16px;
    }
    .card {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 12px;
        padding: 20px;
        text-align: center;
    }
    .card-icon { font-size: 28px; margin-bottom: 8px; }
    .card-title {
        font-family: 'Orbitron', sans-serif;
        font-size: 11px;
        color: #a855f7;
        letter-spacing: 1px;
        margin-bottom: 6px;
    }
    .card-value { font-size: 28px; font-weight: bold; color: white; }
    .ranking-box {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 12px;
        padding: 20px;
    }
    .ranking-box h3 {
        font-family: 'Orbitron', sans-serif;
        font-size: 13px;
        color: #a855f7;
        letter-spacing: 1px;
        margin-bottom: 16px;
    }
    .ranking-table { width: 100%; border-collapse: collapse; }
    .ranking-table td {
        padding: 8px 10px;
        font-size: 14px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }
    .ranking-table tr:first-child td { color: #fbbf24; }
    .ranking-table tr:nth-child(2) td { color: #d1d5db; }
    .ranking-table tr:nth-child(3) td { color: #b45309; }
    .rank-badge { font-family: 'Orbitron', sans-serif; font-size: 12px; opacity: 0.5; }
    .atividades-col {
        width: 280px;
        display: flex;
        flex-direction: column;
        gap: 16px;
        flex-shrink: 0;
    }
    .atividade-card {
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 12px;
        padding: 16px;
    }
    .atividade-titulo { font-family: 'Orbitron', sans-serif; font-size: 12px; color: white; margin-bottom: 6px; }
    .atividade-desc { font-size: 12px; opacity: 0.6; margin-bottom: 8px; }
    .atividade-pts { font-size: 12px; color: #a855f7; margin-bottom: 4px; }
    .atividade-data { font-size: 11px; opacity: 0.5; margin-bottom: 12px; }
</style>
@endsection
@section('content')

<div style="display: flex; gap: 30px; width: 100%;">

    {{-- MAIN --}}
    <div class="main-content">
        @if(Auth::guard('instrutor')->check())
            @php $usuario = Auth::guard('instrutor')->user(); @endphp
            <h2 style="font-family: 'Orbitron', sans-serif; color: #a855f7; font-size: 20px;">Painel do Instrutor</h2>
            <div class="cards-grid">
                <div class="card">
                    <div class="card-icon">🏫</div>
                    <div class="card-title">Turmas</div>
                    <div class="card-value">{{ \App\Models\Turma::where('fk_id_instrutor', $usuario->id_instrutor)->count() }}</div>
                </div>
                <div class="card">
                    <div class="card-icon">👨‍🎓</div>
                    <div class="card-title">Alunos</div>
                    <div class="card-value">{{ \App\Models\Aluno::count() }}</div>
                </div>
                <div class="card">
                    <div class="card-icon">📚</div>
                    <div class="card-title">Atividades</div>
                    <div class="card-value">{{ \App\Models\Atividade::where('fk_id_instrutor', $usuario->id_instrutor)->count() }}</div>
                </div>
            </div>
        @else
            @php $usuario = Auth::guard('web')->user(); @endphp
            <h2 style="font-family: 'Orbitron', sans-serif; color: #a855f7; font-size: 20px;">Meu Painel</h2>

            {{-- RANKINGS ROTATIVOS --}}
            <div id="ranking-turno" class="ranking-box">
                <h3>🏆 RANK GERAL DO TURNO — {{ strtoupper($usuario->turno ?? '') }}</h3>
                <table class="ranking-table">
                    @foreach($rankTurno ?? [] as $i => $a)
                    <tr @if($a->id_aluno == $usuario->id_aluno) style="background: rgba(168,85,247,0.15);" @endif>
                        <td class="rank-badge">#{{ $i + 1 }}</td>
                        <td>{{ $a->nome }} @if($a->id_aluno == $usuario->id_aluno) <span style="color: #a855f7;">(você)</span> @endif</td>
                        <td style="text-align: right; opacity: 0.7;">{{ $a->pontos }} pts</td>
                    </tr>
                    @endforeach
                </table>
            </div>

            <div id="ranking-sala" class="ranking-box" style="display: none;">
                <h3>🏫 RANK DA SALA — {{ strtoupper($usuario->turma->nome ?? '') }}</h3>
                <table class="ranking-table">
                    @foreach($rankSala ?? [] as $i => $a)
                    <tr @if($a->id_aluno == $usuario->id_aluno) style="background: rgba(168,85,247,0.15);" @endif>
                        <td class="rank-badge">#{{ $i + 1 }}</td>
                        <td>{{ $a->nome }} @if($a->id_aluno == $usuario->id_aluno) <span style="color: #a855f7;">(você)</span> @endif</td>
                        <td style="text-align: right; opacity: 0.7;">{{ $a->pontos }} pts</td>
                    </tr>
                    @endforeach
                </table>
            </div>

            <div id="ranking-comportamento" class="ranking-box" style="display: none;">
                <h3>😊 RANK COMPORTAMENTO — {{ strtoupper($usuario->turma->nome ?? '') }}</h3>
                <table class="ranking-table">
                    @foreach($rankComportamento ?? [] as $i => $a)
                    <tr @if($a->id_aluno == $usuario->id_aluno) style="background: rgba(168,85,247,0.15);" @endif>
                        <td class="rank-badge">#{{ $i + 1 }}</td>
                        <td>{{ $a->nome }} @if($a->id_aluno == $usuario->id_aluno) <span style="color: #a855f7;">(você)</span> @endif</td>
                        <td style="text-align: right; opacity: 0.7;">{{ $a->pontos_comportamento }} pts</td>
                    </tr>
                    @endforeach
                </table>
            </div>

            <script>
                const rankings = ['ranking-turno', 'ranking-sala', 'ranking-comportamento'];
                let atual = 0;
                setInterval(() => {
                    document.getElementById(rankings[atual]).style.display = 'none';
                    atual = (atual + 1) % rankings.length;
                    document.getElementById(rankings[atual]).style.display = 'block';
                }, 5000);
            </script>
        @endif
    </div>

    {{-- ATIVIDADES (só aluno) --}}
    @if(Auth::guard('web')->check())
    <div class="atividades-col">
        <h3 style="font-family: 'Orbitron', sans-serif; color: #a855f7; font-size: 14px; letter-spacing: 1px;">📚 ATIVIDADES</h3>
        @if(isset($atividades) && $atividades->isEmpty())
            <p style="opacity: 0.5; font-size: 13px;">Nenhuma atividade no momento.</p>
        @else
            @foreach($atividades ?? [] as $atividade)
            <div class="atividade-card">
                <div class="atividade-titulo">{{ $atividade->titulo }}</div>
                @if($atividade->descricao)
                    <div class="atividade-desc">{{ $atividade->descricao }}</div>
                @endif
                <div class="atividade-pts">⭐ {{ $atividade->pontos }} pts</div>
                <div class="atividade-data">📅 {{ $atividade->data_limite ?? 'Sem limite' }}</div>
                @if(in_array($atividade->id_atividade, $minhasEntregas ?? []))
                    <div style="text-align: center; padding: 8px; background: rgba(52,211,153,0.15); border-radius: 6px; color: #34d399; font-size: 12px;">
                        ✅ Entregue
                    </div>
                @else
                    <form method="POST" action="/atividades/{{ $atividade->id_atividade }}/entregar">
                        @csrf
                        <button style="width: 100%; padding: 8px; margin-top: 0; font-size: 12px;">Marcar como Entregue</button>
                    </form>
                @endif
            </div>
            @endforeach
        @endif
    </div>
    @endif

</div>

@endsection