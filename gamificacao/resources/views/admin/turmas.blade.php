@extends('layouts.dashboard')
@section('title', 'Turmas - Admin')
@section('content')

<div>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h2 style="font-family: 'Orbitron', sans-serif; color: #a855f7; font-size: 24px;">Turmas</h2>
    </div>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    {{-- Formulário criar turma --}}
    <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 12px; padding: 24px; margin-bottom: 30px;">
        <h3 style="font-family: 'Orbitron', sans-serif; color: #a855f7; font-size: 14px; margin-bottom: 20px;">+ Nova Turma</h3>

        @if ($errors->any())
            <div style="background: rgba(220,38,38,0.15); border: 1px solid rgba(220,38,38,0.4); color: #fca5a5; padding: 10px; border-radius: 6px; margin-bottom: 20px;">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="/admin/turmas" style="display: flex; gap: 12px; align-items: flex-end; flex-wrap: wrap;">
            @csrf
            <div style="flex: 1; min-width: 130px;">
                <input type="text" name="nome" placeholder="Nome da turma" required>
            </div>
            <div style="flex: 1; min-width: 100px;">
                <input type="text" name="sala" placeholder="Sala" required>
            </div>
            <div style="flex: 1; min-width: 120px;">
                <select name="turno" required style="padding: 12px;">
                    <option value="" style="background: #1e1b4b;">Turno</option>
                    <option value="Manhã" style="background: #1e1b4b;">Manhã</option>
                    <option value="Tarde" style="background: #1e1b4b;">Tarde</option>
                    <option value="Noite" style="background: #1e1b4b;">Noite</option>
                </select>
            </div>
            <div style="flex: 1; min-width: 150px;">
                <select name="fk_id_instrutor" required style="padding: 12px;">
                    <option value="" style="background: #1e1b4b;">Instrutor</option>
                    @foreach($instrutores as $instrutor)
                        <option value="{{ $instrutor->id_instrutor }}" style="background: #1e1b4b;">{{ $instrutor->nome }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" style="width: auto; padding: 12px 24px; margin-top: 0;">Criar</button>
        </form>
    </div>

    {{-- Lista de turmas --}}
    @if($turmas->isEmpty())
        <p style="opacity: 0.5; text-align: center; margin-top: 40px;">Nenhuma turma cadastrada ainda.</p>
    @else
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                    <th style="padding: 12px; text-align: left; color: #a855f7; font-family: 'Orbitron', sans-serif; font-size: 13px;">Nome</th>
                    <th style="padding: 12px; text-align: left; color: #a855f7; font-family: 'Orbitron', sans-serif; font-size: 13px;">Sala</th>
                    <th style="padding: 12px; text-align: left; color: #a855f7; font-family: 'Orbitron', sans-serif; font-size: 13px;">Turno</th>
                    <th style="padding: 12px; text-align: left; color: #a855f7; font-family: 'Orbitron', sans-serif; font-size: 13px;">Instrutor</th>
                    <th style="padding: 12px; text-align: left; color: #a855f7; font-family: 'Orbitron', sans-serif; font-size: 13px;">Alunos</th>
                    <th style="padding: 12px; text-align: left; color: #a855f7; font-family: 'Orbitron', sans-serif; font-size: 13px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($turmas as $turma)
                <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                    <td style="padding: 12px; opacity: 0.9;">{{ $turma->nome }}</td>
                    <td style="padding: 12px; opacity: 0.9;">{{ $turma->sala }}</td>
                    <td style="padding: 12px;">
                        <span style="background: rgba(168,85,247,0.15); border: 1px solid rgba(168,85,247,0.3); border-radius: 20px; padding: 4px 10px; font-size: 12px; color: #a855f7;">{{ $turma->turno }}</span>
                    </td>
                    <td style="padding: 12px; opacity: 0.9;">{{ $turma->instrutor->nome ?? 'Sem instrutor' }}</td>
                    <td style="padding: 12px; opacity: 0.9;">{{ $turma->alunos->count() }}</td>
                    <td style="padding: 12px;">
                        <div style="display: flex; gap: 8px;">
                            <a href="/admin/turmas/{{ $turma->id_turma }}/editar" style="text-decoration: none;">
                                <button style="width: auto; padding: 8px 16px; margin-top: 0; background: linear-gradient(135deg, #1d4ed8, #1e40af); font-size: 12px;">Editar</button>
                            </a>
                            <form method="POST" action="/admin/turmas/{{ $turma->id_turma }}">
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
        <a href="/admin/dashboard" style="color: rgba(255,255,255,0.5); text-decoration: none; font-size: 14px;">← Voltar</a>
    </div>
</div>

@endsection