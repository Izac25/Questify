<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comportamento extends Model
{
    use HasFactory;

    protected $table = 'comportamentos';
    protected $primaryKey = 'id_comportamento';
    public $timestamps = false;

    protected $fillable = [
        'fk_id_aluno',
        'fk_id_instrutor',
        'motivo',
        'motivo_livre',
        'pontos',
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class, 'fk_id_aluno', 'id_aluno');
    }

    public function instrutor()
    {
        return $this->belongsTo(Instrutor::class, 'fk_id_instrutor', 'id_instrutor');
    }
}