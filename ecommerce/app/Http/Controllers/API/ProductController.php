<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductByIdResource;
use App\Http\Resources\ProductResource;
use App\Product;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = QueryBuilder::for(Product::class)
            ->allowedFilters('name_en', 'name_ar', 'category_id', 'colors', 'sizes', 'discount', AllowedFilter::scope('price'))
            ->paginate(10);
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ProductResource::make(Product::find($id));
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
        //
    }

    public function productsByCategory($id)
    {
        return ProductResource::collection(Product::where('category_id', $id)->paginate(10));
    }

    public function latestProducts()
    {
        return Product::orderBy('created_at', 'desc')->take(6)->get();
    }

    public function ratedProducts()
    {
        $ratedProducts = Product::withCount('orderproductsR')->orderBy('orderproducts_r_count', 'desc')->take(6)->get();
        if ($ratedProducts->count() == 0) {
            $ratedProducts = Product::all()->random(6);
        }
        return $ratedProducts;
    }
}
