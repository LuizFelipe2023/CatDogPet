<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamento_Servico extends Model
{
    use HasFactory;

    protected $fillable = ['agendamento_id', 'servico_id', 'duracao'];

    public function agendamento()
    {
           return $this->belongsTo(Agendamento::class);
    }

    public function servico()
    {
        return $this->belongsTo(Servico::class);
    }
}
