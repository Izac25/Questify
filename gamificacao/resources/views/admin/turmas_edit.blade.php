@extends('layouts.dashboard')
@section('title', 'Editar Turma')
@section('content')

<div>
    <div style="margin-bottom: 30px;">
        <h2 style="font-family: 'Orbitron', sans-serif; color: #a855f7; font-size: 24px;">Editar Turma</h2>
    </div>

    @if ($errors->any())
        <div style="background: rgba(220,38,38,0.15); border: 1px solid rgba(220,38,38,0.4); color: #fca5a5; padding: 10px; border-radius: 6px; margin-bottom: 20px;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="/admin/turmas/{{ $turma->id_turma }}" style="max-width: 500px;">
        @csrf
        @method('PUT')

        <div class="input-group">
            <input type="text" name="nome" placeholder="Nome da turma" value="{{ $turma->nome }}" required>
        </div>

        <div class="input-group">
            <input type="text" name="sala" placeholder="Sala" value="{{ $turma->sala }}" required>
        </div>

        <div class="input-group">
            <select name="turno" required>
                <option value="" style="background: #1e1b4b;">Selecione o turno</option>
                <option value="Manhã" style="background: #1e1b4b;" {{ $turma->turno == 'Manhã' ? 'selected' : '' }}>Manhã</option>
                <option value="Tarde" style="background: #1e1b4b;" {{ $turma->turno == 'Tarde' ? 'selected' : '' }}>Tarde</option>
                <option value="Noite" style="background: #1e1b4b;" {{ $turma->turno == 'Noite' ? 'selected' : '' }}>Noite</option>
            </select>
        </div>

        <div class="input-group">
            <select name="fk_id_instrutor" required>
                <option value="" style="background: #1e1b4b;">Selecione o instrutor</option>
                @foreach($instrutores as $instrutor)
                    <option value="{{ $instrutor->id_instrutor }}" style="background: #1e1b4b;"
                        {{ $turma->fk_id_instrutor == $instrutor->id_instrutor ? 'selected' : '' }}>
                        {{ $instrutor->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit">SALVAR ALTERAÇÕES</button>

        <div style="margin-top: 20px;">
            <a href="/admin/turmas" style="color: rgba(255,255,255,0.5); text-decoration: none; font-size: 14px;">← Voltar</a>
        </div>
    </form>
</div>

@endsection