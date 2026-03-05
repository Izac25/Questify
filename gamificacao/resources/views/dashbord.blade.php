@if(Auth::guard('instrutor')->check())
    <p>Bem-vindo, {{ Auth::guard('instrutor')->user()->nome }} (Instrutor)</p>
@else
    <p>Bem-vindo, {{ Auth::guard('web')->user()->nome }} (Aluno)</p>
@endif