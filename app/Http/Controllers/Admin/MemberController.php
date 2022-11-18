<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Member;
use App\Models\MembershipType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
 use Carbon\Carbon;

class MemberController extends Controller
{
    protected $view = 'admin.member.';
    protected $redirect = 'admin/members/';


    public function index($membership_status)
    {
        $roleName = auth()->user()->roles->first()->name;
        $membership_status_config = ucfirst($membership_status);
        if($roleName == 'General Secretary'){
            $index = array_search($membership_status_config,config('custom.membership_status'));
            
            $setting = Member::orderBy('id','desc')->where([
                'payment_status_id' => array_search('Verified',config('custom.membership_status')),
                'document_status_id' =>  $index
                 ]);
        }
        elseif($roleName == 'President'){
            $index = array_search($membership_status_config,config('custom.membership_status'));
            $setting = Member::orderBy('id','desc')->where([
                'payment_status_id' => array_search('Verified',config('custom.membership_status')),
                'document_status_id' => array_search('Verified',config('custom.membership_status')),
                'president_status_id' =>  $index,
                 'membership_status_id' => $index
                 ]);
        }else{
            $index = array_search($membership_status_config,config('custom.payment_status'));
            
            $setting = Member::orderBy('id','desc')->where([
                                     'payment_status_id' =>  $index,
                                      ]);
        }

        $per_page = config('custom.per_page');    
        if($index == false){
            Session::flash('error','Membership not found.');
            return redirect($this->redirect);
        }
    
        // $setting = Member::orderBy('id','desc')->where('status_id',$index);
        if(isset($_GET['search_key'])){
            $key = \request('search_key');
            $settings = $setting->where('first_name','like','%'.$key.'%')->orWhere('middle_name','LIKE','%'.$key.'%')->orWhere('last_name','LIKE','%'.$key.'%');
        }

        if(isset($_GET['membership_type_id']) && $_GET['membership_type_id'] !=''){
            $key = \request('membership_type_id');
            $settings = $setting->where('membership_type_id',$key);
        }

        if(isset($_GET['state_id']) && $_GET['state_id'] !=''){
            $key = \request('state_id');
            $settings = $setting->where('state_id',$key);
        }
        
        $membership_types = MembershipType::where('status',1)->get();
        $settings = $setting->paginate($per_page);
        return view($this->view.'index',compact('settings','membership_types','membership_status'));
    }

    public function create()
    {
        return view($this->view . 'create');
    }
    public function edit($id)
    {

        $member = Member::findorfail($id);
        return view($this->view . 'edit',compact('member'));
    }
    public function show($id)
    {
        $roleName = auth()->user()->roles->first()->name;
        $member = Member::findorfail($id);
        return view($this->view.'members_info',compact('member'));
    }



