@extends('layouts.app')

@section('title', 'Login')

@section('content')

<div class="container">

    <div class="login-box">
        <h2>SIGN IN</h2>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-group">
                <input 
                    type="email" 
                    name="email"
                    placeholder="Email"
                    required
                >
            </div>

            <div class="input-group">
                <input 
                    type="password" 
                    name="password"
                    placeholder="Password"
                    required
                >
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