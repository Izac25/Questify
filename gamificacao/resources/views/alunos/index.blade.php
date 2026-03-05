@extends('layouts.dashboard')
@section('title', 'Alunos')
@section('content')

<div>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h2 style="font-family: 'Orbitron', sans-serif; color: #a855f7; font-size: 24px;">Alunos</h2>
        <div style="display: flex; gap: 8px;">
            @foreach($turnos as $turno)
                <span style="background: rgba(168,85,247,0.15); border: 1px solid rgba(168,85,247,0.3); border-radius: 20px; padding: 4px 12px; font-size: 12px; color: #a855f7;">{{ $turno }}</span>
            @endforeach
        </div>
    </div>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    {{-- Barra de pesquisa --}}
    <form method="GET" action="/alunos" style="margin-bottom: 24px;">
        <div style="display: flex; gap: 10px; align-items: center;">
            <input type="text" name="busca" placeholder="🔍 Pesquisar por nome ou email..." value="{{ $busca ?? '' }}" style="max-width: 400px;">
            <button type="submit" style="width: auto; padding: 12px 24px; margin-top: 0;">Buscar</button>
            @if($busca)
                <a href="/alunos" style="color: rgba(255,255,255,0.5); text-decoration: none; font-size: 13px;">✕ Limpar</a>
            @endif
        </div>
    </form>

    @if($alunos->isEmpty())
        <div style="text-align: center; opacity: 0.5; margin-top: 40px;">
            <p style="font-size: 16px;">
                {{ $busca ? 'Nenhum aluno encontrado para "' . $busca . '"' : 'Nenhum aluno nos seus turnos ainda.' }}
            </p>
            @if(!$busca)
                <p style="font-size: 13px; margin-top: 8px;">Configure seus turnos no <a href="/perfil/instrutor/editar" style="color: #a855f7;">perfil</a>.</p>
            @endif
        </div>
    @else
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                    <th style="padding: 12px; text-align: left; color: #a855f7; font-family: 'Orbitron', sans-serif; font-size: 13px;">Aluno</th>
                    <th style="padding: 12px; text-align: left; color: #a855f7; font-family: 'Orbitron', sans-serif; font-size: 13px;">Turma</th>
                    <th style="padding: 12px; text-align: left; color: #a855f7; font-family: 'Orbitron', sans-serif; font-size: 13px;">Turno</th>
                    <th style="padding: 12px; text-align: left; color: #a855f7; font-family: 'Orbitron', sans-serif; font-size: 13px;">Pontos</th>
                    <th style="padding: 12px; text-align: left; color: #a855f7; font-family: 'Orbitron', sans-serif; font-size: 13px;">Comportamento</th>
                    <th style="padding: 12px; text-align: left; color: #a855f7; font-family: 'Orbitron', sans-serif; font-size: 13px;">Ações</th>
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
                    <td style="padding: 12px; opacity: 0.9;">
                        {{ $aluno->turma ? $aluno->turma->nome . ' - ' . $aluno->turma->sala : 'Sem turma' }}
                    </td>
                    <td style="padding: 12px;">
                        <span style="background: rgba(168,85,247,0.15); border: 1px solid rgba(168,85,247,0.3); border-radius: 20px; padding: 4px 10px; font-size: 12px; color: #a855f7;">
                            {{ $aluno->turno ?? 'Sem turno' }}
                        </span>
                    </td>
                    <td style="padding: 12px; font-family: 'Orbitron', sans-serif; color: #fbbf24;">{{ $aluno->pontos }}</td>
                    <td style="padding: 12px; font-family: 'Orbitron', sans-serif; color: {{ $aluno->pontos_comportamento < 0 ? '#f87171' : '#34d399' }};">{{ $aluno->pontos_comportamento }}</td>
                    <td style="padding: 12px;">
                        <div style="display: flex; gap: 8px;">
                            <a href="/alunos/{{ $aluno->id_aluno }}/editar" style="text-decoration: none;">
                                <button style="width: auto; padding: 8px 16px; margin-top: 0; background: linear-gradient(135deg, #1d4ed8, #1e40af); font-size: 12px;">Editar</button>
                            </a>
                            <form method="POST" action="/alunos/{{ $aluno->id_aluno }}">
                                @csrf
                                @method('DELETE')
                                <button style="width: auto; padding: 8px 16px; margin-top: 0; background: linear-gradient(135deg, #dc2626, #b91c1c); font-size: 12px;">Deletar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div style="margin-top: 30px;">
        <a href="/dashboard" style="color: rgba(255,255,255,0.5); text-decoration: none; font-size: 14px;">← Voltar ao Dashboard</a>
    </div>
</div>

@endsection