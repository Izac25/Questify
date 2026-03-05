<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{
    // Perfil do aluno
    public function edit()
    {
        $aluno = Auth::guard('web')->user();
        return view('perfil.edit', compact('aluno'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'senha' => 'nullable|min:6|confirmed',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $aluno = \App\Models\Aluno::findOrFail(Auth::guard('web')->user()->id_aluno);
        $dados = ['nome' => $request->nome];

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('fotos', 'public');
            $dados['foto'] = $fotoPath;
        }

        if ($request->senha) {
            $dados['senha'] = Hash::make($request->senha);
        }

        $aluno->update($dados);
        return redirect('/dashboard')->with('success', 'Perfil atualizado com sucesso!');
    }

    // Perfil do instrutor
    public function editInstrutor()
    {
        $instrutor = Auth::guard('instrutor')->user();
        return view('perfil.edit_instrutor', compact('instrutor'));
    }

 public function updateInstrutor(Request $request)
{
    $request->validate([
        'nome' => 'required|string|max:255',
        'senha' => 'nullable|min:6|confirmed',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'turnos' => 'required|array|min:1',
        'turnos.*' => 'in:Manhã,Tarde,Noite',
    ]);

    $instrutor = \App\Models\Instrutor::findOrFail(Auth::guard('instrutor')->user()->id_instrutor);
    $dados = [
        'nome' => $request->nome,
        'turnos' => $request->turnos,
    ];

    if ($request->hasFile('foto')) {
        $fotoPath = $request->file('foto')->store('fotos', 'public');
        $dados['foto'] = $fotoPath;
    }

    if ($request->senha) {
        $dados['senha'] = Hash::make($request->senha);
    }

    $instrutor->update($dados);
    Auth::guard('instrutor')->setUser($instrutor->fresh());

    return redirect('/dashboard')->with('success', 'Perfil atualizado com sucesso!');
}
}