@extends('layouts.dashboard')
@section('title', 'Chamada')
@section('content')

<div>
    <div style="margin-bottom: 30px;">
        <h2 style="font-family: 'Orbitron', sans-serif; color: #a855f7; font-size: 24px;">
            Chamada — {{ $turma->nome }} ({{ $turma->sala }})
        </h2>
        <p style="opacity: 0.6; margin-top: 8px;">Turno: {{ $turma->turno }}</p>
    </div>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    {{-- Seletor de data --}}
    <form method="GET" action="/chamada/{{ $turma->id_turma }}" style="margin-bottom: 24px; display: flex; gap: 10px; align-items: center;">
        <input type="date" name="data" value="{{ $data }}" style="max-width: 200px;">
        <button type="submit" style="width: auto; padding: 12px 24px; margin-top: 0;">Ver Chamada</button>
    </form>

    {{-- Formulário de chamada --}}
    <form method="POST" action="/chamada/{{ $turma->id_turma }}">
        @csrf
        <input type="hidden" name="data" value="{{ $data }}">

        <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 12px; padding: 24px; margin-bottom: 30px;">
            <h3 style="font-family: 'Orbitron', sans-serif; color: #a855f7; font-size: 13px; margin-bottom: 20px;">
                📅 {{ \Carbon\Carbon::parse($data)->format('d/m/Y') }}
            </h3>

            @if($alunos->isEmpty())
                <p style="opacity: 0.5;">Nenhum aluno nesta turma.</p>
            @else
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                            <th style="padding: 12px; text-align: left; color: #a855f7; font-family: 'Orbitron', sans-serif; font-size: 13px;">Aluno</th>
                            <th style="padding: 12px; text-align: center; color: #a855f7; font-family: 'Orbitron', sans-serif; font-size: 13px;">Presente</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alunos as $aluno)
                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                            <td style="padding: 12px;">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    @if($aluno->foto)
                                        <img src="{{ asset('storage/' . $aluno->foto) }}" style="width: 36px; height: 36px; border-radius: 50%; object-fit: cover; border: 2px solid #a855f7;">
                                    @else
                                        <div style="width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #6d28d9, #9333ea); display: flex; align-items: center; justify-content: center; font-size: 14px; font-family: 'Orbitron', sans-serif;">
                                            {{ strtoupper(substr($aluno->nome, 0, 1)) }}
                                        </div>
                                    @endif
                                    <div>
                                        <div style="font-size: 14px;">{{ $aluno->nome }}</div>
                                        <div style="font-size: 12px; opacity: 0.5;">{{ $aluno->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="padding: 12px; text-align: center;">
                                <label style="display: inline-flex; align-items: center; gap: 8px; cursor: pointer; background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 8px; padding: 10px 18px;">
                                    <input type="checkbox" name="presentes[]" value="{{ $aluno->id_aluno }}"
                                        style="width: auto; padding: 0; accent-color: #a855f7;"
                                        {{ isset($chamadas[$aluno->id_aluno]) && $chamadas[$aluno->id_aluno] ? 'checked' : '' }}>
                                    <span style="font-size: 13px;">{{ isset($chamadas[$aluno->id_aluno]) && $chamadas[$aluno->id_aluno] ? '✅ Presente' : '❌ Ausente' }}</span>
                                </label>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" style="max-width: 300px; margin-top: 20px;">SALVAR CHAMADA</button>
            @endif
        </div>
    </form>

    {{-- Histórico --}}
    @if($historico->isNotEmpty())
        <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 12px; padding: 24px;">
            <h3 style="font-family: 'Orbitron', sans-serif; color: #a855f7; font-size: 13px; margin-bottom: 20px;">📋 HISTÓRICO DE CHAMADAS</h3>

            @foreach($historico as $dia => $registros)
            <div style="margin-bottom: 20px;">
                <div style="font-family: 'Orbitron', sans-serif; font-size: 12px; color: #a855f7; margin-bottom: 10px; opacity: 0.8;">{{ $dia }}</div>
                <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                    @foreach($registros as $chamada)
                        @if($chamada->presente)
                            <div style="background: rgba(52,211,153,0.15); border: 1px solid rgba(52,211,153,0.3); border-radius: 8px; padding: 6px 12px; font-size: 12px; color: #34d399;">
                                {{ $chamada->aluno->nome ?? 'Aluno' }} ✅
                            </div>
                        @else
                            <div style="background: rgba(248,113,113,0.15); border: 1px solid rgba(248,113,113,0.3); border-radius: 8px; padding: 6px 12px; font-size: 12px; color: #f87171;">
                                {{ $chamada->aluno->nome ?? 'Aluno' }} ❌
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    @endif

    <div style="margin-top: 30px;">
        <a href="/turmas" style="color: rgba(255,255,255,0.5); text-decoration: none; font-size: 14px;">← Voltar</a>
    </div>
</div>

@endsection