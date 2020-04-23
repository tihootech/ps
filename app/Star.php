<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Star extends Model
{
    protected $guarded = ['id'];
    protected $appends = ['age'];
    protected $dates = ['birthday'];

    public function getAgeAttribute()
    {
        return $this->birthday ? Carbon::parse($this->birthday)->age : null;
    }

    public function awards()
    {
    	return $this->hasMany(Award::class)->orderBy('year')->orderBy('month');
    }

    public function gawards()
    {
        $ids = Trophy::whereType('gaward')->pluck('id')->toArray();
    	return $this->hasMany(Award::class)->whereIn('id', $ids)->orderBy('year')->orderBy('month');
    }

    public function bawards()
    {
        $ids = Trophy::whereType('beauty')->pluck('id')->toArray();
    	return $this->hasMany(Award::class)->whereIn('id', $ids)->orderBy('year')->orderBy('month');
    }

    public function profile()
    {
        return $this->hasOne(Image::class)->where('type', 'profile');
    }

    public function cover()
    {
        return $this->hasOne(Image::class)->where('type', 'cover');
    }

    public function images()
    {
        return $this->hasMany(Image::class)->orderBy('type');
    }

    public function points()
    {
        return $this->hasMany(Point::class)->latest()->limit(15);
    }

    public function rank($type, $year=null)
    {
        $tops = [];
        $now = now();
        $year =$year ?? $now->year;

        if ($type=='month') {
            $tops = Point::tops($year, mn($now->month))->toArray();
        }
        if ($type=='year') {
            $tops = Point::tops($year)->toArray();
        }
        $key = array_search($this->id, array_column($tops, 'id'));
        return $key+1;
    }

    public function younger_than_me()
    {
        $mine = Carbon::create('1994-10-28');
        return $this->birthday > $mine;
    }

    public function assignPoints($parts)
    {
		$sum = 0;
    	if (is_array($parts->points)) {
    		$type = request('points_type') ?? 'regular';
			$base_instance = Base::whereType($type)->first();
			$base = $base_instance->quantitiy ?? 1;
			foreach ($parts->points as $amount) {
				$sum += $amount * $base;
				Point::make($this->id, $amount * $base, $type);
			}
    	}
    	if (is_array($parts->clothes)) {
			$type = 'cloth';
			$base_instance = Base::whereType($type)->first();
			$base = $base_instance->quantitiy ?? 1;
			foreach ($parts->clothes as $amount) {
				$sum += $amount * $base;
				Point::make($this->id, $amount * $base, $type);
			}
    	}
    	if (is_array($parts->kids)) {
			$type = 'cloth';
			$base_instance = Base::whereType($type)->first();
			$base = $base_instance->quantitiy ?? 1;
			foreach ($parts->kids as $amount) {
				$sum += $amount * $base;
				Point::make($this->id, $amount * $base, $type);
			}
    	}
		return $sum;
    }
}
