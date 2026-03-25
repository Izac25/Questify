@extends('layouts.app')
@section('title', 'Cadastro')
@section('content')

<div class="container">
<div class="login-box">
<h2>SIGN UP</h2>

@if ($errors->any())
<div style="background: rgba(220,38,38,0.15); border: 1px solid rgba(220,38,38,0.4); color: #fca5a5; padding: 10px; border-radius: 6px; margin-bottom: 20px;">
    @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
</div>
@endif

<form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
@csrf

<div class="input-group">
    <input type="text" name="nome" placeholder="Nome" required>
</div>

<div class="input-group">
    <input type="email" name="email" placeholder="Email" required>
</div>

<div class="input-group">
    <select name="fk_id_turma" required style="width: 100%; padding: 12px; border-radius: 6px; border: 1px solid rgba(255,255,255,0.15); background: rgba(255,255,255,0.05);  outline: none;">
        <option class="black-tema" value="" style="background: #1e1b4b;">Selecione sua Turma</option>
        @foreach($turmas as $turma)
            <option value="{{ $turma->id_turma }}" style="background: #1e1b4b;">
                {{ $turma->nome }} - {{ $turma->sala }} ({{ $turma->turno }})
            </option>
        @endforeach
    </select>
</div>

<div class="input-group">
    <input type="password" name="senha" placeholder="Senha" required>
    <small class="password-info">A senha deve ter no mínimo 6 caracteres.</small>
</div>

<div class="input-group">
    <input type="password" name="senha_confirmation" placeholder="Confirmar senha" required>
</div>

<div class="input-group">
    <input type="file" name="foto" accept="image/*" style="width: 100%; padding: 12px; border-radius: 6px; border: 1px solid rgba(255,255,255,0.15); background: rgba(255,255,255,0.05);  outline: none;">
    <small class="password-info">Foto de perfil (opcional)</small>
</div>

<button type="submit">CRIAR CONTA</button>

<p class="register-link">
    Já possui conta?
    <a href="/login">Entrar</a>
</p>
</form>
</div>

<div class="banner">
<div>
    <h1>Questify</h1>
    <p>Comece sua jornada</p>
</div>
</div>
</div>

@endsection