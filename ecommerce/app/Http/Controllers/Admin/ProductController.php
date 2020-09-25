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
        $colors = Color::whereIn('id', $request->colors)->select('id', 'name')->get();
        $sizes = Size::whereIn('id', $request->sizes)->select('id', 'name')->get();
        $product = Product::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'description' => $request->description,
            'category_id' => $request->category,
            'colors' => $colors,
            'sizes' => $sizes,
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
            $color = Color::where('id', $request->colors[$key])->select('id', 'name')->get();
            Image::create([
                'product_id' => $product->id,
                'color' => $color,
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
        $sizes = Size::whereIn('id', $request->sizes)->select('id', 'name')->get();
        $product->update([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'description' => $request->description,
            'category_id' => $request->category,
            'sizes' => $sizes,
            'price' => $request->price,
            'discount' => $request->discount,
        ]);
        if ($request->discount == "1") {
            $discount = Discount::where('product_id', $id)->first();
            if ($discount != null) {
                $discount->update([
                    'end_date' => $request->end_date,
                    'amount' => $request->amount,
                    'type' => $request->discountType,
                ]);
            } else {
                Discount::create([
                    'end_date' => $request->end_date,
                    'amount' => $request->amount,
                    'type' => $request->discountType,
                    'product_id' => $product->id
                ]);
            }
        }
        if ($request->hasFile('colorImage') && $request->hasFile('colorAlterImage')) {
            $images = Image::where('product_id', $product->id)->get();
            foreach ($images as $image) {
                File::delete('products/colorImages/' . $image->image_filename);
                File::delete('products/colorAlterImages/' . $image->alter_image_filename);
                $img = Image::find($image->id);
                $img->delete();
            }
            foreach ($request->colors as $key => $color) {
                $colorImg = $request->colorImage[$key];
                $colorImgExtension = $colorImg->getClientOriginalExtension();
                Storage::disk('public/products/colorImages')->put($colorImg->getFilename() . "." . $colorImgExtension, File::get($colorImg));
                $colorAlterImg = $request->colorAlterImage[$key];
                $colorAlterImgExtension = $colorAlterImg->getClientOriginalExtension();
                Storage::disk('public/products/colorAlterImages')->put($colorAlterImg->getFilename() . "." . $colorAlterImgExtension, File::get($colorAlterImg));
                $color = Color::where('id', $request->colors[$key])->select('id', 'name')->get();
                Image::create([
                    'product_id' => $product->id,
                    'color' => $color,
                    "image_mime" => $colorImg->getClientMimeType(),
                    "image_original_filename" => $colorImg->getClientOriginalName(),
                    "image_filename" => $colorImg->getFilename() . "." . $colorImgExtension,
                    "alter_image_mime" => $colorAlterImg->getClientMimeType(),
                    "alter_image_original_filename" => $colorAlterImg->getClientOriginalName(),
                    "alter_image_filename" => $colorAlterImg->getFilename() . "." . $colorAlterImgExtension,
                ]);
            }

            $colors = Color::whereIn('id', $request->colors)->select('id', 'name')->get();
            $product->update([
                'colors' => $colors,
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
    public
    function destroy($id)
    {
        $product = Product::find($id);
        $images = Image::where('product_id', $id)->get();
        $product->delete();
        foreach ($images as $image) {
            File::delete('products/colorImages/' . $image->image_filename);
            File::delete('products/colorAlterImages/' . $image->alter_image_filename);
        }
        return redirect()->route('products.index');
    }
}
