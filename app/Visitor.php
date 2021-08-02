<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    public function oficina(){
        return $this->belongsTo(Office::class);
    }
}
