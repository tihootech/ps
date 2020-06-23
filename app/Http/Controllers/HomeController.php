<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Star;
use App\Setting;
use Carbon\Carbon;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // search
        if ($request->search) {
            $stars = Star::where('name', 'like', "%$request->search%")->get();
            return redirect()->route('home')->withStars($stars);
        }

        // strings from old inputs
        $strings = old('strings') ?? [''];

        // check for birthdays
        $birthdays = [];
        foreach (Star::all() as $star) {
            $time = strtotime($star->birthday);
            if(date('m-d') == date('m-d', $time)){
                $birthdays []= $star;
            }
        }

        // recently added stars
        $recent_stars = Star::latest()->take(5)->get();

        // return view
        return view('home', compact('strings', 'birthdays', 'recent_stars'));
    }

    public function update_settings(Request $request)
    {
        $settings = Setting::first();
        $settings->notepad = $request->notepad;
        $settings->save();
        return back()->withMessage('Settings Updated');
    }
}
