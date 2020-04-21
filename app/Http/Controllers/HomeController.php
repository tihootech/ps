<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Star;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $stars = Star::where('name', 'like', "%$request->search%")->get();
            return redirect()->route('home')->withStars($stars);
        }
        $strings = old('strings') ?? [''];
        return view('home', compact('strings'));
    }
}
