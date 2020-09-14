<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;

class PublicController extends Controller
{
    public function slider()
    {
        $images = Slider::all();
        return view('admin.publicPages.slider', compact('images'));
    }

    public function about()
    {
        return view('admin.publicPages.about');
    }

    public function contact()
    {
        return view('admin.publicPages.contact');
    }

    public function sliderUpload(Request $request)
    {
        $image = $request->file('image');
        $imageExtension = $image->getClientOriginalExtension();
        Storage::disk('public/sliders')->put($image->getFilename() . "." . $imageExtension, File::get($image));

        Slider::create([
            "image_mime" => $image->getClientMimeType(),
            "image_original_filename" => $image->getClientOriginalName(),
            "image_filename" => $image->getFilename() . "." . $imageExtension,
        ]);

        return redirect()->back();
    }

    public function sliderDelete($id)
    {
        $image = Slider::find($id);
        $image->delete();
        File::delete('sliders/' . $image->image_filename);
        return redirect()->route('public.slider');
    }

}
