<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/home';

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }


    protected function resetPassword($user, $password)
    {
        // O Laravel passa o objeto do seu Model User aqui
        $user->senha = \Hash::make($password);

        // Agora que o User estende Authenticatable, este método EXISTE
        $user->setRememberToken(\Str::random(60));

        $user->save();

        event(new \Illuminate\Auth\Events\PasswordReset($user));

        $this->guard()->login($user);
    }
    /**
     * Regras de validação (usando seu campo 'senha')
     */
    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'senha' => 'required|confirmed|min:8',
        ];
    }

    /**
     * Mapeia os dados do formulário para a lógica do Laravel
     */
    protected function credentials(Request $request)
    {
        return $request->only(
            'email',
            'senha',
            'senha_confirmation',
            'token'
        );
    }
}
