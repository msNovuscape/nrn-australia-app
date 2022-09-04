<?php

namespace App\Repositories\Member;


use App\Models\Member;
use App\Models\MemberDocument;
use App\Models\MemberPayment;

class MemberEloquent implements MemberRepository
{
    private $model;
    private $member_document;
    private $member_payment;

    public function __construct(Member $model,MemberDocument $member_document,MemberPayment $member_payment)
    {
        $this->model = $model;
        $this->member_document = $member_document;
        $this->member_payment = $member_payment;
    }

    public function all(array $attributes)
    {
        return $this->model->with('referral','parent')
            ->when(isset($attributes['search']), function ($q) use ($attributes) {
                $q->where('name', 'like', '%' . $attributes['search'] . '%');
            })
            ->orderBy('updated_at', 'desc')->paginate(50);
    }

    public function find($id)
    {
        return $this->model->findorfail($id);
    }

    public function findBy($filled, $value)
    {
        return $this->model->where($filled, $value)->first();
    }

    public function store($attributes)
    {
        $member_id = isset($attributes['user_id']) ? $attributes['user_id'] : 0;
        $attributes['first_name'] = ucfirst($attributes['first_name']);
        $attributes['last_name'] = ucfirst($attributes['last_name']);
        $attributes['middle_name'] = isset($attributes['middle_name']) ? ucfirst($attributes['middle_name']) : null;

        if(isset($attributes['image'])){
            $memberImage = (new Member())->where('user_id', $member_id)->first();
            if(!empty($memberImage)){
                $memberImage->delete();
                $path = public_path().parse_url($memberImage->image)['path'];
                unlink($path);
            }
            $attributes['image'] = $this->model->saveImage($attributes['image'],'profile_image');
            // return (new EmployeeImage())->create($attributes);
        }


        $data = $this->model->updateOrCreate([
            'user_id' => $member_id
        ],$attributes);

        $identification_image = $this->model->saveImage($attributes['identification_image'],'identification_image');
        $proof_of_residency_image = $this->model->saveImage($attributes['proof_of_residency_image'],'proof_of_residency_image');
        $payment_slip = $this->model->saveImage($attributes['payment_slip'],'payment_slip');
        $member_document = $this->member_document->create(['member_id' => $data->id, 'identification_image' => $identification_image,'identification_expiry_date' => $attributes['identification_expiry_date'],'proof_of_residency_image' =>$proof_of_residency_image,'proof_of_residency_expiry_date' => $attributes['proof_of_residency_expiry_date']]);
        $member_payment = $this->member_payment->create(['member_id' => $data->id, 'payment_date' => $attributes['payment_date'],'account_name' => $attributes['account_name'],'amount' =>$attributes['amount'],'bank_name' => $attributes['bank_name'],'payment_slip' => $payment_slip]);
        return $data;

    }

    public function update($attributes, $id)
    {
        $model =$this->model->findorfail($id);
        $model->update($attributes);
        return $model;
    }

    public function destroy($id)
    {
        return $this->find($id)->delete();
    }
}

