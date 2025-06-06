<?php

namespace App\Services\Categories;

use App\Repositories\Categories\CategoryRepository;
use App\Models\Category;

class CategoryService
{
    protected $repo;

    public function __construct(CategoryRepository $repo)
    {
        $this->repo = $repo;
    }

    public function list()
    {
        return $this->repo->all();
    }

    public function getOne($id)
    {
        return $this->repo->find($id);
    }

    public function create(array $data)
    {
        return $this->repo->create($data);
    }

    public function update(Category $category, array $data)
    {
        return $this->repo->update($category, $data);
    }

    public function delete(Category $category)
    {
        $this->repo->delete($category);
    }
}
