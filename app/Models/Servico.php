<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    use HasFactory;

    protected $fillable = ["nome", "descricao", "valor_base"];

    public function agendamentos()
    {
        return $this->belongsToMany(Agendamento::class, 'agendamento_servico')
                    ->withPivot('duracao')  
                    ->withTimestamps();     
    }
}
