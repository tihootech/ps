<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Star;
Use App\Point;
Use App\Base;

class QuickActionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function quick_add(Request $request)
    {
    	$request->validate([
			'star' => 'required|string|unique:stars,name'
		]);
		$star = new Star;
		$star->name = $request->star;
		$star->year = now()->year;
		$star->save();
		return back()->withMessage("Star Added Successfully : <b>$star->name</b>");
    }

    public function quick_plus(Request $request)
    {
		// declare needed arrays
		$stars = $inputs = $empties = $duplicates = $corrects = $errors = $messages = [];

		// check for duplicates & empties
		foreach ($request->strings as $query) {
    		if ($query) {
				$parts = bq($query);
				$inputs []= $parts;
				foreach ($parts->stars as $star_name) {
					$list = Star::where('name', 'like', "%$star_name%")->get();
					if (count($list) == 0) {
						$empties []= $star_name;
					}elseif (count($list) > 1) {
						$duplicates []= $star_name;
					}else {
						$corrects []= $star_name;
					}
				}
    		}

			$messages []= $query;
    	}

		// check for errors
		$errors = [];
		if (count($empties)) {
			$errors []= "Nothing Found For : " . implode(',', $empties);
		}
		if (count($duplicates)) {
			$errors []= "Duplicates For : " . implode(',', $duplicates);
		}
		if (count($errors)) {
			return back()->withErrors($errors)->withInput();
		}

		// assign points
		foreach ($inputs as $parts) {
			foreach ($parts->stars as $star_name) {
				$stars []= $star = Star::where('name', 'like', "%$star_name%")->firstOrFail();
				$sum = $star->assignPoints($parts);

				// create output message
				$messages []= "<b>".nf($sum)."</b>"." Points added for $star->name";
			}
		}

		return back()->withMessages($messages)->withPointsType($request->points_type)->withStars($stars);
    }

    public function quick_master(Request $request)
    {
		$request->validate([
			'star' => 'required|string|exists:stars,name',
			'degree' => 'required|integer',
		]);

		// check for base point
    	$base = Base::whereType('master')->first();
		if (!$base) {
			return back()->withError('Base Point Not Found!');
		}

		// make point and return
		$star = Star::whereName($request->star)->first();
		$amount = $base->quantitiy * $request->degree;
		Point::make($star->id, $amount, 'master');
		return back()->withMessage("Master assigned to $star->name and amount is ". nf($amount));
    }

    public function quick_kid(Request $request)
    {
		$request->validate([
			'star' => 'required|string|exists:stars,name',
			'degrees' => 'required',
		]);

		// check for base point
    	$base = Base::whereType('kid')->first();
		if (!$base) {
			return back()->withError('Base Point Not Found!');
		}

		// make point and return
		$star = Star::whereName($request->star)->first();
		$degrees = explode('+', $request->degrees);
		$sum = 0;
		foreach ($degrees as $degree) {
			$sum += $amount = $base->quantitiy * $degree;
			Point::make($star->id, $amount, 'kid');
		}
		return back()->withMessage("Kid Points assigned to $star->name and amount is ". nf($sum));
    }

}
