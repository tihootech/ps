<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    public static function make($star_id, $amount, $type)
    {
        if ($amount) {
            $now = now();
    		$point = new self;
    		$point->star_id = $star_id;
    		$point->amount = $amount;
    		$point->type = $type;
    		$point->month = $now->month;
    		$point->year = $now->year;
    		$point->save();
        }
    }
}
