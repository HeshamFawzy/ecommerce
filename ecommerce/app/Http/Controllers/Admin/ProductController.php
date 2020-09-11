<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Color;
use App\Discount;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProduct;
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
        $extension = $image->getClientOriginalExtension();
        Storage::disk('public/products')->put($image->getFilename() . "." . $extension, File::get($image));

        $alterImage = $request->file('alterImage');
        $extension = $alterImage->getClientOriginalExtension();
        Storage::disk('public/alterImages')->put($alterImage->getFilename() . "." . $extension, File::get($alterImage));

        $product = Product::create([
            'name_en' => $request->input('name_en'),
            'name_ar' => $request->input('name_ar'),
            'category_id' => $request->category,
            "image_mime" => $image->getClientMimeType(),
            "image_original_filename" => $image->getClientOriginalName(),
            "image_filename" => $image->getFilename() . "." . $extension,
            "alter_image_mime" => $alterImage->getClientMimeType(),
            "alter_image_original_filename" => $alterImage->getClientOriginalName(),
            "alter_image_filename" => $alterImage->getFilename() . "." . $extension,
            'colors' => $request->colors,
            'sizes' => $request->sizes,
            'price' => $request->input('price'),
            'discount' => $request->input('discount'),
        ]);

        if ($request->input('discount') == "1") {
            $discount = Discount::create([
                'end_date' => $request->end_date,
                'amount' => $request->amount,
                'type' => $request->discountType,
                'product_id' => $product->id,
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
        $product = Product::with(['categoryR', 'discountR'])->find($id);
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
        //
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
        //
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
        $product->delete();
        File::delete('products/images/' . $product->image_filename);
        File::delete('products/alterImages/' . $product->size_filename);
        return redirect()->route('products.index');
    }
}
