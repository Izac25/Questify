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
    .card-value { font-size: 28px; font-weight: bold; }
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

    /* BADGES */
    .badges-section {
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 12px;
        padding: 20px;
    }
    .badges-section h3 {
        font-family: 'Orbitron', sans-serif;
        font-size: 13px;
        color: #a855f7;
        letter-spacing: 1px;
        margin-bottom: 16px;
    }
    .badges-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }
    .badge-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
        padding: 12px;
        border-radius: 10px;
        border: 1px solid rgba(255,255,255,0.1);
        background: rgba(255,255,255,0.04);
        width: 80px;
        cursor: default;
        transition: transform 0.2s;
        position: relative;
    }
    .badge-item:hover { transform: translateY(-3px); }
    .badge-item .badge-icone { font-size: 28px; }
    .badge-item .badge-nome {
        font-family: 'Orbitron', sans-serif;
        font-size: 9px;
        text-align: center;
        color: white;
        line-height: 1.2;
    }
    .badge-item .badge-tooltip {
        display: none;
        position: absolute;
        bottom: 110%;
        left: 50%;
        transform: translateX(-50%);
        background: #1e1b4b;
        border: 1px solid rgba(168,85,247,0.4);
        border-radius: 8px;
        padding: 8px 10px;
        font-size: 11px;
        color: white;
        width: 140px;
        text-align: center;
        z-index: 10;
        white-space: normal;
    }
    .badge-item:hover .badge-tooltip { display: block; }
    .badge-bloqueado {
        opacity: 0.25;
        filter: grayscale(1);
    }
    .badges-vazio {
        font-size: 13px;
        opacity: 0.4;
        text-align: center;
        padding: 10px 0;
    }
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
            @php
                $usuario = Auth::guard('web')->user();
                $meusBadges = \App\Models\AlunoBadge::where('fk_id_aluno', $usuario->id_aluno)
                    ->pluck('fk_id_badge')->toArray();
                $todosBadges = \App\Models\Badge::all();
            @endphp
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
                const rankingIds = ['ranking-turno', 'ranking-sala', 'ranking-comportamento'];
                let rankAtual = 0;
                setInterval(() => {
                    document.getElementById(rankingIds[rankAtual]).style.display = 'none';
                    rankAtual = (rankAtual + 1) % rankingIds.length;
                    document.getElementById(rankingIds[rankAtual]).style.display = 'block';
                }, 5000);
            </script>

            {{-- BADGES --}}
            <div class="badges-section">
                <h3>🏅 MEUS BADGES — {{ count($meusBadges) }}/{{ $todosBadges->count() }}</h3>
                @if($todosBadges->isEmpty())
                    <div class="badges-vazio">Nenhum badge disponível ainda.</div>
                @else
                <div class="badges-grid">
                    @foreach($todosBadges as $badge)
                    @php $conquistado = in_array($badge->id_badge, $meusBadges); @endphp
                    <div class="badge-item {{ $conquistado ? '' : 'badge-bloqueado' }}" style="border-color: {{ $conquistado ? $badge->cor : 'rgba(255,255,255,0.1)' }};">
                        <span class="badge-icone">{{ $badge->icone }}</span>
                        <span class="badge-nome" style="color: {{ $conquistado ? $badge->cor : 'white' }};">{{ $badge->nome }}</span>
                        <div class="badge-tooltip">
                            <strong>{{ $badge->nome }}</strong><br>
                            {{ $badge->descricao }}<br>
                            @if(!$conquistado)
                                <span style="color: #f87171; font-size: 10px;">🔒 Bloqueado</span>
                            @else
                                <span style="color: #34d399; font-size: 10px;">✅ Conquistado!</span>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
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

        {{-- Histórico de comportamento --}}
        @if(isset($meuHistorico) && $meuHistorico->isNotEmpty())
            <h3 style="font-family: 'Orbitron', sans-serif; color: #a855f7; font-size: 14px; letter-spacing: 1px; margin-top: 10px;">😊 COMPORTAMENTO</h3>
            @foreach($meuHistorico as $comp)
            <div style="background: rgba(255,255,255,0.04); border-radius: 10px; padding: 12px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
                    <span style="font-size: 12px; font-family: 'Orbitron', sans-serif;">{{ $comp->motivo }}</span>
                    @if($comp->pontos < 0)
                        <span style="font-size: 13px; color: #f87171; font-family: 'Orbitron', sans-serif;">{{ $comp->pontos }} pts</span>
                    @else
                        <span style="font-size: 13px; color: #34d399; font-family: 'Orbitron', sans-serif;">+{{ $comp->pontos }} pts</span>
                    @endif
                </div>
                @if($comp->motivo_livre)
                    <div style="font-size: 11px; opacity: 0.6;">{{ $comp->motivo_livre }}</div>
                @endif
                <div style="font-size: 11px; opacity: 0.4; margin-top: 4px;">{{ $comp->created_at ? \Carbon\Carbon::parse($comp->created_at)->format('d/m/Y') : '' }}</div>
            </div>
            @endforeach
        @endif
    </div>
    @endif

</div>

@endsection