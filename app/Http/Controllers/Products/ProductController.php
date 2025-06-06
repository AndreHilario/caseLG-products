<?php

namespace App\Http\Controllers\Products;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Services\Products\ProductService;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    protected $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return ProductResource::collection($this->service->list());
    }

    public function store(ProductRequest $request)
    {
        $product = $this->service->create($request->validated());
        return new ProductResource($product);
    }

    public function show($id)
    {
        $product = $this->service->getOne($id);
        return new ProductResource($product);
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $updated = $this->service->update($product, $request->validated());
        return new ProductResource($updated);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $this->service->delete($product);
        return response()->json(['message' => 'Produto excluído com sucesso.'], 204);
    }
}
