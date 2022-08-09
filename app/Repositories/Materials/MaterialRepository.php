<?php

namespace App\Repositories\Materials;

interface MaterialRepository
{
    public function all(array $attributes);

    public function find($id);

    public function findBy($filled, $value);

    public function store($attributes);

    public function update($attributes, $id);

    public function destroy($id);

    public function getTransferMaterials($id);
}
