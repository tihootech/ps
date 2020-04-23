<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    protected $appends = ['title', 'type'];

    public function getTitleAttribute()
    {
        return $this->trophy->title ?? null;
    }

    public function getTypeAttribute()
    {
        return $this->trophy->type ?? null;
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
