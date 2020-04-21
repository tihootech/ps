<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Base;

class SettingsController extends Controller
{
    public function edit()
    {
		$bases = Base::all();
		$bases []= new Base;
    	return view('app.settings.edit', compact('bases'));
    }

	public function modify(Request $request)
	{
		$data = prepare_multiple($request->all());
		Base::truncate();
		Base::insert($data);
		return back()->withMessage('Success!');
	}
}
