<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Star;

class LandingController extends Controller
{
    public function results($year=null, Request $request)
    {
		// find year
		$now = now();
		$year = $year ?? $now->year;
		$active_month = $request->order ?? mn($now->month);

		// create results
		$query = "stars.name, SUM(points.amount) AS sum";
        for ($i=1; $i <=12 ; $i++) {
            $query .= ", (SELECT SUM(IF(points.month=$i, points.amount, 0))) AS ". mn($i);
        }
        $collection =  Star::select(\DB::raw($query))
            ->where('points.year', $year)
            ->leftJoin('points', 'points.star_id', '=', 'stars.id')
            ->orderBy($active_month, 'DESC')
            ->groupBy('stars.id');
        $results = $collection->get();

    	return view('app.landing.results', compact('year', 'results', 'active_month'));
    }
}
