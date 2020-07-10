<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Base;

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
    	return $this->hasMany(Award::class)->whereIn('trophy_id', $ids)->orderBy('year')->orderBy('month');
    }

    public function bawards()
    {
        $ids = Trophy::whereType('beauty')->pluck('id')->toArray();
    	return $this->hasMany(Award::class)->whereIn('trophy_id', $ids)->orderBy('year')->orderBy('month');
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
        return $this->hasMany(Point::class);
    }

    public function latest_points($n=25)
    {
        return $this->hasMany(Point::class)->latest()->take($n);
    }

    public function points_percents()
    {
        $bases = Base::all();
        $total = Point::where('star_id', $this->id)->sum('amount');
        foreach ($bases as $base) {
             $sum = Point::where('star_id', $this->id)->whereType($base->type)->sum('amount');
             $percents[$base->type] = [
                 'amount' => $sum,
                 'percent' => round(($sum * 100) / $total)
             ];
        }
        return $percents;
    }

    public function rank($type, $year=null, $month=null)
    {
        $tops = [];
        $now = now();
        $year =$year ?? $now->year;
        $month =$month ?? $now->month;

        if ($type=='month') {
            $tops = Point::tops($year, mn($month))->toArray();
        }
        if ($type=='general') {
            $tops = Point::topGeneral($year, $month)->toArray();
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
			$type = 'kid';
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
