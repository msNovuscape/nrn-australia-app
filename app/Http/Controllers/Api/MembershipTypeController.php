<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MembershipType;

class MembershipTypeController extends Controller
{
    public function index(){
        $membership_types = MembershipType::where('status',1)->get();
        return response()->json($membership_types, 200);
    }
}
