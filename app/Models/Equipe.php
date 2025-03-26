<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    protected $fillable=[
      'name',
      'status',
    ];

    public function users(){
        return $this->hasMany(User::class); 
    }
    public function projet(){
        return $this->hasOne(Projet::class);
    }
    public function hackatone(){
        return $this->belongsTo(Hackatone::class);
    }
}
