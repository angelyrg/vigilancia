<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    public function visitantes(){
        return $this->hasMany(Visitor::class);
    }
}
