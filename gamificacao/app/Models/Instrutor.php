<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Instrutor extends Authenticatable
{
    use HasFactory;

    protected $table = 'instrutors';
    protected $primaryKey = 'id_instrutor';
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

    // Instrutor tem muitas Turmas
    public function turmas()
    {
        return $this->hasMany(Turma::class, 'fk_id_instrutor', 'id_instrutor');
    }
}