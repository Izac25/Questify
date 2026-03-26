<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nova Notificação - Questify</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333; line-height: 1.6; }
        .container { width: 80%; margin: 20px auto; border: 1px solid #ddd; padding: 20px; border-radius: 8px; }
        .header { border-bottom: 2px solid #6f42c1; padding-bottom: 10px; margin-bottom: 20px; }
        .points { font-size: 1.2em; color: #28a745; font-weight: bold; }
        .footer { margin-top: 30px; font-size: 0.8em; color: #777; border-top: 1px solid #eee; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Questify - Nova Notificação! 🎮</h2>
        </div>
        
        <p>Olá!</p>
        <p>Temos uma atualização importante para você:</p>
        
        <blockquote>
            <strong>{{ $mensagem }}</strong>
        </blockquote>

        @if($pontos > 0)
            <p>Essa atividade vale: <span class="points">+{{ $pontos }} pontos</span></p>
        @endif

        <p>Acesse o sistema para conferir os detalhes e não perder o prazo!</p>

        <div class="footer">
            <p>Este é um e-mail automático enviado pelo sistema Questify.</p>
        </div>
    </div>
</body>
</html>