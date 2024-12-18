<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = ['nome','raca','porte','peso','altura','tutor_id', 'foto_perfil'];

    public function tutor()
    {
           return $this->belongsTo(Tutor::class,'tutor_id','id');
    }

    
}
