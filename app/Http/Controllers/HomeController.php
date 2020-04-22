<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Star;

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

        // return view
        return view('home', compact('strings', 'birthdays'));
    }
}
