<!DOCTYPE html>
<html lang="pt-br" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Questify')</title>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;600&family=Orbitron:wght@400;600;800&display=swap" rel="stylesheet">
    <style>

        /* =====================
           THEME VARIABLES
        ===================== */

        :root[data-theme="dark"] {
            --bg: radial-gradient(circle at top, #1e1b4b, #020617);
            --text: #ffffff;
            --text-muted: rgba(255,255,255,0.6);
            --text-faint: rgba(255,255,255,0.4);

            --topbar-bg: rgba(255,255,255,0.03);
            --topbar-border: rgba(255,255,255,0.07);
            --logo-color: #a855f7;

            --sidebar-bg: rgba(255,255,255,0.02);
            --sidebar-border: rgba(255,255,255,0.07);
            --stat-bg: rgba(255,255,255,0.04);
            --stat-border: rgba(255,255,255,0.08);
            --stat-value: #a855f7;
            --divider: rgba(255,255,255,0.07);

            --card-bg: rgba(255,255,255,0.04);
            --card-border: rgba(255,255,255,0.08);

            --input-bg: rgba(255,255,255,0.05);
            --input-border: rgba(255,255,255,0.15);
            --input-color: #ffffff;
            --input-placeholder: rgba(255,255,255,0.5);
            --input-focus-border: #a855f7;
            --input-focus-shadow: rgba(168,85,247,0.6);

            --select-bg: rgba(255,255,255,0.05);
            --select-color: #ffffff;
            --select-option-bg: #1e1b4b;

            --btn-gradient: linear-gradient(135deg, #6d28d9, #9333ea);
            --btn-shadow: rgba(147,51,234,0.7);
            --btn-danger: linear-gradient(135deg, #dc2626, #b91c1c);
            --btn-admin: linear-gradient(135deg, #b45309, #d97706);

            --avatar-border: #a855f7;
            --avatar-shadow: rgba(168,85,247,0.5);
            --avatar-admin-border: #d97706;
            --avatar-admin-shadow: rgba(217,119,6,0.5);

            --notif-bg: #0f0c29;
            --notif-border: rgba(168,85,247,0.3);
            --notif-header-border: rgba(255,255,255,0.07);
            --notif-header-color: #a855f7;
            --notif-item-border: rgba(255,255,255,0.04);
            --notif-item-hover: rgba(255,255,255,0.04);
            --notif-nao-lida: rgba(168,85,247,0.06);
            --notif-texto: rgba(255,255,255,0.85);
            --notif-tempo: rgba(255,255,255,0.3);
            --notif-vazia: rgba(255,255,255,0.3);
            --notif-btn-bg: rgba(255,255,255,0.06);
            --notif-btn-border: rgba(255,255,255,0.12);

            --success-bg: rgba(34,197,94,0.15);
            --success-border: rgba(34,197,94,0.4);
            --success-text: #86efac;

            --hint-color: rgba(255,255,255,0.65);

            --toggle-bg: rgba(255,255,255,0.08);
            --toggle-border: rgba(255,255,255,0.15);
            --toggle-color: rgba(255,255,255,0.85);
            --toggle-hover-bg: rgba(255,255,255,0.14);
        }

        :root[data-theme="light"] {
            --bg: radial-gradient(circle at top, #dbeafe, #f0f4ff);
            --text: #0f172a;
            --text-muted: rgba(15,23,42,0.6);
            --text-faint: rgba(15,23,42,0.4);

            --topbar-bg: rgba(255,255,255,0.85);
            --topbar-border: rgba(59,130,246,0.15);
            --logo-color: #1d4ed8;

            --sidebar-bg: rgba(239,246,255,0.7);
            --sidebar-border: rgba(59,130,246,0.12);
            --stat-bg: rgba(255,255,255,0.85);
            --stat-border: rgba(59,130,246,0.18);
            --stat-value: #1d4ed8;
            --divider: rgba(59,130,246,0.12);

            --card-bg: rgba(255,255,255,0.85);
            --card-border: rgba(59,130,246,0.18);

            --input-bg: #ffffff;
            --input-border: rgba(59,130,246,0.3);
            --input-color: #0f172a;
            --input-placeholder: rgba(15,23,42,0.4);
            --input-focus-border: #2563eb;
            --input-focus-shadow: rgba(37,99,235,0.3);

            --select-bg: #ffffff;
            --select-color: #0f172a;
            --select-option-bg: #ffffff;

            --btn-gradient: linear-gradient(135deg, #1d4ed8, #2563eb);
            --btn-shadow: rgba(37,99,235,0.5);
            --btn-danger: linear-gradient(135deg, #dc2626, #b91c1c);
            --btn-admin: linear-gradient(135deg, #b45309, #d97706);

            --avatar-border: #2563eb;
            --avatar-shadow: rgba(37,99,235,0.35);
            --avatar-admin-border: #d97706;
            --avatar-admin-shadow: rgba(217,119,6,0.4);

            --notif-bg: #ffffff;
            --notif-border: rgba(37,99,235,0.25);
            --notif-header-border: rgba(59,130,246,0.12);
            --notif-header-color: #1d4ed8;
            --notif-item-border: rgba(59,130,246,0.07);
            --notif-item-hover: rgba(239,246,255,0.8);
            --notif-nao-lida: rgba(37,99,235,0.06);
            --notif-texto: #0f172a;
            --notif-tempo: rgba(15,23,42,0.4);
            --notif-vazia: rgba(15,23,42,0.35);
            --notif-btn-bg: rgba(59,130,246,0.08);
            --notif-btn-border: rgba(59,130,246,0.2);

            --success-bg: rgba(34,197,94,0.1);
            --success-border: rgba(34,197,94,0.35);
            --success-text: #15803d;

            --hint-color: rgba(15,23,42,0.5);

            --toggle-bg: rgba(59,130,246,0.08);
            --toggle-border: rgba(59,130,246,0.2);
            --toggle-color: #1e40af;
            --toggle-hover-bg: rgba(59,130,246,0.15);
        }

        /* =====================
           RESET & BASE
        ===================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Rajdhani', sans-serif;
        }

        body {
            min-height: 100vh;
            background: var(--bg);
            color: var(--text);
            display: flex;
            flex-direction: column;
            transition: background 0.4s ease, color 0.4s ease;
        }

        /* =====================
           TOPBAR
        ===================== */

        .topbar {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 40px;
            background: var(--topbar-bg);
            border-bottom: 1px solid var(--topbar-border);
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(10px);
            transition: background 0.4s, border-color 0.4s;
        }

        .topbar-logo {
            font-family: 'Orbitron', sans-serif;
            font-size: 20px;
            color: var(--logo-color);
            letter-spacing: 3px;
            text-decoration: none;
            transition: color 0.4s;
        }

        .topbar-nav {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .topbar-nav a {
            text-decoration: none;
        }

        /* =====================
           BUTTONS
        ===================== */

        button {
            width: 100%;
            padding: 13px;
            margin-top: 10px;
            border: none;
            border-radius: 8px;
            font-family: 'Orbitron', sans-serif;
            letter-spacing: 1px;
            background: var(--btn-gradient);
            color: white;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s, background 0.4s;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 20px var(--btn-shadow);
        }

        .topbar-nav button {
            width: auto;
            padding: 9px 20px;
            margin-top: 0;
            font-size: 13px;
        }

        .btn-danger {
            background: var(--btn-danger) !important;
        }

        .btn-danger:hover {
            box-shadow: 0 0 20px rgba(220,38,38,0.6) !important;
        }

        .btn-admin {
            background: var(--btn-admin) !important;
        }

        .btn-admin:hover {
            box-shadow: 0 0 20px rgba(217,119,6,0.6) !important;
        }

        /* =====================
           THEME TOGGLE
        ===================== */

        .theme-toggle {
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 8px 16px;
            border-radius: 50px;
            background: var(--toggle-bg) !important;
            border: 1px solid var(--toggle-border) !important;
            color: var(--toggle-color) !important;
            cursor: pointer;
            font-family: 'Rajdhani', sans-serif !important;
            font-size: 13px !important;
            font-weight: 600;
            letter-spacing: 0.5px;
            width: auto !important;
            margin-top: 0 !important;
            transition: background 0.3s, transform 0.3s !important;
            box-shadow: none !important;
        }

        .theme-toggle:hover {
            background: var(--toggle-hover-bg) !important;
            transform: translateY(-1px) !important;
            box-shadow: none !important;
        }

        .theme-toggle .toggle-icon {
            font-size: 15px;
            transition: transform 0.4s;
        }

        .theme-toggle:hover .toggle-icon {
            transform: rotate(20deg) scale(1.15);
        }

        .toggle-label-dark  { display: none; }
        .toggle-label-light { display: none; }
        [data-theme="dark"]  .toggle-label-dark  { display: inline; }
        [data-theme="light"] .toggle-label-light { display: inline; }

        /* =====================
           LAYOUT
        ===================== */

        .layout-body {
            display: flex;
            flex: 1;
            min-height: calc(100vh - 70px);
        }

        /* =====================
           SIDEBAR
        ===================== */

        .layout-sidebar {
            width: 220px;
            min-height: 100%;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--sidebar-border);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 30px 16px;
            gap: 12px;
            flex-shrink: 0;
            transition: background 0.4s, border-color 0.4s;
        }

        .avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--avatar-border);
            box-shadow: 0 0 20px var(--avatar-shadow);
            transition: border-color 0.4s, box-shadow 0.4s;
        }

        .avatar-placeholder {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: var(--btn-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Orbitron', sans-serif;
            font-size: 26px;
            font-weight: bold;
            border: 3px solid var(--avatar-border);
            box-shadow: 0 0 20px var(--avatar-shadow);
            transition: border-color 0.4s, box-shadow 0.4s;
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
            border: 3px solid var(--avatar-admin-border);
            box-shadow: 0 0 20px var(--avatar-admin-shadow);
        }

        .sidebar-nome {
            font-family: 'Orbitron', sans-serif;
            font-size: 13px;
            color: var(--text);
            text-align: center;
            margin-top: 4px;
            transition: color 0.4s;
        }

        .sidebar-info {
            font-size: 12px;
            color: var(--text-muted);
            text-align: center;
            transition: color 0.4s;
        }

        .sidebar-divider {
            width: 100%;
            height: 1px;
            background: var(--divider);
            margin: 8px 0;
            transition: background 0.4s;
        }

        .sidebar-stat {
            width: 100%;
            background: var(--stat-bg);
            border: 1px solid var(--stat-border);
            border-radius: 10px;
            padding: 10px 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background 0.4s, border-color 0.4s;
        }

        .sidebar-stat-label {
            font-size: 12px;
            color: var(--text-muted);
            transition: color 0.4s;
        }

        .sidebar-stat-value {
            font-family: 'Orbitron', sans-serif;
            font-size: 16px;
            color: var(--stat-value);
            transition: color 0.4s;
        }

        /* =====================
           CONTENT
        ===================== */

        .layout-content {
            flex: 1;
            padding: 40px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .layout-content > div,
        .layout-content > form {
            width: 100%;
            max-width: 1000px;
        }

        /* =====================
           INPUTS, SELECTS, TEXTAREAS
        ===================== */

        input,
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid var(--input-border);
            background: var(--input-bg);
            color: var(--input-color);
            outline: none;
            transition: border-color 0.3s, box-shadow 0.3s, background 0.4s, color 0.4s;
            font-size: 14px;
        }

        input::placeholder,
        textarea::placeholder {
            color: var(--input-placeholder);
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: var(--input-focus-border);
            box-shadow: 0 0 10px var(--input-focus-shadow);
        }

        /* Select específico — garante visibilidade das opções em ambos os temas */
        select {
            background-color: var(--select-bg);
            color: var(--select-color);
            appearance: none;
            -webkit-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%23a855f7' stroke-width='1.8' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 38px;
            cursor: pointer;
        }

        [data-theme="light"] select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%231d4ed8' stroke-width='1.8' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
        }

        select option {
            background-color: var(--select-option-bg);
            color: var(--select-color);
        }

        /* Label acima dos selects/inputs */
        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 6px;
            transition: color 0.4s;
        }

        /* =====================
           CARDS (inline styles override)
        ===================== */

        /* Permite que cards com background/border inline herdem tema via classe */
        .card {
            background: var(--card-bg) !important;
            border: 1px solid var(--card-border) !important;
            border-radius: 12px;
            padding: 20px;
            transition: background 0.4s, border-color 0.4s;
        }

        /* =====================
           FEEDBACK MESSAGES
        ===================== */

        .success-message {
            background: var(--success-bg);
            border: 1px solid var(--success-border);
            color: var(--success-text);
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 14px;
            transition: all 0.4s;
        }

        .input-group {
            margin-bottom: 18px;
        }

        .password-info {
            display: block;
            padding-left: 12px;
            margin-top: 6px;
            font-size: 12px;
            color: var(--hint-color);
        }

        /* =====================
           NOTIFICATION BELL
        ===================== */

        .notif-btn {
            position: relative;
            background: var(--notif-btn-bg) !important;
            border: 1px solid var(--notif-btn-border) !important;
            padding: 9px 14px !important;
            font-size: 18px !important;
            cursor: pointer;
            box-shadow: none !important;
        }

        .notif-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: #ef4444;
            color: white;
            font-size: 10px;
            font-family: 'Orbitron', sans-serif;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            display: none;
            align-items: center;
            justify-content: center;
        }

        .notif-dropdown {
            position: absolute;
            top: 60px;
            right: 160px;
            width: 340px;
            background: var(--notif-bg);
            border: 1px solid var(--notif-border);
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
            z-index: 999;
            display: none;
            flex-direction: column;
            overflow: hidden;
            transition: background 0.4s, border-color 0.4s;
        }

        .notif-dropdown.open {
            display: flex;
        }

        .notif-header {
            padding: 14px 18px;
            border-bottom: 1px solid var(--notif-header-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-family: 'Orbitron', sans-serif;
            font-size: 12px;
            color: var(--notif-header-color);
            transition: color 0.4s;
        }

        .notif-marcar-btn {
            background: none !important;
            border: none !important;
            color: var(--text-faint) !important;
            font-size: 11px !important;
            cursor: pointer;
            padding: 0 !important;
            margin: 0 !important;
            width: auto !important;
            font-family: 'Rajdhani', sans-serif !important;
            box-shadow: none !important;
        }

        .notif-marcar-btn:hover {
            color: var(--text) !important;
            transform: none !important;
            box-shadow: none !important;
        }

        .notif-list {
            max-height: 360px;
            overflow-y: auto;
        }

        .notif-item {
            padding: 12px 18px;
            border-bottom: 1px solid var(--notif-item-border);
            display: flex;
            gap: 12px;
            align-items: flex-start;
            cursor: pointer;
            transition: background 0.2s;
        }

        .notif-item:hover {
            background: var(--notif-item-hover);
        }

        .notif-item.nao-lida {
            background: var(--notif-nao-lida);
        }

        .notif-icone { font-size: 20px; flex-shrink: 0; }

        .notif-texto {
            font-size: 13px;
            color: var(--notif-texto);
            line-height: 1.4;
            transition: color 0.4s;
        }

        .notif-tempo {
            font-size: 11px;
            color: var(--notif-tempo);
            margin-top: 4px;
            transition: color 0.4s;
        }

        .notif-vazia {
            padding: 30px;
            text-align: center;
            color: var(--notif-vazia);
            font-size: 13px;
        }

        /* =====================
           TOAST ANIMATION
        ===================== */

        @keyframes toastIn {
            from { opacity: 0; transform: translateX(20px); }
            to   { opacity: 1; transform: translateX(0); }
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
            <a href="/admin/dashboard"><button class="btn-admin">🏠 Início</button></a>
            <a href="/atividades"><button class="btn-admin">📚 Atividades</button></a>
            <a href="/alunos"><button class="btn-admin">👨‍🎓 Alunos</button></a>
            <a href="/admin/instrutores"><button class="btn-admin">👨‍🏫 Instrutores</button></a>
            <a href="/turmas"><button class="btn-admin">🏫 Turmas</button></a>
            @elseif(Auth::guard('instrutor')->check())
            <a href="/dashboard"><button>🏠 Início</button></a>
            <a href="/perfil/instrutor/editar"><button>✏️ Perfil</button></a>
            <a href="/turmas"><button>🏫 Turmas</button></a>
            <a href="/alunos"><button>👨‍🎓 Alunos</button></a>
            <a href="/atividades"><button>📚 Atividades</button></a>
            @else
            <a href="/dashboard"><button>🏠 Início</button></a>
            <a href="/perfil/editar"><button>✏️ Editar Perfil</button></a>
            @endif

            {{-- SININHO --}}
            @if(Auth::guard('web')->check() || Auth::guard('instrutor')->check())
            <div style="position:relative;">
                <button class="notif-btn" onclick="toggleNotif()" title="Notificações">
                    🔔
                    <span class="notif-badge" id="notif-badge">0</span>
                </button>
            </div>

            <div class="notif-dropdown" id="notif-dropdown">
                <div class="notif-header">
                    <span>🔔 NOTIFICAÇÕES</span>
                    <button class="notif-marcar-btn" onclick="marcarTodasLidas()">Marcar todas como lidas</button>
                </div>
                <div class="notif-list" id="notif-list">
                    <div class="notif-vazia">Carregando...</div>
                </div>
            </div>
            @endif

            {{-- TOGGLE TEMA --}}
            <button class="theme-toggle" onclick="toggleTheme()" aria-label="Alternar tema">
                <span class="toggle-icon">
                    <span class="toggle-label-dark">☀️</span>
                    <span class="toggle-label-light">🌙</span>
                </span>
                <span class="toggle-label-dark">Claro</span>
                <span class="toggle-label-light">Escuro</span>
            </button>

            <form method="POST" action="/logout" style="display:inline;">
                @csrf
                <button class="btn-danger" style="width:auto; padding:9px 20px; margin-top:0; font-size:13px;">Sair</button>
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
                    <div class="avatar-placeholder">{{ strtoupper(substr($usuario->nome, 0, 1)) }}</div>
                @endif
                <div class="sidebar-nome">{{ $usuario->nome }}</div>
                <div class="sidebar-info">Instrutor</div>

            @else
                @php $usuario = Auth::guard('web')->user(); @endphp
                @if($usuario->foto)
                    <img src="{{ asset('storage/' . $usuario->foto) }}" class="avatar">
                @else
                    <div class="avatar-placeholder">{{ strtoupper(substr($usuario->nome, 0, 1)) }}</div>
                @endif
                <div class="sidebar-nome">{{ $usuario->nome }}</div>
                <div class="sidebar-info">
                    {{ $usuario->turma ? $usuario->turma->nome . ' - ' . $usuario->turma->sala : 'Sem turma' }}
                </div>
                <div class="sidebar-info">{{ $usuario->turno ?? 'Sem turno' }}</div>
                <div class="sidebar-divider"></div>
                <div class="sidebar-stat">
                    <span class="sidebar-stat-label">⭐ Pontos</span>
                    <span class="sidebar-stat-value" id="sidebar-pontos">{{ $usuario->pontos }}</span>
                </div>
                <div class="sidebar-stat">
                    <span class="sidebar-stat-label">😊 Comportamento</span>
                    <span class="sidebar-stat-value" id="sidebar-comportamento">{{ $usuario->pontos_comportamento }}</span>
                </div>
                <div class="sidebar-stat">
                    <span class="sidebar-stat-label">📅 Frequência</span>
                    <span class="sidebar-stat-value" id="sidebar-frequencia">{{ $usuario->frequencia }}</span>
                </div>
            @endif
        </div>

        {{-- CONTEÚDO --}}
        <div class="layout-content">
            @yield('content')
        </div>

    </div>

    {{-- PUSHER --}}
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>

        /* =====================
           TEMA
        ===================== */
        function toggleTheme() {
            const html = document.documentElement;
            html.setAttribute('data-theme', html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark');
            localStorage.setItem('questify-theme', html.getAttribute('data-theme'));
        }

        (function () {
            const saved = localStorage.getItem('questify-theme');
            if (saved) document.documentElement.setAttribute('data-theme', saved);
        })();

        /* =====================
           PUSHER
        ===================== */
        const pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
            cluster: '{{ env("PUSHER_APP_CLUSTER") }}'
        });

        /* =====================
           TOAST
        ===================== */
        function showToast(msg, tipo, icone) {
            const colors = {
                green:  { bg: 'rgba(52,211,153,0.15)',  border: 'rgba(52,211,153,0.4)',  text: '#34d399' },
                red:    { bg: 'rgba(248,113,113,0.15)', border: 'rgba(248,113,113,0.4)', text: '#f87171' },
                purple: { bg: 'rgba(168,85,247,0.15)',  border: 'rgba(168,85,247,0.4)',  text: '#a855f7' },
                blue:   { bg: 'rgba(96,165,250,0.15)',  border: 'rgba(96,165,250,0.4)',  text: '#60a5fa' },
                info:   { bg: 'rgba(168,85,247,0.15)',  border: 'rgba(168,85,247,0.4)',  text: '#a855f7' },
            };
            const c = colors[tipo] || colors.info;
            let container = document.getElementById('toast-container');
            if (!container) {
                container = document.createElement('div');
                container.id = 'toast-container';
                container.style.cssText = 'position:fixed;top:80px;right:24px;z-index:9999;display:flex;flex-direction:column;gap:10px;';
                document.body.appendChild(container);
            }
            const toast = document.createElement('div');
            toast.style.cssText = `padding:14px 18px;border-radius:10px;background:${c.bg};border:1px solid ${c.border};color:${c.text};font-family:'Rajdhani',sans-serif;font-size:14px;max-width:320px;display:flex;gap:10px;align-items:flex-start;animation:toastIn 0.3s ease;backdrop-filter:blur(20px);box-shadow:0 4px 20px rgba(0,0,0,0.3);`;
            toast.innerHTML = `<span style="font-size:18px;">${icone}</span><span>${msg}</span>`;
            container.appendChild(toast);
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(20px)';
                toast.style.transition = 'all 0.3s ease';
                setTimeout(() => toast.remove(), 300);
            }, 4000);
        }

        /* =====================
           NOTIFICAÇÕES
        ===================== */
        function toggleNotif() {
            const dropdown = document.getElementById('notif-dropdown');
            dropdown.classList.toggle('open');
            if (dropdown.classList.contains('open')) carregarNotificacoes();
        }

        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('notif-dropdown');
            if (dropdown && !dropdown.contains(e.target) && !e.target.closest('.notif-btn')) {
                dropdown.classList.remove('open');
            }
        });

        function tempoRelativo(dateStr) {
            const diff = Math.floor((new Date() - new Date(dateStr)) / 1000);
            if (diff < 60) return 'agora mesmo';
            if (diff < 3600) return Math.floor(diff/60) + ' min atrás';
            if (diff < 86400) return Math.floor(diff/3600) + 'h atrás';
            return Math.floor(diff/86400) + 'd atrás';
        }

        function carregarNotificacoes() {
            fetch('/notificacoes')
                .then(r => r.json())
                .then(data => {
                    const list = document.getElementById('notif-list');
                    const badge = document.getElementById('notif-badge');
                    if (data.length === 0) {
                        list.innerHTML = '<div class="notif-vazia">✨ Nenhuma notificação nova</div>';
                        badge.style.display = 'none';
                        return;
                    }
                    badge.textContent = data.length;
                    badge.style.display = 'flex';
                    list.innerHTML = data.map(n => `
                        <div class="notif-item nao-lida" onclick="marcarLida(${n.id_notificacao}, this)">
                            <span class="notif-icone">${n.icone}</span>
                            <div>
                                <div class="notif-texto">${n.mensagem}</div>
                                <div class="notif-tempo">${tempoRelativo(n.created_at)}</div>
                            </div>
                        </div>
                    `).join('');
                });
        }

        function marcarLida(id, el) {
            fetch(`/notificacoes/${id}/lida`, {
                method: 'PUT',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' }
            }).then(() => {
                el.classList.remove('nao-lida');
                el.style.opacity = '0.4';
                setTimeout(() => el.remove(), 300);
                atualizarBadge(-1);
            });
        }

        function marcarTodasLidas() {
            fetch('/notificacoes/todas-lidas', {
                method: 'PUT',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' }
            }).then(() => {
                document.getElementById('notif-list').innerHTML = '<div class="notif-vazia">✨ Nenhuma notificação nova</div>';
                const badge = document.getElementById('notif-badge');
                badge.style.display = 'none';
            });
        }

        function atualizarBadge(delta) {
            const badge = document.getElementById('notif-badge');
            const atual = parseInt(badge.textContent || '0') + delta;
            if (atual <= 0) { badge.style.display = 'none'; }
            else { badge.textContent = atual; badge.style.display = 'flex'; }
        }

        @if(Auth::guard('web')->check() || Auth::guard('instrutor')->check())
        fetch('/notificacoes')
            .then(r => r.json())
            .then(data => {
                const badge = document.getElementById('notif-badge');
                if (data.length > 0) { badge.textContent = data.length; badge.style.display = 'flex'; }
            });
        @endif

        @if(Auth::guard('web')->check())
        const canalAluno = pusher.subscribe('aluno.{{ Auth::guard("web")->user()->id_aluno }}');
        canalAluno.bind('notificacao', function(data) {
            showToast(data.mensagem, data.tipo, data.icone);
            atualizarBadge(1);
            if (data.pontos && data.pontos != 0) {
                const el = document.getElementById('sidebar-pontos');
                if (el) el.textContent = parseInt(el.textContent) + parseInt(data.pontos);
            }
        });
        @endif

        @if(Auth::guard('instrutor')->check())
        const canalInstrutor = pusher.subscribe('instrutor.{{ Auth::guard("instrutor")->user()->id_instrutor }}');
        canalInstrutor.bind('notificacao', function(data) {
            showToast(data.mensagem, data.tipo, data.icone);
            atualizarBadge(1);
        });
        @endif

    </script>

</body>
</html>