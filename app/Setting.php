<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $guarded = ['id'];

    public function watchListAsArray()
    {
        return explode(',', $this->watch_list);
    }
}
