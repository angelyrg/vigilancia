<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public function vigilante(){
        return $this->belongsTo(User::class);
    }
}
