<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipType extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // protected $fillable = ['member_id','identification_image','identification_expiry_date','proof_of_residency_image','proof_of_residency_expiry_date'];

    public function eligibility_types()
    {
        return $this->belongsToMany(EligibilityType::class, 'eligibility_type_membership_type');
    }
}
