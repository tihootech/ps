<?php

namespace App\Http\Controllers;

use App\Star;
use Illuminate\Http\Request;

class StarController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $stars = Star::query();
        $stars = $stars->withCount('awards');

        if ($order = $request->order) {
            if ($order == 'tallest') {
                $stars = $stars->orderBy('height', 'DESC');
            }elseif ($order == 'youngest') {
                $stars = $stars->orderBy('birthday', 'DESC');
            }elseif ($order == 'oldest') {
                $stars = $stars->orderBy('birthday');
            }elseif($order == 'country'){
                $stars = $stars->where('country', '!=', 'United States')->orderBy('country');
            }else {
                $stars = $stars->orderBy($order, 'DESC');
            }
        }
        $stars = $stars->get();
        return view('app.stars.index', compact('stars'));
    }

    public function show(Star $star)
    {
        return view('app.stars.show', compact('star'));
    }

    public function edit(Star $star)
    {
        return view('app.stars.edit', compact('star'));
    }

    public function update(Request $request, Star $star)
    {
        $data = $request->validate([
            'name' => "required|unique:stars,name,$star->id",
            'country' => 'nullable|string',
            'height' => 'nullable|integer',
            'birthday' => 'nullable|date',
            'color' => 'nullable|string',
            'size' => 'nullable|string',
            'boobs' => 'nullable|string',
        ]);
        $star->update($data);
        return redirect()->route('star.index')->withMessage('Star Updated Successfuly');
    }

    public function destroy(Star $star)
    {
        $star->delete();
        return back()->withMessage("ONLY STAR RECORD WAS DELETED! NOTHING ELSE, ID=$star->id");
    }
}
