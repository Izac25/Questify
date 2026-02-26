@extends('layouts.app')

@section('title', 'Cadastro')

@section('content')

<div class="container">

    <div class="login-box">
        <h2>SIGN UP</h2>

        @if ($errors->any())
    <div class="error-box">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="input-group">
                <input 
                    type="text"
                    name="name"
                    placeholder="Nome"
                    required
                >
            </div>

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
                    placeholder="Senha"
                    required
                        <small class="password-info">
                             A senha deve ter no mínimo 6 caracteres.
                        </small>
            </div>

            <div class="input-group">
                <input 
                    type="password"
                    name="password_confirmation"
                    placeholder="Confirmar senha"
                    required
                >
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