<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Star;

class ImageController extends Controller
{
    public function index(Request $request)
    {
        $images = Image::query();
        if ($request->star) {
            $images = $images->where('star_id', $request->star);
        }
        $images = $images->paginate(20);
        return view('app.images.index', compact('images'));
    }

    public function upload_image_form(Star $star)
    {
    	return view('app.images.upload', compact('star'));
    }

	public function upload_image(Request $request)
	{
		$request->validate([
            'star' => 'required|exists:stars,name',
            'type' => 'required|string',
            'image' => 'required|image',
            'info' => 'nullable|string',
        ]);

        $messages = [];
        $star = Star::whereName($request->star)->first();
        $type = $request->type;
        if ($type != 'regular' && $star->$type) {
            Image::whereType($type)->where('star_id', $star->id)->delete();
            delete_file($star->$type->path);
            $messages []= "previous $type image of $star->name deleted.";
        }

        $image = new Image;
        $image->star_id = $star->id;
        $image->type = $type;
        $image->path = upload($request->image);
        $image->info = $request->info;
        $image->save();

        $messages []= "new $type image uploaded for $star->name";
        return back()->withMessages($messages);
	}

    public function destroy(Image $image)
    {
        delete_file($image->path);
        $image->delete();

        $star_name =$image->star->name ?? 'DB Error';
        return back()->withMessage("$image->type image of $star_name deleted.");
    }
}
