<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
    use HasFactory;

    protected $table = 'entregas';
    protected $primaryKey = 'id_entrega';
    public $timestamps = false;

    protected $fillable = [
        'fk_id_atividade',
        'fk_id_aluno',
        'status',
        'presenca',
    ];

    public function atividade()
    {
        return $this->belongsTo(Atividade::class, 'fk_id_atividade', 'id_atividade');
    }

    public function aluno()
    {
        return $this->belongsTo(Aluno::class, 'fk_id_aluno', 'id_aluno');
    }
}