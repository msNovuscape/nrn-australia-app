<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiBaseController;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Http\Resources\TeamCollection;

class TeamController extends ApiBaseController
{
    
    public function index()
    {
        $settings = Team::where('status', 1)->orderBy('designation_id', 'asc')->get();
        return new TeamCollection($settings);
    }


}
