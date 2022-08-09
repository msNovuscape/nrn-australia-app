<?php

namespace App\Repositories\Employees;

interface EmployeeRepository
{
    public function all(array $attributes);

    public function find($id);

    public function findBy($filled, $value);

    public function store($attributes);

    public function update($attributes, $id);

    public function destroy($id);

    public function saveProfileImage(array $attributes);

    public function toggleEmployee($id);
}
