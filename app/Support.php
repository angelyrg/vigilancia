<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    public function vigilante(){
        return $this->belongsTo(User::class);
    }
}
