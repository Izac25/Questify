@extends('layouts.dashboard')
@section('title', 'Turma')
@section('content')

<div>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h2 style="font-family: 'Orbitron', sans-serif; color: #a855f7; font-size: 24px;">{{ $turma->nome }}</h2>
            <p style="opacity: 0.6; margin-top: 6px;">Sala: {{ $turma->sala }} | Turno: {{ $turma->turno }}</p>
        </div>
        <div style="display: flex; gap: 10px;">
            <a href="/chamada/{{ $turma->id_turma }}" style="text-decoration: none;">
                <button style="width: auto; padding: 10px 20px; margin-top: 0; background: linear-gradient(135deg, #059669, #047857);">📋 Chamada</button>
            </a>
            <a href="/turmas/{{ $turma->id_turma }}/editar" style="text-decoration: none;">
                <button style="width: auto; padding: 10px 20px; margin-top: 0; background: linear-gradient(135deg, #1d4ed8, #1e40af);">✏️ Editar</button>
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="success-message">{{ session('success') }}</div>
    @endif

    @if($alunos->isEmpty())
    <div style="text-align: center; opacity: 0.5; margin-top: 40px;">
        <p style="font-size: 16px;">Nenhum aluno nesta turma ainda.</p>
    </div>
    @else
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                <th style="padding: 12px; text-align: left; color: #a855f7; font-family: 'Orbitron', sans-serif; font-size: 13px;">Aluno</th>
                <th style="padding: 12px; text-align: left; color: #a855f7; font-family: 'Orbitron', sans-serif; font-size: 13px;">Email</th>
                <th style="padding: 12px; text-align: left; color: #a855f7; font-family: 'Orbitron', sans-serif; font-size: 13px;">Pontos</th>
                <th style="padding: 12px; text-align: left; color: #a855f7; font-family: 'Orbitron', sans-serif; font-size: 13px;">Comportamento</th>
                <th style="padding: 12px; text-align: left; color: #a855f7; font-family: 'Orbitron', sans-serif; font-size: 13px;">Frequência</th>
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
                        </div>
                    </div>
                </td>
                <td style="padding: 12px; opacity: 0.7;">{{ $aluno->email }}</td>
                <td style="padding: 12px; font-family: 'Orbitron', sans-serif; color: #fbbf24;">{{ $aluno->pontos }}</td>
                <td style="padding: 12px; font-family: 'Orbitron', sans-serif;">
                    @if($aluno->pontos_comportamento < 0)
                        <span style="color: #f87171;">{{ $aluno->pontos_comportamento }}</span>
                        @else
                        <span style="color: #34d399;">{{ $aluno->pontos_comportamento }}</span>
                        @endif
                </td>
                <td style="padding: 12px; font-family: 'Orbitron', sans-serif; color: #a855f7;">{{ $aluno->frequencia }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <div style="margin-top: 30px;">
        <a href="/turmas" style="color: rgba(255,255,255,0.5); text-decoration: none; font-size: 14px;">← Voltar</a>
    </div>
</div>

@endsection