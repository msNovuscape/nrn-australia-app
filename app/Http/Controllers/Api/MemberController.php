<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiBaseController;
use App\Repositories\Member\MemberRepository;
use Illuminate\Http\Request;
use App\Http\Requests\CreateMemberRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\Member;
use JWTAuth;

class MemberController extends ApiBaseController
{
    private $member;

    public function __construct(MemberRepository $member)
    {
        $this->member = $member;
    }
   public function store(CreateMemberRequest $request){
    // GET user token    
    $currentUser = JWTAuth::parseToken()->authenticate();
   
    // Get user id
    $userId = $currentUser['id'];

    // Get request body
    $requestBody = $request->all();

    // Add user_id for this member
    $requestBody['user_id'] = $userId;

    return $this->sendResponse($this->member->store($requestBody),'Member Registered Successfully');
   }

   public function index(){
    // GET user token    
    $currentUser = JWTAuth::parseToken()->authenticate();
   
    // Get user id
    $userId = $currentUser['id'];

    // Find member using user id
    $member = Member::where('user_id', $userId)->first();
    

    if(is_null($member) || empty($member) ){
        return response()->json(null, 404);
    }else {

        // TODO: Fixing profile image url with url
        $member['image'] = str_replace(public_path(), url('/'), $member['image']);

        $memberDocument = $member->member_document;

        $member['identification_image'] = str_replace(public_path(), url('/'), $memberDocument['identification_image']);
        $member['identification_expiry_date'] = $memberDocument['identification_expiry_date'];
        $member['proof_of_residency_image'] = str_replace(public_path(), url('/'), $memberDocument['proof_of_residency_image']);
        $member['proof_of_residency_expiry_date'] = $memberDocument['proof_of_residency_expiry_date'];

        return response()->json($member, 200);
    }
   }
}
