<?php

namespace App\Http\Controllers;

use App\Star;
use Illuminate\Http\Request;

class StarController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Star $star)
    {
        //
    }

    public function edit(Star $star)
    {
        //
    }

    public function update(Request $request, Star $star)
    {
        //
    }

    public function destroy(Star $star)
    {
        $star->delete();
        return back()->withMessage("ONLY STAR RECORD WAS DELETED! NOTHING ELSE, ID=$star->id");
    }
}
