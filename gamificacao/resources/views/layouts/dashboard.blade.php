<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Questify')</title>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;600&family=Orbitron:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Rajdhani', sans-serif; }
        body {
            min-height: 100vh;
            background: radial-gradient(circle at top, #1e1b4b, #020617);
            color: white;
            display: flex;
            flex-direction: column;
        }
        .topbar {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 40px;
            background: rgba(255,255,255,0.03);
            border-bottom: 1px solid rgba(255,255,255,0.07);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .topbar-logo {
            font-family: 'Orbitron', sans-serif;
            font-size: 20px;
            color: #a855f7;
            letter-spacing: 3px;
            text-decoration: none;
        }
        .topbar-nav { display: flex; gap: 12px; align-items: center; }
        .topbar-nav a { text-decoration: none; }
        .topbar-nav button {
            width: auto;
            padding: 9px 20px;
            margin-top: 0;
            font-size: 13px;
            border: none;
            border-radius: 8px;
            font-family: 'Orbitron', sans-serif;
            letter-spacing: 1px;
            background: linear-gradient(135deg, #6d28d9, #9333ea);
            color: white;
            cursor: pointer;
            transition: 0.3s;
        }
        .topbar-nav button:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 20px rgba(147,51,234,0.7);
        }
        .btn-danger { background: linear-gradient(135deg, #dc2626, #b91c1c) !important; }
        .btn-admin { background: linear-gradient(135deg, #b45309, #d97706) !important; }
        .layout-body { display: flex; flex: 1; min-height: calc(100vh - 70px); }
        .layout-sidebar {
            width: 220px;
            min-height: 100%;
            background: rgba(255,255,255,0.02);
            border-right: 1px solid rgba(255,255,255,0.07);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 30px 16px;
            gap: 12px;
            flex-shrink: 0;
        }
        .avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #a855f7;
            box-shadow: 0 0 20px rgba(168,85,247,0.5);
        }
        .avatar-placeholder {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6d28d9, #9333ea);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Orbitron', sans-serif;
            font-size: 26px;
            font-weight: bold;
            border: 3px solid #a855f7;
            box-shadow: 0 0 20px rgba(168,85,247,0.5);
        }
        .avatar-admin {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #b45309, #d97706);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Orbitron', sans-serif;
            font-size: 26px;
            font-weight: bold;
            border: 3px solid #d97706;
            box-shadow: 0 0 20px rgba(217,119,6,0.5);
        }
        .sidebar-nome {
            font-family: 'Orbitron', sans-serif;
            font-size: 13px;
            color: white;
            text-align: center;
            margin-top: 4px;
        }
        .sidebar-info { font-size: 12px; opacity: 0.6; text-align: center; }
        .sidebar-divider { width: 100%; height: 1px; background: rgba(255,255,255,0.07); margin: 8px 0; }
        .sidebar-stat {
            width: 100%;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 10px;
            padding: 10px 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .sidebar-stat-label { font-size: 12px; opacity: 0.6; }
        .sidebar-stat-value { font-family: 'Orbitron', sans-serif; font-size: 16px; color: #a855f7; }
        .layout-content {
            flex: 1;
            padding: 40px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }
        .layout-content > div,
        .layout-content > form { width: 100%; max-width: 1000px; }
        input, select, textarea {
            width: 100%;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid rgba(255,255,255,0.15);
            background: rgba(255,255,255,0.05);
            color: white;
            outline: none;
            transition: 0.3s;
        }
        input::placeholder, textarea::placeholder { color: rgba(255,255,255,0.5); }
        input:focus, select:focus, textarea:focus {
            border-color: #a855f7;
            box-shadow: 0 0 10px rgba(168,85,247,0.6);
        }
        button {
            width: 100%;
            padding: 13px;
            margin-top: 10px;
            border: none;
            border-radius: 8px;
            font-family: 'Orbitron', sans-serif;
            letter-spacing: 1px;
            background: linear-gradient(135deg, #6d28d9, #9333ea);
            color: white;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 20px rgba(147,51,234,0.7);
        }
        .success-message {
            background: rgba(34,197,94,0.15);
            border: 1px solid rgba(34,197,94,0.4);
            color: #86efac;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 14px;
        }
        .input-group { margin-bottom: 18px; }
        .password-info {
            display: block;
            padding-left: 12px;
            margin-top: 6px;
            font-size: 12px;
            color: rgba(255,255,255,0.65);
        }
    </style>
    @yield('styles')
</head>
<body>

    {{-- TOPBAR --}}
    <div class="topbar">
        @if(Auth::guard('admin')->check())
            <a href="/admin/dashboard" class="topbar-logo">QUESTIFY <span style="font-size: 12px; color: #d97706;">ADMIN</span></a>
        @else
            <a href="/dashboard" class="topbar-logo">QUESTIFY</a>
        @endif
        <div class="topbar-nav">
            @if(Auth::guard('admin')->check())
                <a href="/admin/instrutores"><button class="btn-admin">👨‍🏫 Instrutores</button></a>
                <a href="/admin/alunos"><button class="btn-admin">👨‍🎓 Alunos</button></a>
                <a href="/admin/dashboard"><button class="btn-admin">🏠 Início</button></a>
            @elseif(Auth::guard('instrutor')->check())
                <a href="/turmas"><button>🏫 Turmas</button></a>
                <a href="/alunos"><button>👨‍🎓 Alunos</button></a>
                <a href="/atividades"><button>📚 Atividades</button></a>
                <a href="/perfil/instrutor/editar"><button>✏️ Perfil</button></a>
                <a href="/dashboard"><button>🏠 Início</button></a>
            @else
                <a href="/perfil/editar"><button>✏️ Editar Perfil</button></a>
                <a href="/dashboard"><button>🏠 Início</button></a>
            @endif
            <form method="POST" action="/logout">
                @csrf
                <button class="btn-danger">Sair</button>
            </form>
        </div>
    </div>

    {{-- BODY --}}
    <div class="layout-body">

        {{-- SIDEBAR --}}
        <div class="layout-sidebar">
            @if(Auth::guard('admin')->check())
                @php $usuario = Auth::guard('admin')->user(); @endphp
                <div class="avatar-admin">⚙️</div>
                <div class="sidebar-nome">{{ $usuario->nome }}</div>
                <div class="sidebar-info" style="color: #d97706; opacity: 1;">Admin</div>
            @elseif(Auth::guard('instrutor')->check())
                @php $usuario = Auth::guard('instrutor')->user(); @endphp
                @if($usuario->foto)
                    <img src="{{ asset('storage/' . $usuario->foto) }}" class="avatar">
                @else
                    <div class="avatar-placeholder">
                        {{ strtoupper(substr($usuario->nome, 0, 1)) }}
                    </div>
                @endif
                <div class="sidebar-nome">{{ $usuario->nome }}</div>
                <div class="sidebar-info">Instrutor</div>
            @else
                @php $usuario = Auth::guard('web')->user(); @endphp
                @if($usuario->foto)
                    <img src="{{ asset('storage/' . $usuario->foto) }}" class="avatar">
                @else
                    <div class="avatar-placeholder">
                        {{ strtoupper(substr($usuario->nome, 0, 1)) }}
                    </div>
                @endif
                <div class="sidebar-nome">{{ $usuario->nome }}</div>
                <div class="sidebar-info">
                    {{ $usuario->turma ? $usuario->turma->nome . ' - ' . $usuario->turma->sala : 'Sem turma' }}
                </div>
                <div class="sidebar-info">{{ $usuario->turno ?? 'Sem turno' }}</div>
                <div class="sidebar-divider"></div>
                <div class="sidebar-stat">
                    <span class="sidebar-stat-label">⭐ Pontos</span>
                    <span class="sidebar-stat-value">{{ $usuario->pontos }}</span>
                </div>
                <div class="sidebar-stat">
                    <span class="sidebar-stat-label">😊 Comportamento</span>
                    <span class="sidebar-stat-value">{{ $usuario->pontos_comportamento }}</span>
                </div>
                <div class="sidebar-stat">
                    <span class="sidebar-stat-label">📅 Frequência</span>
                    <span class="sidebar-stat-value">{{ $usuario->frequencia }}</span>
                </div>
            @endif
        </div>

        {{-- CONTEÚDO --}}
        <div class="layout-content">
            @yield('content')
        </div>

    </div>

</body>
</html>