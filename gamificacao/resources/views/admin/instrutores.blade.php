@extends('layouts.dashboard')
@section('title', 'Instrutores')
@section('content')

<div>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h2 style="font-family: 'Orbitron', sans-serif; color: #a855f7; font-size: 24px;">Instrutores</h2>
    </div>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    {{-- Formulário criar instrutor --}}
    <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 12px; padding: 24px; margin-bottom: 30px;">
        <h3 style="font-family: 'Orbitron', sans-serif; color: #a855f7; font-size: 14px; margin-bottom: 20px;">+ Novo Instrutor</h3>
        
        @if ($errors->any())
            <div style="background: rgba(220,38,38,0.15); border: 1px solid rgba(220,38,38,0.4); color: #fca5a5; padding: 10px; border-radius: 6px; margin-bottom: 20px;">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="/admin/instrutores" style="display: flex; gap: 12px; align-items: flex-end; flex-wrap: wrap;">
            @csrf
            <div style="flex: 1; min-width: 150px;">
                <input type="text" name="nome" placeholder="Nome" required>
            </div>
            <div style="flex: 1; min-width: 150px;">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div style="flex: 1; min-width: 150px;">
                <input type="password" name="senha" placeholder="Senha" required>
            </div>
            <button type="submit" style="width: auto; padding: 12px 24px; margin-top: 0;">Criar</button>
        </form>
    </div>

    {{-- Lista de instrutores --}}
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                <th style="padding: 12px; text-align: left; color: #a855f7; font-family: 'Orbitron', sans-serif; font-size: 13px;">Nome</th>
                <th style="padding: 12px; text-align: left; color: #a855f7; font-family: 'Orbitron', sans-serif; font-size: 13px;">Email</th>
                <th style="padding: 12px; text-align: left; color: #a855f7; font-family: 'Orbitron', sans-serif; font-size: 13px;">Turmas</th>
                <th style="padding: 12px; text-align: left; color: #a855f7; font-family: 'Orbitron', sans-serif; font-size: 13px;">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($instrutores as $instrutor)
            <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                <td style="padding: 12px; opacity: 0.9;">{{ $instrutor->nome }}</td>
                <td style="padding: 12px; opacity: 0.9;">{{ $instrutor->email }}</td>
                <td style="padding: 12px; opacity: 0.9;">{{ $instrutor->turmas->count() }}</td>
                <td style="padding: 12px;">
                    <form method="POST" action="/admin/instrutores/{{ $instrutor->id_instrutor }}">
                        @csrf
                        @method('DELETE')
                        <button style="width: auto; padding: 8px 16px; margin-top: 0; background: linear-gradient(135deg, #dc2626, #b91c1c);">Deletar</button>
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