@extends('layouts.app')
@section('title', 'Criar Turma')
@section('content')

<div class="container" style="flex-direction: column; padding: 50px 45px; min-height: 480px; width: 900px;">

    <div style="margin-bottom: 30px;">
        <h2 style="font-family: 'Orbitron', sans-serif; color: #a855f7; letter-spacing: 2px; font-size: 24px;">Nova Turma</h2>
    </div>

    @if ($errors->any())
        <div style="background: rgba(220,38,38,0.15); border: 1px solid rgba(220,38,38,0.4); color: #fca5a5; padding: 10px; border-radius: 6px; margin-bottom: 20px;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="/turmas" style="max-width: 500px;">
        @csrf
        <div class="input-group">
            <input
                type="text"
                name="nome"
                placeholder="Nome da Turma"
                required
            >
        </div>
        <div class="input-group">
            <input
                type="text"
                name="sala"
                placeholder="Sala"
                required
            >
        </div>
        <div class="input-group">
            <select name="turno" required style="width: 100%; padding: 12px; border-radius: 6px; border: 1px solid rgba(255,255,255,0.15); background: rgba(255,255,255,0.05); color: white; outline: none;">
                <option value="" style="background: #1e1b4b;">Selecione o Turno</option>
                <option value="Manhã" style="background: #1e1b4b;">Manhã</option>
                <option value="Tarde" style="background: #1e1b4b;">Tarde</option>
                <option value="Noite" style="background: #1e1b4b;">Noite</option>
            </select>
        </div>

        <button type="submit">CRIAR TURMA</button>

        <div style="margin-top: 20px;">
            <a href="/turmas" style="color: rgba(255,255,255,0.5); text-decoration: none; font-size: 14px;">← Voltar</a>
        </div>
    </form>

</div>

@endsection