    public function update(Request $request, $id){   //only for president

        $setting =Member::findorfail($id);

        $this->validate(\request(), [

            'name' => 'required',
            'membership_status_id' => 'required',
            'mobile_number' => 'required',
            'gender_id' => 'required',
            'occupation' => 'required',
            'dob' => 'required',
            'postcode' => 'required',
            'residential_address' => 'required',
            'state_id' => 'required',
            'suburb' => 'required',
            'country_id' => 'required',
            'identification_expiry_date' => 'required',
            'proof_of_residency_expiry_date' => 'required'

        ]);

        $requestData = $request->all();
        if(isset($requestData['document_status_id_new'])){
            $requestData['document_status_id'] = $requestData['document_status_id_new'];

        }
        if(isset($requestData['payment_status_id_new'])){
            $requestData['payment_status_id'] = $requestData['payment_status_id_new'];

        }


        $splitName = explode(' ', $requestData['name'], 3);
        $requestData['first_name'] = $splitName['0'];
        if(count($splitName) > 2){
            $requestData['middle_name'] = $splitName['1'];
           $requestData['last_name'] = $splitName['2'];
        }else{
            $requestData['last_name'] = $splitName['1'];
        }
        
        $previous_status = $setting->president_status_id;
        $requestData['president_status_id']  = $requestData['membership_status_id'];
        //check for verififed status and update issued and expiry date accordingly
        if($previous_status !== 2 && $requestData['membership_status_id'] == 2){
            $dt = Carbon::now();
            if (isset($_POST['membership_type_id'])){
                $expiration_years = MembershipType::findorfail($_POST['membership_type_id'])->expiration_years;
            }
            $year = $expiration_years ?? $setting->membership_type->expiration_years;
            $requestData['status_id'] = 4;//
            $requestData['membership_issued_date'] = Carbon::now();
            $year_join = Carbon::parse($requestData['membership_issued_date'])->format('y');
            $month = Carbon::parse($requestData['membership_issued_date'])->format('m');
            $date = Carbon::parse($requestData['membership_issued_date'])->format('d');
            $first = strtoupper($requestData['first_name'][0]);
            $last = strtoupper($requestData['last_name'][0]);
            $requestData['nrna_code'] = 'NRNA-'.$month . $year_join . $date . str_pad($setting->id, 4, '0', STR_PAD_LEFT) . $first . $last;
            if($year != null){
                $requestData['membership_expiry_date'] = $dt->addYears($year);
            }
            $requestData['membership_status_id'] = 2;
        }
        if($requestData['membership_status_id'] == 1){
            $requestData['membership_status_id'] = 1;
            $requestData['nrna_code'] = 'N/A';
            $requestData['membership_issued_date'] = null;
            $requestData['membership_expiry_date'] = null;
        }

        //check for previous image remove if present and add and new
        if(isset($requestData['image'])){
            $previous_image = $setting->image;
            if(!empty($previous_image)){
                $path = public_path().'/'.parse_url($previous_image)['path'];
                unlink($path);
            }
            $member = new Member();
            $requestData['image'] = $member->saveImage($requestData['image'],'profile_image');
        }
        $requestData['country_id'] = 1;
        $setting->fill($requestData);

        //update child table member_document and member_payment
        if($setting->save()){
          
            $setting->member_document->update(['identification_expiry_date' => $requestData['identification_expiry_date'],'proof_of_residency_expiry_date' => $requestData['proof_of_residency_expiry_date']]);
            // $setting->member_document->update($requestData);
            $setting->member_payment->update($requestData);
        }

        Session::flash('success','Member succesffuly updated.');
        return redirect($this->redirect.lcfirst(config('custom.membership_status')[$requestData['membership_status_id']]));

    }

    

    public function update_status(Request $request){//not used currently
      
        $id = $request->id;
        $status = $request->membership_status_id;
        $setting = Member::findorfail($id);
        $previous_status = $setting->membership_status_id;

        $setting->membership_status_id = $status;
        if($setting->update()){

            if($previous_status !== 2 && $status == 2){

                $dt = Carbon::now();
                $year = $setting->membership_type->expiration_years;

                $setting->membership_issued_date = Carbon::now();
                $year_join = Carbon::parse($setting->membership_issued_date)->format('y');
                $month = Carbon::parse($setting->membership_issued_date)->format('m');
                $date = Carbon::parse($setting->membership_issued_date)->format('d');
                $first = strtoupper($setting->first_name[0]);
                $last = strtoupper($setting->last_name[0]);
                $setting->nrna_code = 'NRNA-'.$month . $year_join . $date . str_pad($setting->id, 4, '0', STR_PAD_LEFT) . $first . $last;
                if($year != null){
                  $setting->membership_expiry_date = $dt->addYears($year);
                }
                $setting->update();

            }
            if($status == 1){
                $setting->membership_status_id = 1;
                $setting->nrna_code = 'N/A';
                $setting->membership_issued_date = null;
                $setting->membership_expiry_date = null;
            }
            return response()->json(['msg' => 'Membership status updated successfully!','membership_status_id' => $setting->membership_status_id],200);
        }


    }

