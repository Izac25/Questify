@extends('layouts.dashboard')
@section('title', 'Criar Atividade')
@section('content')

<div class="container" style="flex-direction: column; padding: 50px 45px; min-height: 480px; width: 900px;">

    <div style="margin-bottom: 30px;">
        <h2 style="font-family: 'Orbitron', sans-serif; color: #a855f7; letter-spacing: 2px; font-size: 24px;">Nova Atividade</h2>
    </div>

    @if ($errors->any())
        <div style="background: rgba(220,38,38,0.15); border: 1px solid rgba(220,38,38,0.4); color: #fca5a5; padding: 10px; border-radius: 6px; margin-bottom: 20px;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="/atividades" style="max-width: 500px;">
        @csrf

        <div class="input-group">
            <input type="text" name="titulo" placeholder="Título da Atividade" required value="{{ old('titulo') }}">
        </div>

        <div class="input-group">
            <textarea name="descricao" placeholder="Descrição (opcional)" style="width: 100%; padding: 12px; border-radius: 6px; border: 1px solid rgba(255,255,255,0.15); background: rgba(255,255,255,0.05); color: white; outline: none; resize: vertical; min-height: 100px;">{{ old('descricao') }}</textarea>
        </div>

        <div class="input-group">
            <input type="number" name="pontos" placeholder="Pontos" min="0" required value="{{ old('pontos') }}">
        </div>

        <!-- Nova seleção de Turma -->
        <div class="input-group">
            <select name="fk_id_turma" required style="width: 100%; padding: 12px; border-radius: 6px; border: 1px solid rgba(255,255,255,0.15); background: rgba(255,255,255,0.05); color: white; outline: none;">
                <option value="" style="background: #1e1b4b;">Selecione a Turma/Sala</option>
                @forelse($turmas as $turma)
                    <option value="{{ $turma->id_turma }}" style="background: #1e1b4b;" {{ old('fk_id_turma') == $turma->id_turma ? 'selected' : '' }}>
                        {{ $turma->nome }} - {{ $turma->sala }} ({{ $turma->turno }})
                    </option>
                @empty
                    <option value="" style="background: #1e1b4b;">Nenhuma turma disponível</option>
                @endforelse
            </select>
            <small class="password-info" style="margin-top: 5px; color: rgba(255,255,255,0.6);">
                Apenas turmas dos seus turnos permitidos aparecem aqui
            </small>
        </div>

        <div class="input-group">
            <input type="date" name="data_limite" style="width: 100%; padding: 12px; border-radius: 6px; border: 1px solid rgba(255,255,255,0.15); background: rgba(255,255,255,0.05); outline: none;" value="{{ old('data_limite') }}">
            <small class="password-info">Data limite (opcional)</small>
        </div>

        <button type="submit">CRIAR ATIVIDADE</button>

        <div style="margin-top: 20px;">
            <a href="/atividades" style="color: rgba(255,255,255,0.5); text-decoration: none; font-size: 14px;">← Voltar</a>
        </div>
    </form>

</div>

@endsection