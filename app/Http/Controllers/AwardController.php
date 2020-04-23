<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Award;
use App\Trophy;
use App\Star;

class AwardController extends Controller
{

	public function index(Request $request)
    {
        $awards = Award::query();
        if ($request->star) {
            $awards = $awards->where('star_id', $request->star);
        }
        $awards = $awards->latest()->paginate(25);
        return view('app.awards.index', compact('awards'));
    }

    public function assign_form(Star $star)
    {
		$trophies = Trophy::all();
    	return view('app.awards.assign', compact('star', 'trophies'));
    }

    public function assign(Request $request)
    {
		$request->validate([
			'star.*' => 'required|exists:stars,name',
			'trophy.*' => 'required|exists:trophies,id',
			'month.*' => 'required|integer|between:1,12',
			'year.*' => 'required|integer|digits:4',
		]);

		for ($i=0; $i < count($request->star) ; $i++) {

			$star = Star::whereName($request->star[$i])->first();

			$award = new Award;
			$award->star_id = $star->id;
			$award->trophy_id = $request->trophy[$i];
			$award->month = $request->month[$i];
			$award->year = $request->year[$i];
			$award->save();

		}

		return back()->withMessage("Trophies Assigned");
    }

    public function destroy(Award $award)
    {
		$award->delete();
		return back()->withMessage('Award deleted.');
    }
}
