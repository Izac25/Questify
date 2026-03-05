@extends('layouts.dashboard')
@section('title', 'Editar Perfil')
@section('content')

<div class="container" style="flex-direction: column; padding: 50px 45px; min-height: 480px; width: 900px;">

    <div style="margin-bottom: 30px;">
        <h2 style="font-family: 'Orbitron', sans-serif; color: #a855f7; letter-spacing: 2px; font-size: 24px;">Editar Perfil</h2>
    </div>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div style="background: rgba(220,38,38,0.15); border: 1px solid rgba(220,38,38,0.4); color: #fca5a5; padding: 10px; border-radius: 6px; margin-bottom: 20px;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div style="display: flex; gap: 40px; align-items: flex-start;">

        {{-- Avatar atual --}}
        <div style="display: flex; flex-direction: column; align-items: center; gap: 12px;">
            @if($aluno->foto)
                <img src="{{ asset('storage/' . $aluno->foto) }}" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 3px solid #a855f7; box-shadow: 0 0 20px rgba(168,85,247,0.5);">
            @else
                <div style="width: 100px; height: 100px; border-radius: 50%; background: linear-gradient(135deg, #6d28d9, #9333ea); display: flex; align-items: center; justify-content: center; font-family: 'Orbitron', sans-serif; font-size: 32px; border: 3px solid #a855f7;">
                    {{ strtoupper(substr($aluno->nome, 0, 1)) }}
                </div>
            @endif
            <span style="font-size: 13px; opacity: 0.5;">Foto atual</span>
        </div>

        {{-- Formulário --}}
        <form method="POST" action="/perfil" enctype="multipart/form-data" style="flex: 1;">
            @csrf
            @method('PUT')

            <div class="input-group">
                <input type="text" name="nome" placeholder="Nome" value="{{ $aluno->nome }}" required>
            </div>

            <div class="input-group">
                <input type="file" name="foto" accept="image/*" style="width: 100%; padding: 12px; border-radius: 6px; border: 1px solid rgba(255,255,255,0.15); background: rgba(255,255,255,0.05); color: white; outline: none;">
                <small class="password-info">Nova foto de perfil (opcional)</small>
            </div>

            <div class="input-group">
                <input type="password" name="senha" placeholder="Nova senha (deixe em branco para manter)">
            </div>

            <div class="input-group">
                <input type="password" name="senha_confirmation" placeholder="Confirmar nova senha">
            </div>

            <button type="submit">SALVAR ALTERAÇÕES</button>

            <div style="margin-top: 20px;">
                <a href="/dashboard" style="color: rgba(255,255,255,0.5); text-decoration: none; font-size: 14px;">← Voltar ao Dashboard</a>
            </div>
        </form>

    </div>
</div>

@endsection