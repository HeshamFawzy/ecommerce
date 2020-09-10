<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategory;
use App\Http\Requests\UpdateCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategory $request)
    {
        $image = $request->file('image');
        $extension = $image->getClientOriginalExtension();
        Storage::disk('public/categories')->put($image->getFilename() . "." . $extension, File::get($image));

        $sizeImage = $request->file('sizeImage');
        $extension = $image->getClientOriginalExtension();
        Storage::disk('public/sizeImages')->put($sizeImage->getFilename() . "." . $extension, File::get($sizeImage));

        $category = Category::create([
            'name_en' => $request->input('name_en'),
            'name_ar' => $request->input('name_ar'),
            "image_mime" => $image->getClientMimeType(),
            "image_original_filename" => $image->getClientOriginalName(),
            "image_filename" => $image->getFilename() . "." . $extension,
            "size_mime" => $sizeImage->getClientMimeType(),
            "size_original_filename" => $sizeImage->getClientOriginalName(),
            "size_filename" => $sizeImage->getFilename() . "." . $extension,
        ]);

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategory $request, $id)
    {
        $category = Category::find($id);
        $category->update([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
        ]);
        if ($request->hasFile('image') && $request->hasFile('sizeImage')) {

            File::delete('categories/images/' . $category->image_filename);
            File::delete('categories/sizeImages/' . $category->size_filename);
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            Storage::disk('public/categories')->put($image->getFilename() . "." . $extension, File::get($image));

            $sizeImage = $request->file('sizeImage');
            $extension = $image->getClientOriginalExtension();
            Storage::disk('public/sizeImages')->put($sizeImage->getFilename() . "." . $extension, File::get($sizeImage));

            $category->update([
                "image_mime" => $image->getClientMimeType(),
                "image_original_filename" => $image->getClientOriginalName(),
                "image_filename" => $image->getFilename() . "." . $extension,
                "size_mime" => $sizeImage->getClientMimeType(),
                "size_original_filename" => $sizeImage->getClientOriginalName(),
                "size_filename" => $sizeImage->getFilename() . "." . $extension,
            ]);
        } elseif ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            Storage::disk('public/categories')->put($image->getFilename() . "." . $extension, File::get($image));

            $category->update([
                "image_mime" => $image->getClientMimeType(),
                "image_original_filename" => $image->getClientOriginalName(),
                "image_filename" => $image->getFilename() . "." . $extension,
            ]);

        } elseif ($request->hasFile('sizeImage')) {
            $sizeImage = $request->file('sizeImage');
            $extension = $sizeImage->getClientOriginalExtension();
            Storage::disk('public/sizeImages')->put($sizeImage->getFilename() . "." . $extension, File::get($sizeImage));

            $category->update([
                "size_mime" => $sizeImage->getClientMimeType(),
                "size_original_filename" => $sizeImage->getClientOriginalName(),
                "size_filename" => $sizeImage->getFilename() . "." . $extension,
            ]);

        }

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        File::delete('categories/images/' . $category->image_filename);
        File::delete('categories/sizeImages/' . $category->size_filename);
        return redirect()->route('categories.index');
    }
}
