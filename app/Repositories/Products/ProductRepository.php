<?php

namespace App\Repositories\Products;

use App\Models\Product;

class ProductRepository
{
    public function allWithRelations()
    {
        return Product::with(['category', 'latestPrice'])->get();
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function findWithRelations($id)
    {
        return Product::with(['category', 'latestPrice'])->findOrFail($id);
    }

    public function update(Product $product, array $data)
    {
        $product->update($data);
        return $product;
    }

    public function delete(Product $product)
    {
        $product->delete();
    }
}
