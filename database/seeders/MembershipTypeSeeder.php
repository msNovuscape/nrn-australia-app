<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\EligibilityType;
use App\Models\MembershipType;

class MembershipTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lifetime_member = MembershipType::create([
            'name' => 'Lifetime Member',
            'amount' => '150',
            'status' => '1',
            'created_at' => Carbon::now(),
            
        ]);
        DB::table('eligibility_types')->insert([
            'title' => 'I am a Nepali citizen and a Permanent Resident of the Australia.',
            'status' => '1',
            'created_at' => Carbon::now(),
            
        ]);
        DB::table('eligibility_types')->insert([
            'title' => 'I am a Australian citizen but I am a PNO [People of Nepali Origin = I was or my parents or my grandparents are/were citizen(s) of Nepal]',
            'status' => '1',
            'created_at' => Carbon::now(),
            
        ]);
        // $lifetime = $lifetime_member;
        $membership_types = EligibilityType::all();
        foreach($membership_types as $membership_type){
            $membership_type->membership_types()->attach(
                $lifetime_member->id
            ); 
        }
        // $lifetime->eligibility_types()->attach(
        //     $membership_types->random(rand(1, 3))->pluck('id')->toArray()
        // ); 
        // DB::table('membership_types')->insert([
        //     'name' => 'Registered Member',
        //     'expiration_years' => '2',
        //     'amount' => '25',
        //     'status' => '1',
        //     'created_at' => Carbon::now(),
            
        // ]);

        // DB::table('membership_types')->insert([
        //     'name' => 'Associate Member (NO VOTING RIGHTS)',
        //     'expiration_years' => '2',
        //     'amount' => '10',
        //     'status' => '1',
        //     'created_at' => Carbon::now(),
            
        // ]);      

        // Get all the roles attaching up to 3 random roles to each user
        // $membership_types = MembershipType::all();
        // foreach($membership_types as $membership_type){
        //     $membership_type->eligibility_types()->attach(
        //         $membership_types->random(rand(1, 3))->pluck('id')->toArray()
        //     ); 
        // }

        // Populate the pivot table
        // MembershipType::all()->each(function ($user) use ($membership_types) { 
        //     $user->eligibility_types()->attach(
        //         $membership_types->random(rand(1, 3))->pluck('id')->toArray()
        //     ); 
        // });
        
        
    }
}
