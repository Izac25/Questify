<!DOCTYPE html>
<html lang="pt-br" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Questify')</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;600&family=Orbitron:wght@400;600;800&display=swap" rel="stylesheet">

<style>

    /* =====================
       THEME VARIABLES
    ===================== */

    :root[data-theme="dark"] {
        --bg-gradient: radial-gradient(circle at top, #1e1b4b, #020617);
        --container-bg: rgba(17, 24, 39, 0.75);
        --container-border: rgba(255,255,255,0.08);
        --container-shadow: 0 0 40px rgba(124,58,237,0.35);
        --login-bg: rgba(255,255,255,0.04);
        --heading-color: #a855f7;
        --text-color: white;
        --input-bg: rgba(255,255,255,0.05);
        --input-border: rgba(255,255,255,0.15);
        --input-border-focus: #a855f7;
        --input-shadow-focus: rgba(168,85,247,0.6);
        --placeholder-color: rgba(255,255,255,0.5);
        --btn-gradient: linear-gradient(135deg, #6d28d9, #9333ea);
        --btn-shadow: rgba(147,51,234,0.7);
        --banner-overlay: linear-gradient(rgba(2,6,23,0.8), rgba(76,29,149,0.85));
        --banner-title-shadow: rgba(168,85,247,0.8);
        --link-color: #ffffff;
        --link-hover: #e9d5ff;
        --link-hover-shadow: rgba(192,132,252,0.8);
        --hint-color: rgba(255,255,255,0.65);
        --success-bg: rgba(34,197,94,0.15);
        --success-border: rgba(34,197,94,0.4);
        --success-text: #86efac;
        --toggle-bg: rgba(255,255,255,0.1);
        --toggle-border: rgba(255,255,255,0.2);
        --toggle-icon: '☀️';
        --toggle-text: 'Modo Claro';
        --toggle-color: rgba(255,255,255,0.8);
        --toggle-hover-bg: rgba(255,255,255,0.18);
    }

    :root[data-theme="light"] {
        --bg-gradient: radial-gradient(circle at top, #dbeafe, #f0f4ff);
        --container-bg: rgba(255, 255, 255, 0.85);
        --container-border: rgba(59,130,246,0.2);
        --container-shadow: 0 0 48px rgba(59,130,246,0.22);
        --login-bg: rgba(239,246,255,0.7);
        --heading-color: #1d4ed8;
        --text-color: #0f172a;
        --input-color: rgb(0, 0, 0);
        --input-bg: rgba(255,255,255,0.9);
        --input-border: rgba(59,130,246,0.3);
        --input-border-focus: #2563eb;
        --input-shadow-focus: rgba(37,99,235,0.35);
        --placeholder-color: rgba(15,23,42,0.4);
        --btn-gradient: linear-gradient(135deg, #1d4ed8, #2563eb);
        --btn-shadow: rgba(37,99,235,0.5);
        --banner-overlay: linear-gradient(rgba(219,234,254,0.82), rgba(37,99,235,0.78));
        --banner-title-shadow: rgba(37,99,235,0.5);
        --link-color: #1e40af;
        --link-hover: #1d4ed8;
        --link-hover-shadow: rgba(59,130,246,0.6);
        --hint-color: rgba(15,23,42,0.5);
        --success-bg: rgba(34,197,94,0.1);
        --success-border: rgba(34,197,94,0.35);
        --success-text: #15803d;
        --toggle-bg: rgba(59,130,246,0.1);
        --toggle-border: rgba(59,130,246,0.25);
        --toggle-icon: '🌙';
        --toggle-text: 'Modo Escuro';
        --toggle-color: #1e40af;
        --toggle-hover-bg: rgba(59,130,246,0.18);
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
        background: var(--bg-gradient);
        display: flex;
        justify-content: center;
        align-items: center;
        color: var(--text-color);
        transition: background 0.4s ease, color 0.4s ease;
        position: relative;
    }

    /* =====================
       THEME TOGGLE BUTTON
    ===================== */

    .theme-toggle {
        position: fixed;
        top: 20px;
        right: 24px;
        z-index: 100;
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        border-radius: 50px;
        background: var(--toggle-bg);
        border: 1px solid var(--toggle-border);
        color: var(--toggle-color);
        cursor: pointer;
        font-family: 'Rajdhani', sans-serif;
        font-size: 14px;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        backdrop-filter: blur(8px);
        user-select: none;

    }

    .theme-toggle:hover {
        background: var(--toggle-hover-bg);
        transform: translateY(-1px);
    }


    .theme-toggle .toggle-icon {
        font-size: 16px;
        transition: transform 0.4s ease;
    }

    .theme-toggle:hover .toggle-icon {
        transform: rotate(20deg) scale(1.15);
    }

    .toggle-label-dark  { display: none; }
    .toggle-label-light { display: none; }

    [data-theme="dark"]  .toggle-label-dark  { display: inline; }
    [data-theme="light"] .toggle-label-light { display: inline; }

    /* =====================
       CONTAINER
    ===================== */

    .container {
        width: 900px;
        min-height: 480px;
        display: flex;
        border-radius: 16px;
        overflow: hidden;
        background: var(--container-bg);
        backdrop-filter: blur(12px);
        border: 1px solid var(--container-border);
        box-shadow: var(--container-shadow);
        transition: background 0.4s ease, border-color 0.4s ease, box-shadow 0.4s ease;
    }

    /* =====================
       LOGIN BOX
    ===================== */

    .login-box {
        width: 50%;
        padding: 60px 45px;
        background: var(--login-bg);
        transition: background 0.4s ease;
    }

    .login-box h2 {
        font-family: 'Orbitron', sans-serif;
        color: var(--heading-color);
        margin-bottom: 35px;
        letter-spacing: 2px;
        font-size: 28px;
        transition: color 0.4s ease;
    }

    .input-group {
        margin-bottom: 18px;
    }

    input {
        width: 100%;
        padding: 12px;
        border-radius: 6px;
        border: 1px solid var(--input-border);
        background: var(--input-bg);
        color: var(--text-color);
        outline: none;
        transition: border-color 0.3s, box-shadow 0.3s, background 0.4s, color 0.4s;
    }

    input::placeholder {
        color: var(--placeholder-color);
    }

    input:focus {
        border-color: var(--input-border-focus);
        box-shadow: 0 0 10px var(--input-shadow-focus);
    }

    button[type="submit"], .btn-primary {
        width: 100%;
        padding: 13px;
        margin-top: 25px;
        border: none;
        border-radius: 8px;
        font-family: 'Orbitron', sans-serif;
        letter-spacing: 1px;
        background: var(--btn-gradient);
        color: white;
        cursor: pointer;
        transition: transform 0.3s, box-shadow 0.3s, background 0.4s;
    }

    button[type="submit"]:hover, .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 0 20px var(--btn-shadow);
    }

    /* =====================
       BANNER
    ===================== */

    .banner {
        width: 50%;
        background:
            var(--banner-overlay),
            url("https://images.unsplash.com/photo-1519389950473-47ba0277781c");
        background-size: cover;
        background-position: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 30px;
        transition: background 0.4s ease;
    }

    .banner h1 {
        font-family: 'Orbitron', sans-serif;
        font-size: 42px;
        letter-spacing: 4px;
        text-shadow: 0 0 15px var(--banner-title-shadow);
        color: white;
        transition: text-shadow 0.4s ease;
    }

    /* No light mode, banner text adjusts for readability */
    [data-theme="light"] .banner h1 {
        color: #ffffff;
        text-shadow: 0 2px 12px rgba(0,0,0,0.35), 0 0 20px var(--banner-title-shadow);
    }

    .banner p {
        margin-top: 12px;
        font-size: 16px;
        opacity: 0.9;
        color: white;
    }

    /* =====================
       LINKS & HELPERS
    ===================== */

    .register-link {
        margin-top: 18px;
        text-align: center;
        font-size: 15px;
    }

    .register-link a {
        color: var(--link-color);
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s, text-shadow 0.3s;
    }

    .register-link a:hover {
        color: var(--link-hover);
        text-shadow: 0 0 8px var(--link-hover-shadow);
    }

    .password-info {
        display: block;
        padding-left: 12px;
        margin-top: 6px;
        font-size: 12px;
        color: var(--hint-color);
    }

    .success-message {
        background: var(--success-bg);
        border: 1px solid var(--success-border);
        color: var(--success-text);
        padding: 10px;
        border-radius: 6px;
        margin-bottom: 20px;
        text-align: center;
        font-size: 14px;
        transition: all 0.4s ease;
    }


    select {
        color: var(--text-color);
    }

    select option {
        background: #1e1b4b;
        color: white;
    }

    [data-theme="light"] select option {
        background: #ffffff;
        color: #0f172a;
    }


    /* =====================
       RESPONSIVE
    ===================== */

    @media (max-width: 680px) {
        .container {
            flex-direction: column;
            width: 95vw;
            min-height: unset;
        }
        .login-box, .banner {
            width: 100%;
        }
        .banner {
            min-height: 200px;
        }
    }

</style>

    @yield('styles')
</head>

<body>

    <!-- THEME TOGGLE -->
    <button class="theme-toggle" onclick="toggleTheme()" aria-label="Alternar tema">
        <span class="toggle-icon">
            <!-- Dark mode: show sun to switch to light -->
            <span class="toggle-label-dark">☀️</span>
            <!-- Light mode: show moon to switch to dark -->
            <span class="toggle-label-light">🌙</span>
        </span>
        <span class="toggle-label-dark">Modo Claro</span>
        <span class="toggle-label-light">Modo Escuro</span>
    </button>

    @yield('content')

    <script>
        function toggleTheme() {
            const html = document.documentElement;
            const current = html.getAttribute('data-theme');
            html.setAttribute('data-theme', current === 'dark' ? 'light' : 'dark');
            localStorage.setItem('questify-theme', html.getAttribute('data-theme'));
        }

        // Restore saved preference on load
        (function () {
            const saved = localStorage.getItem('questify-theme');
            if (saved) {
                document.documentElement.setAttribute('data-theme', saved);
            }
        })();
    </script>

</body>
</html>