@extends('layouts.dashboard')
@section('title', 'Editar Turma')
@section('content')

<div class="container" style="flex-direction: column; padding: 50px 45px; min-height: 480px; width: 900px;">

    <div style="margin-bottom: 30px;">
        <h2 style="font-family: 'Orbitron', sans-serif; color: #a855f7; letter-spacing: 2px; font-size: 24px;">Editar Turma</h2>
    </div>

    @if ($errors->any())
        <div style="background: rgba(220,38,38,0.15); border: 1px solid rgba(220,38,38,0.4); color: #fca5a5; padding: 10px; border-radius: 6px; margin-bottom: 20px;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="/turmas/{{ $turma->id_turma }}" style="max-width: 500px;">
        @csrf
        @method('PUT')
        <div class="input-group">
            <input
                type="text"
                name="nome"
                placeholder="Nome da Turma"
                value="{{ $turma->nome }}"
                required
            >
        </div>
        <div class="input-group">
            <input
                type="text"
                name="sala"
                placeholder="Sala"
                value="{{ $turma->sala }}"
                required
            >
        </div>
        <div class="input-group">
            <select name="turno" required style="width: 100%; padding: 12px; border-radius: 6px; border: 1px solid rgba(255,255,255,0.15); background: rgba(255,255,255,0.05); color: white; outline: none;">
                <option value="" style="background: #1e1b4b;">Selecione o Turno</option>
                <option value="Manhã" {{ $turma->turno == 'Manhã' ? 'selected' : '' }} style="background: #1e1b4b;">Manhã</option>
                <option value="Tarde" {{ $turma->turno == 'Tarde' ? 'selected' : '' }} style="background: #1e1b4b;">Tarde</option>
                <option value="Noite" {{ $turma->turno == 'Noite' ? 'selected' : '' }} style="background: #1e1b4b;">Noite</option>
            </select>
        </div>

        <button type="submit">SALVAR ALTERAÇÕES</button>

        <div style="margin-top: 20px;">
            <a href="/turmas" style="color: rgba(255,255,255,0.5); text-decoration: none; font-size: 14px;">← Voltar</a>
        </div>
    </form>

</div>

@endsection