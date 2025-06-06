<?php

namespace App\Http\Controllers\Products;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        return Product::with(['category', 'latestPrice'])->get();
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());

        if ($request->has('price')) {
            $product->prices()->create(['price' => $request->price]);
        }

        return $product->load(['category', 'latestPrice']);
    }

    public function show($id)
    {
        return Product::with(['category', 'prices'])->findOrFail($id);
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->validated());

        if ($request->has('price')) {
            $product->prices()->create(['price' => $request->price]);
        }

        return $product->load(['category', 'latestPrice']);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Produto removido!']);
    }
}
