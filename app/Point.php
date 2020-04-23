<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $guarded = ['id'];

    public function star()
    {
        return $this->belongsTo(Star::class);
    }

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

    public static function top10($year,$month)
    {
        $query = "stars.id, stars.name, SUM(points.amount) as sum";
        $collection =  Star::select(\DB::raw($query))
            ->where('points.year', $year)
            ->where('month', '<=', $month)
            ->leftJoin('points', 'points.star_id', '=', 'stars.id')
            ->orderBy('sum', 'DESC')
            ->groupBy('stars.id')
            ->limit(10)
            ->get();
        return $collection;
    }

    public static function topsIn($year,$month,$limit=5)
    {
        $query = "stars.id, stars.name, SUM(points.amount) as sum";
        $collection =  Star::select(\DB::raw($query))
            ->where('points.year', $year)
            ->where('month', '=', $month)
            ->leftJoin('points', 'points.star_id', '=', 'stars.id')
            ->orderBy('sum', 'DESC')
            ->groupBy('stars.id')
            ->limit($limit)
            ->get();
        return $collection;
    }

    public static function topN($n, $year=null)
    {
        $year = $year ?? now()->year;
        $query = "stars.id, stars.name, SUM(points.amount) as sum";
        $collection =  Star::select(\DB::raw($query))
            ->where('points.year', $year)
            ->leftJoin('points', 'points.star_id', '=', 'stars.id')
            ->orderBy('sum', 'DESC')
            ->groupBy('stars.id')
            ->limit($n)
            ->get();
        return $collection;
    }

    // order is month name or sum
    public static function tops($year=null, $order='sum', $limit=null)
    {
        $year = $year ?? now()->year;

        $query = "stars.id, stars.name, SUM(points.amount) AS sum";
        for ($i=1; $i <=12 ; $i++) {
            $query .= ", (SELECT SUM(IF(points.month=$i, points.amount, 0))) AS ". mn($i);
        }

        $collection =  Star::select(\DB::raw($query))
            ->where('points.year', $year)
            ->leftJoin('points', 'points.star_id', '=', 'stars.id')
            ->orderBy($order, 'DESC')
            ->groupBy('stars.id');

        if ($limit) {
            $collection = $collection->limit($limit);
        }
        $collection = $collection->get();

        return $collection;
    }
}
