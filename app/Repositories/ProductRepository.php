<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository
{
    public function __construct(protected Product $product)
    {
    }

    public function getAll(): Collection
    {
        return $this->product->all();
    }

    public function getById(int $id): Product|null
    {
        return $this->product->findOrFail($id);
    }

    public function create(array $attributes): Product
    {
        return $this->product->create($attributes);
    }

    public function update(array $attributes, int $id): bool
    {
        return $this->product->findOrFail($id)->update($attributes);
    }

    public function delete(int $id): bool
    {
        return $this->product->findOrFail($id)->delete();
    }
}
