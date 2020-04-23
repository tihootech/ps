<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trophy extends Model
{
    public function awards()
    {
    	return $this->hasMany(Award::class);
    }
}
