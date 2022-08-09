<?php

namespace App\Repositories\Products;

interface ProductRepository
{
    public function all(array $attributes);

    public function find($id);

    public function findBy($filled, $value);

    public function store($attributes);

    public function update($attributes, $id);

    public function destroy($id);

    public function getCategoryProduct($categoryId);

    public function syncProcess(array $attributes);
}
