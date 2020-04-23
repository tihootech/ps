<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Base;
use App\Trophy;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
		$bases = Base::all();
		$trophies = Trophy::all();
		$bases []= new Base;
		$trophies []= new Trophy;
    	return view('app.settings.edit', compact('bases', 'trophies'));
    }

	public function modify(Request $request)
	{
		$data = prepare_multiple($request->all());
		$request->class::truncate();
		$request->class::insert($data);
		return back()->withMessage('Success!');
	}
}
