<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Instrutor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view("auth.login");
    }

    public function showRegister()
    {
        return view("auth.register");
    }

    public function login(Request $request)
    {
        Auth::guard('web')->logout();
        Auth::guard('instrutor')->logout();
        session()->invalidate();
        session()->regenerateToken();

        $email = $request->email;
        $password = $request->senha;

        // Tenta logar como aluno
        $aluno = Aluno::where('email', $email)->first();
        if ($aluno && Hash::check($password, $aluno->senha)) {
            Auth::guard('web')->login($aluno);
            return redirect('/dashboard');
        }

        // Tenta logar como instrutor
        $instrutor = Instrutor::where('email', $email)->first();
        if ($instrutor && Hash::check($password, $instrutor->senha)) {
            Auth::guard('instrutor')->login($instrutor);
            return redirect('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email ou senha inválidos.'
        ]);
    }

    // CADASTRAR ALUNO
    public function register(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:alunos,email',
            'senha' => 'required|min:6|confirmed'
        ]);

        Aluno::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'senha' => Hash::make($request->senha),
        ]);

        return redirect('/login')->with('success', 'Conta criada com sucesso!');
    }

    // LOGOUT
    public function logout()
    {
        Auth::guard('web')->logout();
        Auth::guard('instrutor')->logout();
        return redirect('/login');
    }
}