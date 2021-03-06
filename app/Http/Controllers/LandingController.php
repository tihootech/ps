<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Star;
use App\Point;
use App\Award;
use App\Trophy;

class LandingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function results($year=null, Request $request)
    {
		// find year and month
		$now = now();
		$year = $year ?? $now->year;
		$active_month = $request->order ?? mn($now->month);

        $results = Point::tops($year, $active_month);

    	return view('app.landing.results', compact('year', 'results', 'active_month'));
    }

    public function prixes($year=null, Request $request)
    {
		// find year and month
		$now = now();
		$year = $year ?? $now->year;
        $prixes = $tracks = [];

        for ($i=1; $i <= 12 ; $i++) {
            $prixes []= Point::topsIn($year, $i);
            if ($year != $now->year || $i <= $now->month) {
                $tracks []= Point::topGeneral($year, $i, 10);
            }
        }

        $list = ['Golden Prix', 'Silver Prix', 'Bronze Prix', 'Position'];
        $trophies = Trophy::whereIn('title', $list)->pluck('id', 'title')->toArray();
        $stars = Star::all();
        $grands = [];
        foreach ($stars as $star) {
            $awards_won = Award::where('year', $year)->whereIn('trophy_id', $trophies)->where('star_id', $star->id)->count();
            if ($awards_won) {
                foreach ($trophies as $title => $tid) {
                    $count = Award::where('year', $year)->where('trophy_id', $tid)->where('star_id', $star->id)->count();
                    $grands[$star->name][$title] = $count;
                }
            }
        }

        uasort($grands, function($a, $b) {
            $retval = $b['Golden Prix'] <=> $a['Golden Prix'];
            if ($retval == 0) {
                $retval = $b['Silver Prix'] <=> $a['Silver Prix'];
                if ($retval == 0) {
                    $retval = $b['Bronze Prix'] <=> $a['Bronze Prix'];
                    if ($retval == 0) {
                        $retval = $b['Position'] <=> $a['Position'];
                    }
                }
            }
            return $retval;
        });

    	return view('app.landing.prixes', compact('year', 'prixes', 'tracks', 'grands'));
    }

    public function statics(Request $request)
    {
        $count = $request->count ?? 40;
        $tops = Point::topsOfAllTime($count);
        $tops_ids = $tops->pluck('id')->toArray();
        $others_points = Point::whereNotIn('star_id', $tops_ids)->sum('amount');

        $body_types = Star::whereNotNull('size')->select('size')->distinct()->get()->pluck('size')->toArray();
        $color_types = Star::whereNotNull('color')->select('color')->distinct()->get()->pluck('color')->toArray();

        foreach ($body_types as $body_type) {
            $star_ids = Star::whereSize($body_type)->get()->pluck('id')->toArray();
            $sum = Point::whereIn('star_id', $star_ids)->sum('amount');
            $teams[$body_type] = ['sum' => $sum, 'count' => count($star_ids)];
        }

        foreach ($color_types as $color_type) {
            $star_ids = Star::whereColor($color_type)->get()->pluck('id')->toArray();
            $sum = Point::whereIn('star_id', $star_ids)->sum('amount');
            $colors[$color_type] = ['sum' => $sum, 'count' => count($star_ids)];
        }

        return view('app.landing.statics', compact('tops', 'count', 'others_points', 'teams', 'colors'));
    }
}
