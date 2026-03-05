@extends('layouts.dashboard')
@section('title', 'Turmas')
@section('content')
<div class="container" style="flex-direction: column; padding: 50px 45px; min-height: 480px; width: 900px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h2 style="font-family: 'Orbitron', sans-serif; color: #a855f7; letter-spacing: 2px; font-size: 24px;">Minhas Turmas</h2>
        <a href="/turmas/criar" style="text-decoration: none;">
            <button style="width: auto; padding: 10px 20px; margin-top: 0;">+ Nova Turma</button>
        </a>
    </div>
    @if(session('success'))
    <div class="success-message">{{ session('success') }}</div>
    @endif
    @if($turmas->isEmpty())
    <p style="opacity: 0.6; text-align: center; margin-top: 40px;">Nenhuma turma cadastrada ainda.</p>
    @else
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                <th style="padding: 12px; text-align: left; color: #a855f7; font-family: 'Orbitron', sans-serif; font-size: 13px;">Nome</th>
                <th style="padding: 12px; text-align: left; color: #a855f7; font-family: 'Orbitron', sans-serif; font-size: 13px;">Sala</th>
                <th style="padding: 12px; text-align: left; color: #a855f7; font-family: 'Orbitron', sans-serif; font-size: 13px;">Turno</th>
                <th style="padding: 12px; text-align: left; color: #a855f7; font-family: 'Orbitron', sans-serif; font-size: 13px;">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($turmas as $turma)
            <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                <td style="padding: 12px; opacity: 0.9;">{{ $turma->nome }}</td>
                <td style="padding: 12px; opacity: 0.9;">{{ $turma->sala }}</td>
                <td style="padding: 12px; opacity: 0.9;">{{ $turma->turno }}</td>
                <td style="padding: 12px;">
                    <div style="display: flex; gap: 8px;">
                        <a href="/turmas/{{ $turma->id_turma }}/editar" style="text-decoration: none;">
                            <button style="width: auto; padding: 8px 16px; margin-top: 0; background: linear-gradient(135deg, #1d4ed8, #1e40af);">Editar</button>
                        </a>
                        <form method="POST" action="/turmas/{{ $turma->id_turma }}">
                            @csrf
                            @method('DELETE')
                            <button style="width: auto; padding: 8px 16px; margin-top: 0; background: linear-gradient(135deg, #dc2626, #b91c1c);">Deletar</button>
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