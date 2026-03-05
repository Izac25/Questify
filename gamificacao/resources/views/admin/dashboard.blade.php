@extends('layouts.dashboard')
@section('title', 'Admin Dashboard')
@section('content')

<div>
    <h2 style="font-family: 'Orbitron', sans-serif; color: #a855f7; font-size: 24px; margin-bottom: 30px;">Painel Admin</h2>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 16px; margin-bottom: 40px;">
        <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 12px; padding: 20px; text-align: center;">
            <div style="font-size: 28px; margin-bottom: 8px;">👨‍🏫</div>
            <div style="font-family: 'Orbitron', sans-serif; font-size: 11px; color: #a855f7; margin-bottom: 6px;">Instrutores</div>
            <div style="font-size: 28px; font-weight: bold;">{{ $totalInstrutores }}</div>
        </div>
        <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 12px; padding: 20px; text-align: center;">
            <div style="font-size: 28px; margin-bottom: 8px;">👨‍🎓</div>
            <div style="font-family: 'Orbitron', sans-serif; font-size: 11px; color: #a855f7; margin-bottom: 6px;">Alunos</div>
            <div style="font-size: 28px; font-weight: bold;">{{ $totalAlunos }}</div>
        </div>
        <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 12px; padding: 20px; text-align: center;">
            <div style="font-size: 28px; margin-bottom: 8px;">🏫</div>
            <div style="font-family: 'Orbitron', sans-serif; font-size: 11px; color: #a855f7; margin-bottom: 6px;">Turmas</div>
            <div style="font-size: 28px; font-weight: bold;">{{ $totalTurmas }}</div>
        </div>
    </div>

    <div style="display: flex; gap: 16px;">
        <a href="/admin/instrutores" style="text-decoration: none;">
            <button style="width: auto; padding: 12px 24px; margin-top: 0;">👨‍🏫 Gerenciar Instrutores</button>
        </a>
        <a href="/admin/alunos" style="text-decoration: none;">
            <button style="width: auto; padding: 12px 24px; margin-top: 0;">👨‍🎓 Gerenciar Alunos</button>
        </a>
    </div>
</div>

@endsection