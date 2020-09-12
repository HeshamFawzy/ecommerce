<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Color;
use App\Discount;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProduct;
use App\Image;
use App\Product;
use App\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('categoryR')->paginate(10);
        return view('admin.products.index', compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $colors = Color::all();
        $sizes = Size::all();
        $categories = Category::all();
        return view('admin.products.create', compact(['colors', 'sizes', 'categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProduct $request)
    {
        $image = $request->file('image');
        $imageExtension = $image->getClientOriginalExtension();
        Storage::disk('public/products/images')->put($image->getFilename() . "." . $imageExtension, File::get($image));

        $alterImage = $request->file('alterImage');
        $alterImageExtension = $alterImage->getClientOriginalExtension();
        Storage::disk('public/products/alterImages')->put($alterImage->getFilename() . "." . $alterImageExtension, File::get($alterImage));

        $product = Product::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'description' => $request->description,
            'category_id' => $request->category,
            "image_mime" => $image->getClientMimeType(),
            "image_original_filename" => $image->getClientOriginalName(),
            "image_filename" => $image->getFilename() . "." . $imageExtension,
            "alter_image_mime" => $alterImage->getClientMimeType(),
            "alter_image_original_filename" => $alterImage->getClientOriginalName(),
            "alter_image_filename" => $alterImage->getFilename() . "." . $alterImageExtension,
            'colors' => $request->colors,
            'sizes' => $request->sizes,
            'price' => $request->price,
            'discount' => $request->discount,
        ]);

        if ($request->discount == "1") {
            $discount = Discount::create([
                'end_date' => $request->end_date,
                'amount' => $request->amount,
                'type' => $request->discountType,
                'product_id' => $product->id,
            ]);
        }

        foreach ($request->colorImage as $key => $colorImage) {
            $colorImg = $request->colorImage[$key];
            $colorImgExtension = $colorImg->getClientOriginalExtension();
            Storage::disk('public/products/colorImages')->put($colorImg->getFilename() . "." . $colorImgExtension, File::get($colorImg));
            $colorAlterImg = $request->colorAlterImage[$key];
            $colorAlterImgExtension = $colorAlterImg->getClientOriginalExtension();
            Storage::disk('public/products/colorAlterImages')->put($colorAlterImg->getFilename() . "." . $colorAlterImgExtension, File::get($colorAlterImg));

            Image::create([
                'product_id' => $product->id,
                'color' => $request->colors[$key],
                "image_mime" => $colorImg->getClientMimeType(),
                "image_original_filename" => $colorImg->getClientOriginalName(),
                "image_filename" => $colorImg->getFilename() . "." . $colorImgExtension,
                "alter_image_mime" => $colorAlterImg->getClientMimeType(),
                "alter_image_original_filename" => $colorAlterImg->getClientOriginalName(),
                "alter_image_filename" => $colorAlterImg->getFilename() . "." . $colorAlterImgExtension,
            ]);
        }

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with(['categoryR', 'discountR', 'ImagesR'])->find($id);
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::with(['categoryR', 'discountR', 'ImagesR'])->find($id);
        $colors = Color::all();
        $sizes = Size::all();
        $categories = Category::all();
        return view('admin.products.edit', compact(['product', 'colors', 'sizes', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'description' => $request->description,
            'category_id' => $request->category,
            'colors' => $request->colors,
            'sizes' => $request->sizes,
            'price' => $request->price,
            'discount' => $request->discount,
        ]);

        if ($request->hasFile('image') && $request->hasFile('alterImage')) {

            File::delete('products/images/' . $product->image_filename);
            File::delete('products/alterImages/' . $product->alter_image_filename);
            $image = $request->file('image');
            $imageExtension = $image->getClientOriginalExtension();
            Storage::disk('public/products/images')->put($image->getFilename() . "." . $imageExtension, File::get($image));

            $alterImage = $request->file('alterImage');
            $alterImageExtension = $alterImage->getClientOriginalExtension();
            Storage::disk('public/products/alterImages')->put($alterImage->getFilename() . "." . $alterImageExtension, File::get($alterImage));

            $product->update([
                "image_mime" => $image->getClientMimeType(),
                "image_original_filename" => $image->getClientOriginalName(),
                "image_filename" => $image->getFilename() . "." . $imageExtension,
                "alter_image_mime" => $alterImage->getClientMimeType(),
                "alter_image_original_filename" => $alterImage->getClientOriginalName(),
                "alter_image_filename" => $alterImage->getFilename() . "." . $alterImageExtension,
            ]);
        } elseif ($request->hasFile('image')) {
            File::delete('products/images/' . $product->image_filename);

            $image = $request->file('image');
            $imageExtension = $image->getClientOriginalExtension();
            Storage::disk('public/products/images')->put($image->getFilename() . "." . $imageExtension, File::get($image));

            $product->update([
                "image_mime" => $image->getClientMimeType(),
                "image_original_filename" => $image->getClientOriginalName(),
                "image_filename" => $image->getFilename() . "." . $imageExtension,
            ]);

        } elseif ($request->hasFile('alterImage')) {
            File::delete('products/alterImages/' . $product->alter_image_filename);

            $alterImage = $request->file('alterImage');
            $alterImageExtension = $alterImage->getClientOriginalExtension();
            Storage::disk('public/products/alterImages')->put($alterImage->getFilename() . "." . $alterImageExtension, File::get($alterImage));

            $product->update([
                "alter_image_mime" => $alterImage->getClientMimeType(),
                "alter_image_original_filename" => $alterImage->getClientOriginalName(),
                "alter_image_filename" => $alterImage->getFilename() . "." . $alterImageExtension,
            ]);
        }

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $images = Image::where('product_id', $id)->get();
        $product->delete();
        File::delete('products/images/' . $product->image_filename);
        File::delete('products/alterImages/' . $product->alter_image_filename);
        foreach ($images as $image) {
            File::delete('products/colorImages/' . $image->image_filename);
            File::delete('products/colorAlterImages/' . $image->alter_image_filename);
        }
        return redirect()->route('products.index');
    }
}
