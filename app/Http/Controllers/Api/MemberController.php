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
        $memberPayment = $member->member_payment;

        $member['identification_image'] = str_replace(public_path(), url('/'), $memberDocument['identification_image']);
        $member['identification_expiry_date'] = $memberDocument['identification_expiry_date'];
        $member['proof_of_residency_image'] = str_replace(public_path(), url('/'), $memberDocument['proof_of_residency_image']);
        $member['proof_of_residency_expiry_date'] = $memberDocument['proof_of_residency_expiry_date'];

        $member['payment_date'] = $memberPayment['payment_date'];
        $member['account_name'] = $memberPayment['account_name'];
        $member['bank_name'] = $memberPayment['bank_name'];
        $member['amount'] = $memberPayment['amount'];
        $member['payment_slip'] = str_replace(public_path(), url('/'), $memberPayment['payment_slip']);

        return response()->json($member, 200);
    }

   }

   public function check_phone($phone)
   {

    $checkPhone = Member::where(['mobile_number' => $phone])->get()->first();
    if(is_null($checkPhone))
     {
             $is_unique = true;
     }
     return response()->json([
         'is_unique' => $is_unique ?? false,
        ]);
   }
}
