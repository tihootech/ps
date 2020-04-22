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
