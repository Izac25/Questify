<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    use HasFactory;

    protected $table = 'turmas';
    protected $primaryKey = 'id_turma';
    public $timestamps = false;

    protected $fillable = [
        'fk_id_instrutor',
        'nome',
        'sala',
        'turno'
    ];

    // Turma pertence a um Instrutor
    public function instrutor()
    {
        return $this->belongsTo(Instrutor::class, 'fk_id_instrutor', 'id_instrutor');
    }

    // Turma tem muitos Alunos
    public function alunos()
    {
        return $this->hasMany(Aluno::class, 'fk_id_turma', 'id_turma');
    }
}