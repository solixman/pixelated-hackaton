<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hackatone extends Model
{
    protected $fillable=[
        'title',
        'dateDebut',
        'dateFin',
        'theme',
        'regles',
    ];

    public function equipes(){
        return $this->hasmany(Equipe::class);
    }
}
