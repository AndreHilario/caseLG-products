<?php

namespace App\Services\Products;

use App\Repositories\Products\ProductRepository;
use App\Models\Product;

class ProductService
{
    protected $repo;

    public function __construct(ProductRepository $repo)
    {
        $this->repo = $repo;
    }

    public function list()
    {
        return $this->repo->allWithRelations();
    }

    public function create(array $data)
    {
        $product = $this->repo->create($data);
        $product->prices()->create(['price' => $data['price']]);
        return $this->repo->findWithRelations($product->id);
    }

    public function getOne($id)
    {
        return $this->repo->findWithRelations($id);
    }

    public function update(Product $product, array $data)
    {
        $this->repo->update($product, $data);
        if (isset($data['price'])) {
            $product->prices()->create(['price' => $data['price']]);
        }
        return $this->repo->findWithRelations($product->id);
    }

    public function delete(Product $product)
    {
        $this->repo->delete($product);
    }
}
