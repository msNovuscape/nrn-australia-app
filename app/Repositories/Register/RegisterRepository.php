<?php

namespace App\Repositories\Register;

interface RegisterRepository
{

    public function all($id);

    public function find($id);

    public function findBy($filled, $value);

    public function store($attributes);

    public function update($attributes, $id);

    public function destroy($id);

    public function getTodayAttendance(array $attributes);

    public function getTodayAbsentAttendance(array $attributes);

    public function storeFirstPhaseAttendance(array $attributes);

    public function editFirstPhaseAttendance(array $attributes);

    public function addPhaseAttendanceJobEnd(array $attributes);

}
