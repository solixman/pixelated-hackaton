<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    protected $fillable= [
        'name',
        'description',
        'github'
    ];
    
    public function evaluation(){
        return $this->hasOne(Evaluation::class); 
    }
    
}
