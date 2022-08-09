<?php

namespace App\Repositories\Login;

interface LoginRepository
{

    public function all($id);



    public function login($attributes);

    public function update($attributes, $id);

    public function destroy($id);

   

}
