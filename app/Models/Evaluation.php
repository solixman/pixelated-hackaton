<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable=[
        'commnent',
        'score',
        
    ];

    public function evaluateur(){
        return $this->belongsTo(User::class);
    }
    
    public function projet(){
        return $this->belongsto(Projet::class);
    }
    
}
