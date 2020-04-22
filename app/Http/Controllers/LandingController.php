<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Star;
use App\Point;

class LandingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function results($year=null, Request $request)
    {
		// find year
		$now = now();
		$year = $year ?? $now->year;
		$active_month = $request->order ?? mn($now->month);

        $results = Point::tops($year, $active_month);

    	return view('app.landing.results', compact('year', 'results', 'active_month'));
    }
}
