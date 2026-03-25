@extends('layouts.app')

@section('title', 'Login')

@section('content')

<div class="container">

    
    <div class="login-box">
        <h2>SIGN IN</h2>

        {{-- Alertas de Sucesso ou Status de Recuperação --}}
        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        @if (session('status'))
            <div class="success-message">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-group">
                <input 
                    type="email" 
                    name="email"
                    placeholder="Email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                >
                @error('email')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-group">
                <input 
                    type="password" 
                    name="senha"
                    placeholder="Password"
                    required
                >
                @error('senha')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            {{-- Link para Recuperar Senha --}}
            <div class="forgot-password-link" style="margin-bottom: 15px; text-align: right;">
                <a href="{{ route('password.request') }}" style="font-size: 0.8rem; color: #ece9e9;">
                    Esqueceu sua senha?
                </a>
            </div>

            <button type="submit">LOGIN</button>
        </form>

        <p class="register-link">
            Não tem conta?
            <a href="/register">Cadastre-se</a>
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