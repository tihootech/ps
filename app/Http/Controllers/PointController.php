<?php

namespace App\Http\Controllers;

use App\Point;
use App\Base;
use Illuminate\Http\Request;

class PointController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $points = Point::query();
        if ($request->type) {
            $points = $points->where('type', $request->type);
        }
        if ($request->star) {
            $points = $points->where('star_id', $request->star);
        }
        if ($request->order && $request->order != 'latest') {
            $points = $points->orderBy('amount', 'DESC');
        }else {
            $points = $points->latest();
        }
        $points = $points->paginate(50);
        $bases = Base::all();
        return view('app.points.index', compact('points', 'bases'));
    }

    public function edit(Point $point)
    {
        $bases = Base::all();
        return view('app.points.edit', compact('point', 'bases'));
    }

    public function update(Request $request, Point $point)
    {
        $data = $request->validate([
            'amount' => "required|integer",
            'type' => 'required|exists:bases,type',
            'month' => "required|integer",
            'year' => "required|integer",
        ]);
        $point->update($data);
        return redirect()->route('point.index')->withMessage('Point Updated Successfuly');
    }

    public function destroy(Point $point)
    {
        $point->delete();
        return back()->withMessage('Point Deleted');
    }
}
