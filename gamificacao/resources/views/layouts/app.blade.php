<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Questify')</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;600&family=Orbitron:wght@400;600;800&display=swap" rel="stylesheet">

<style>

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Rajdhani', sans-serif;
    }

    body {
        height: 100vh;
        background:
            radial-gradient(circle at top, #1e1b4b, #020617);
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
    }

    /* CONTAINER */
    .container {
        width: 900px;
         min-height: 480px;
        display: flex;
        border-radius: 16px;
        overflow: hidden;

        /* Glass effect */
        background: rgba(17, 24, 39, 0.75);
        backdrop-filter: blur(12px);

        border: 1px solid rgba(255,255,255,0.08);
        box-shadow: 0 0 40px rgba(124,58,237,0.35);
    }

    /* LOGIN */
    .login-box {
        width: 50%;
        padding: 60px 45px;
        background: rgba(255,255,255,0.04);
    }

    .login-box h2 {
        font-family: 'Orbitron', sans-serif;
        color: #a855f7;
        margin-bottom: 35px;
        letter-spacing: 2px;
        font-size: 28px;
    }

    .input-group {
        margin-bottom: 18px;
    }

    input {
        width: 100%;
        padding: 12px;
        border-radius: 6px;
        border: 1px solid rgba(255,255,255,0.15);
        background: rgba(255,255,255,0.05);
        color: white;
        outline: none;
        transition: 0.3s;
    }

    input::placeholder {
        color: rgba(255,255,255,0.5);
    }

    input:focus {
        border-color: #a855f7;
        box-shadow: 0 0 10px rgba(168,85,247,0.6);
    }

    button {
        width: 100%;
        padding: 13px;
        margin-top: 25px;
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

    /* BANNER */
    .banner {
        width: 50%;
        background:
            linear-gradient(rgba(2,6,23,0.8), rgba(76,29,149,0.85)),
            url("https://images.unsplash.com/photo-1519389950473-47ba0277781c");
        background-size: cover;
        background-position: center;

        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 30px;
    }

    .banner h1 {
        font-family: 'Orbitron', sans-serif;
        font-size: 42px;
        letter-spacing: 4px;
        text-shadow: 0 0 15px rgba(168,85,247,0.8);
    }

    .banner p {
        margin-top: 12px;
        font-size: 16px;
        opacity: 0.85;
    }

    /* LINK CADASTRO */
.register-link {
    margin-top: 18px;
    text-align: center;
    font-size: 15px;
}

.register-link a {
    color: #ffffff; 
    text-decoration: none;
    font-weight: 600;
    transition: 0.3s;
}

.register-link a:hover {
    color: #e9d5ff;
    text-shadow: 0 0 8px rgba(192,132,252,0.8);
}

.password-info {
    display: block;
    padding-left: 12px;
    margin-top: 6px;
    font-size: 12px;
    color: rgba(255,255,255,0.65);
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

</style>

    @yield('styles')
</head>

<body>

    @yield('content')

</body>
</html>