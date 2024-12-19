<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;

    protected $fillable = ['nome','telefone','email','endereco', 'foto'];

    protected $table = "tutores";

    public function pets()
    {
           return $this->hasMany(Pet::class);
    }
}
