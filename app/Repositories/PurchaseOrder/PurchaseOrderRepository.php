<?php

namespace App\Repositories\PurchaseOrder;

interface PurchaseOrderRepository
{
    public function all($projectId);

    public function find($id);

    public function findBy($filled, $value);

    public function store($attributes);

    public function update($attributes, $id);

    public function destroy($id);
}
