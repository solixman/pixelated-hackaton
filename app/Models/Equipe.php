<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    protected $fillable=[
      'name',
    ];

    public function users(){
        return $this->belongsToMany(User::class); 
    }
    public function projet(){
        return $this->hasOne(Projet::class);
    }
    public function hackatone(){
        return $this->belongsTo(Projet::class);
    }


}
