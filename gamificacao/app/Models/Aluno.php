<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Aluno extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'alunos';
    protected $primaryKey = 'id_aluno';
    public $timestamps = false;

    protected $fillable = [
        'nome',
        'email',
        'senha',
        'turno',
        'fk_id_turma',
        'pontos',
        'pontos_comportamento',
        'frequencia',
        'foto'
    ];

    protected $hidden = [
        'senha'
    ];

    public function getAuthPassword()
    {
        return $this->senha;
    }

    public function turma()
    {
        return $this->belongsTo(Turma::class, 'fk_id_turma', 'id_turma');
    }
}