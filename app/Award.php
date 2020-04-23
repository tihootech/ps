<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    protected $appends = ['title', 'gaward'];

    public function getTitleAttribute()
    {
        return $this->trophy->title ?? null;
    }

    public function getGawardAttribute()
    {
        return $this->trophy->gaward ?? null;
    }

    public function trophy()
    {
    	return $this->belongsTo(Trophy::class);
    }

    public function star()
    {
    	return $this->belongsTo(Star::class);
    }
}