    public function update_status_by_finance(Request $request){

        $id = $request->id;
        $status = $request->membership_status_id;
        $roleName = auth()->user()->roles->first()->name;
        $setting = Member::findorfail($id);

        if($status == 3){

            $setting->membership_status_id = 3;
            $setting->status = false;
            $setting->rejected_reason = $request['rejected_reason'];

        }
        if($status == 4){

            $setting->membership_status_id = 4;
            $setting->status = false;
            $setting->reapply_reason = $request['reapply_reason'];

        }
        if($roleName == 'Treasurer'){

            $setting->payment_status_id = $status;

            if($status == 2){
                $setting->membership_status_id = 1;
                $setting->document_status_id = 1;
                $setting->comment_for_treasurer = null;
            }
            
        }
        if($roleName == 'General Secretary'){

            $setting->document_status_id = $status;

            if($status == 2){
                $setting->president_status_id = 1;
                $setting->comment_for_general_secretary = null;
            }
        }
        if($roleName == 'President'){

                $previous_status = $setting->president_status_id;
                // $previous_image = $setting->image;
                $setting->president_status_id = $status; 
            
                if($previous_status !== 2 && $status == 2){
                    $dt = Carbon::now();
                    $year = $setting->membership_type->expiration_years;
                    // $setting->image = bcrypt($previous_image);
                    $setting->membership_issued_date = Carbon::now();
                    $year_join = Carbon::parse($setting->membership_issued_date)->format('y');
                    $month = Carbon::parse($setting->membership_issued_date)->format('m');
                    $date = Carbon::parse($setting->membership_issued_date)->format('d');
                    $first = strtoupper($setting->first_name[0]);
                    $last = strtoupper($setting->last_name[0]);
                    $setting->nrna_code = 'NRNA-'.$month . $year_join . $date . str_pad($setting->id, 4, '0', STR_PAD_LEFT) . $first . $last;

                    if($year != null){
                        $setting->membership_expiry_date = $dt->addYears($year);
                    }
                    $setting->membership_status_id = 2;
                }
                if($status == 1){
                    $setting->membership_status_id = 1;
                    $setting->nrna_code = 'N/A';
                    $setting->membership_issued_date = null;
                    $setting->membership_expiry_date = null;
                }
        }

        if($setting->update()){
         return response()->json(['msg' => 'Status updated successfully!','membership_status_id' => $setting->status_id],200);
        }

    }


    public function delete($id){

        $setting=Member::findorfail($id);
        $image = $setting->image;
        if(!empty($image)){
            $path = public_path().'/'.parse_url($image)['path'];
            unlink($path);
        }
        $identification_image = $setting->member_document->identification_image;
        if(!empty($identification_image)){
            $path = public_path().'/'.parse_url($identification_image)['path'];
            unlink($path);
        }
        $proof_of_residency_image = $setting->member_document->proof_of_residency_image;
        if(!empty($proof_of_residency_image)){
            $path = public_path().'/'.parse_url($proof_of_residency_image)['path'];
            unlink($path);
        }
        $payment_slip = $setting->member_payment->payment_slip;
        if(!empty($payment_slip)){
            $path = public_path().'/'.parse_url($payment_slip)['path'];
            unlink($path);
        }
        if($setting->delete()){
            
            Session::flash('success','Member successfully deleted !');
            return redirect()->back();
        }

    }

    public function update_status_by_president(Request $request){

        $member_id = $request['member_id'];
        $member = Member::findorfail($member_id);
        $document_status_id = $request['document_status_id'];
        $payment_status_id = $request['payment_status_id'];

        if(!is_null($document_status_id) && $document_status_id == 1){
            $member->document_status_id = 1;
            $member->comment_for_general_secretary = $request['comment_for_general_secretary'];
            $msg = 'Verification status from General Secretary changed to pending.';
        }

        if(!is_null($payment_status_id) && $payment_status_id == 1){
            $member->payment_status_id = 1;
            $member->document_status_id = 1;
            $member->comment_for_treasurer = $request['comment_for_treasurer'];
            $msg = 'Verification status from Treasurer changed to pending.';
        }

        if($member->save()){
            return response()->json(['msg' => $msg,'redirect_url' => url('admin/members/pending')],200);

        }
    }
}
