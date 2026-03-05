<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atividade extends Model
{
    use HasFactory;

    protected $table = 'atividades';
    protected $primaryKey = 'id_atividade';
    public $timestamps = false;

    protected $fillable = [
        'fk_id_instrutor',
        'titulo',
        'descricao',
        'pontos',
        'turno',
        'data_limite',
    ];

    public function instrutor()
    {
        return $this->belongsTo(Instrutor::class, 'fk_id_instrutor', 'id_instrutor');
    }

    public function entregas()
    {
        return $this->hasMany(Entrega::class, 'fk_id_atividade', 'id_atividade');
    }
}