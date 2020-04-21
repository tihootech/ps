<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Star extends Model
{
    protected $appends = ['age'];

    public function getAgeAttribute($value='')
    {
        return $this->birthday ? 2 : null;
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
