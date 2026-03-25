@extends('layouts.app')

@section('title', 'Recuperar Senha')

@section('content')

<div class="container">
    <div class="login-box">
        <h2>RECUPERAR SENHA</h2>

        @if (session('status'))
            <div class="success-message" style="margin-bottom: 20px; color: green;">
                {{ session('status') }}
            </div>
        @endif

        <p style="margin-bottom: 20px; font-size: 0.9rem; color: #666;">
            Informe seu e-mail para receber o link de redefinição de senha.
        </p>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="input-group">
                <input 
                    type="email" 
                    name="email" 
                    placeholder="Seu e-mail cadastrado" 
                    value="{{ old('email') }}" 
                    required 
                    autofocus
                >
                @error('email')
                    <span class="error-text" style="color: red; font-size: 0.8rem;">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit">ENVIAR LINK</button>
        </form>

        <p class="register-link" style="margin-top: 20px;">
            <a href="{{ route('login') }}">Voltar para o Login</a>
        </p>
    </div>

    <div class="banner">
        <div>
            <h1>Questify</h1>
            <p>Sistema de Gamificação</p>
        </div>
    </div>
</div>

@endsection