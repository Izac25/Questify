@extends('layouts.dashboard')
@section('title', 'Alunos - Admin')
@section('content')

<div>
    <div style="margin-bottom: 30px;">
        <h2 style="font-family: 'Orbitron', sans-serif; color: #a855f7; font-size: 24px;">Gerenciar Alunos</h2>
    </div>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                <th style="padding: 12px; text-align: left; color: #a855f7; font-family: 'Orbitron', sans-serif; font-size: 13px;">Aluno</th>
                <th style="padding: 12px; text-align: left; color: #a855f7; font-family: 'Orbitron', sans-serif; font-size: 13px;">Email</th>
                <th style="padding: 12px; text-align: left; color: #a855f7; font-family: 'Orbitron', sans-serif; font-size: 13px;">Turma Atual</th>
                <th style="padding: 12px; text-align: left; color: #a855f7; font-family: 'Orbitron', sans-serif; font-size: 13px;">Mover para</th>
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
                        {{ $aluno->nome }}
                    </div>
                </td>
                <td style="padding: 12px; opacity: 0.7;">{{ $aluno->email }}</td>
                <td style="padding: 12px; opacity: 0.9;">
                    {{ $aluno->turma ? $aluno->turma->nome . ' - ' . $aluno->turma->sala : 'Sem turma' }}
                </td>
                <td style="padding: 12px;">
                    <form method="POST" action="/admin/alunos/{{ $aluno->id_aluno }}/mover" style="display: flex; gap: 8px; align-items: center;">
                        @csrf
                        @method('PUT')
                        <select name="fk_id_turma" style="padding: 6px 10px; font-size: 12px;">
                            <option value="" style="background: #1e1b4b;">Sem turma</option>
                            @foreach($turmas as $turma)
                                <option value="{{ $turma->id_turma }}" style="background: #1e1b4b;"
                                    {{ $aluno->fk_id_turma == $turma->id_turma ? 'selected' : '' }}>
                                    {{ $turma->nome }} - {{ $turma->sala }} ({{ $turma->turno }})
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" style="width: auto; padding: 6px 14px; margin-top: 0; font-size: 12px;">Mover</button>
                    </form>
                </td>
                <td style="padding: 12px;">
                    <form method="POST" action="/admin/alunos/{{ $aluno->id_aluno }}">
                        @csrf
                        @method('DELETE')
                        <button style="width: auto; padding: 8px 16px; margin-top: 0; background: linear-gradient(135deg, #dc2626, #b91c1c); font-size: 12px;">Deletar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 30px;">
        <a href="/admin/dashboard" style="color: rgba(255,255,255,0.5); text-decoration: none; font-size: 14px;">← Voltar</a>
    </div>
</div>

@endsection