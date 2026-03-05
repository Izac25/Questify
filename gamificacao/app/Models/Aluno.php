<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aluno extends Authenticatable
{
    use HasFactory;

    protected $table = 'alunos';
    protected $primaryKey = 'id_aluno';
    public $timestamps = false;

    protected $fillable = [
        'nome',
        'email',
        'senha'
    ];

    protected $hidden = [
        'senha'
    ];

    public function getAuthPassword()
    {
        return $this->senha;
    }
}