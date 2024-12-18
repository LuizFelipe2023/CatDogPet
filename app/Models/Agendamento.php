<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    use HasFactory;

    protected $fillable = ["inicio", "fim","pet_id", "tutor_id", "status", "preco_final"];

    public function servicos()
    {
        return $this->belongsToMany(Servico::class, 'agendamento_servico')
                    ->withPivot('duracao') 
                    ->withTimestamps();    
    }
}
