<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Notification extends Model
{
    protected $fillable=[
        'contenu',
        'date'
    ];

    public function users(){
        return $this->BelongsToMany(User::class);
    } 

}
