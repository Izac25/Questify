@extends('layouts.dashboard')
@section('title', 'Editar Perfil')
@section('content')

<div>
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

    <form method="POST" action="/perfil/instrutor" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div style="display: flex; gap: 40px; align-items: flex-start; margin-bottom: 30px;">

            {{-- Avatar atual --}}
            <div style="display: flex; flex-direction: column; align-items: center; gap: 12px;">
                @if($instrutor->foto)
                    <img src="{{ asset('storage/' . $instrutor->foto) }}" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 3px solid #a855f7; box-shadow: 0 0 20px rgba(168,85,247,0.5);">
                @else
                    <div style="width: 100px; height: 100px; border-radius: 50%; background: linear-gradient(135deg, #6d28d9, #9333ea); display: flex; align-items: center; justify-content: center; font-family: 'Orbitron', sans-serif; font-size: 32px; border: 3px solid #a855f7;">
                        {{ strtoupper(substr($instrutor->nome, 0, 1)) }}
                    </div>
                @endif
                <span style="font-size: 13px; opacity: 0.5;">Foto atual</span>
            </div>

            {{-- Campos --}}
            <div style="flex: 1; display: flex; flex-direction: column; gap: 16px;">
                <div class="input-group">
                    <input type="text" name="nome" placeholder="Nome" value="{{ $instrutor->nome }}" required>
                </div>

                <div class="input-group">
                    <input type="file" name="foto" accept="image/*">
                    <small class="password-info">Nova foto de perfil (opcional)</small>
                </div>

                <div class="input-group">
                    <input type="password" name="senha" placeholder="Nova senha (deixe em branco para manter)">
                </div>

                <div class="input-group">
                    <input type="password" name="senha_confirmation" placeholder="Confirmar nova senha">
                </div>

                {{-- Turnos --}}
                <div class="input-group">
                    <label style="font-family: 'Orbitron', sans-serif; font-size: 12px; color: #a855f7; display: block; margin-bottom: 12px;">TURNOS QUE LECIONA</label>
                    <div style="display: flex; gap: 16px; flex-wrap: wrap;">
                        @foreach(['Manhã', 'Tarde', 'Noite'] as $turno)
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 8px; padding: 10px 18px;">
                            <input type="checkbox" name="turnos[]" value="{{ $turno }}"
                                style="width: auto; padding: 0; accent-color: #a855f7;"
                                {{ is_array($instrutor->turnos) && in_array($turno, $instrutor->turnos) ? 'checked' : '' }}>
                            <span style="font-size: 14px;">{{ $turno }}</span>
                        </label>
                        @endforeach
                    </div>
                    <small class="password-info">Selecione pelo menos um turno</small>
                </div>
            </div>
        </div>

        <button type="submit" style="max-width: 300px;">SALVAR ALTERAÇÕES</button>

        <div style="margin-top: 20px;">
            <a href="/dashboard" style="color: rgba(255,255,255,0.5); text-decoration: none; font-size: 14px;">← Voltar ao Dashboard</a>
        </div>
    </form>
</div>

@endsection