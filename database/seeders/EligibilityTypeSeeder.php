<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\EligibilityType;
use App\Models\MembershipType;
use Carbon\Carbon;

class EligibilityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $first =EligibilityType::create([
            'title' => 'I am a Nepali citizen and have lived out of Nepal (other than SAARC countries) more than 2 years and currently living in the Australia.I am not a Permanent Resident of the Australia',
            'status' => '1',
            'created_at' => Carbon::now(),
            
        ]);
    $second = EligibilityType::create([
            'title' => 'I am a Nepali citizen and a Permanent Resident of the Australia.',
            'status' => '1',
            'created_at' => Carbon::now(),
            
        ]);
    $third = EligibilityType::create([
            'title' => 'I am a Australian citizen but I am a PNO [People of Nepali Origin = I was or my parents or my grandparents are/were citizen(s) of Nepal]',
            'status' => '1',
            'created_at' => Carbon::now(),
            
        ]);
    $fourth = EligibilityType::create([
            'title' => 'I am a foreign (Non-Nepali, Non-Australia and Non-SAARC country) citizen but I am a PNO [People of Nepali Origin = I was or my parents or my grand-parents are/were citizen(s) of Nepal]',
            'status' => '1',
            'created_at' => Carbon::now(),
            
        ]);
    $fifth = EligibilityType::create([
            'title' => 'I am an international nepali student currently living in Australia.',
            'status' => '1',
            'created_at' => Carbon::now(),
            
        ]);

        $lifetime_member = MembershipType::create([
            'name' => 'Lifetime Member',
            'amount' => '150',
            'status' => '1',
            'created_at' => Carbon::now(),
            
        ]);

        $lifetime_member->eligibility_types()->sync(
            [$second->id,$third->id]
        ); 

        $registered_member =  MembershipType::create([
            'name' => 'Registered Member',
            'expiration_years' => '2',
            'amount' => '25',
            'status' => '1',
            'created_at' => Carbon::now(),
            
        ]);

        $registered_member->eligibility_types()->sync(
            [$first->id,$second->id,$third->id,$fourth->id]
        ); 

        $associate_member =  MembershipType::create([
            'name' => 'Associate Member (NO VOTING RIGHTS)',
            'expiration_years' => '2',
            'amount' => '10',
            'status' => '1',
            'created_at' => Carbon::now(),
            
        ]);  

        $associate_member->eligibility_types()->sync(
            $fifth->id
        ); 
        
    }
}
