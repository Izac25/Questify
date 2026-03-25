<?php

namespace App\Models;

// IMPORTANTE: Use o Authenticatable
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    //protected $table = 'users'; // Nome da sua tabela, se não for 'users'

    protected $fillable = [
        'name',
        'email',
        'senha', // Seu campo personalizado
        'role'
    ];

    protected $hidden = [
        'senha',
        'remember_token',
    ];

    
    public function getAuthPassword()
    {
        return $this->senha;
    }
}