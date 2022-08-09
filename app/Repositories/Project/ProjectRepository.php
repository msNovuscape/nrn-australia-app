<?php

namespace App\Repositories\Project;

interface ProjectRepository
{
    public function all(array $attributes);

    public function find($id);

    public function findBy($filled, $value);

    public function store($attributes);

    public function update($attributes, $id);

    public function destroy($id);

    public function toggleProject($id);

    public function getTransferProjects($id);
}
