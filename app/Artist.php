<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    public function comics()
    {
        return $this->belongsToMany('App\Comic');
    }
}
