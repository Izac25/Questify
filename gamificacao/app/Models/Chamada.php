<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chamada extends Model
{
    use HasFactory;

    protected $table = 'chamadas';
    protected $primaryKey = 'id_chamada';
    public $timestamps = false;

    protected $fillable = [
        'fk_id_aluno',
        'fk_id_instrutor',
        'fk_id_turma',
        'data',
        'presente',
    ];

    protected $casts = [
        'data' => 'date',
        'presente' => 'boolean',
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class, 'fk_id_aluno', 'id_aluno');
    }

    public function instrutor()
    {
        return $this->belongsTo(Instrutor::class, 'fk_id_instrutor', 'id_instrutor');
    }

    public function turma()
    {
        return $this->belongsTo(Turma::class, 'fk_id_turma', 'id_turma');
    }
}