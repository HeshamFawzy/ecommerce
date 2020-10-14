<?php

namespace App\Http\Controllers\Admin;

use App\About;
use App\Contact;
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
        $about = About::latest()->first();
        return view('admin.publicPages.about', compact('about'));
    }

    public function contact()
    {
        $contact = Contact::latest()->first();
        return view('admin.publicPages.contact', compact('contact'));
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
        toastr()->info('Saved Successfully', 'Save');
        return redirect()->back();
    }

    public function sliderDelete($id)
    {
        $image = Slider::find($id);
        $image->delete();
        File::delete('sliders/' . $image->image_filename);
        toastr()->error('Deleted Successfully', 'Delete');
        return redirect()->route('public.slider');
    }

    public function aboutUpload(Request $request)
    {
        $validatedData = $request->validate([
            'about_en' => 'required',
            'about_ar' => 'required',
        ]);

        About::create([
            'about_en' => $request->about_en,
            'about_ar' => $request->about_ar,
        ]);
        toastr()->info('Saved Successfully', 'Save');
        return redirect()->route('public.about');
    }

    public function contactUpload(Request $request)
    {
        $validatedData = $request->validate([
            'contact_en' => 'required',
            'contact_ar' => 'required',
        ]);

        Contact::create([
            'contact_en' => $request->contact_en,
            'contact_ar' => $request->contact_ar,
        ]);
        toastr()->info('Saved Successfully', 'Save');
        return redirect()->route('public.contact');
    }

}
