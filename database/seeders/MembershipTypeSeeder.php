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
        DB::table('membership_types')->insert([
            'name' => 'Lifetime Member',
            'amount' => '150',
            'status' => '1',
            'created_at' => Carbon::now(),
            
        ]);
        DB::table('membership_types')->insert([
            'name' => 'Registered Member',
            'expiration_years' => '2',
            'amount' => '25',
            'status' => '1',
            'created_at' => Carbon::now(),
            
        ]);

        DB::table('membership_types')->insert([
            'name' => 'Associate Member (NO VOTING RIGHTS)',
            'expiration_years' => '2',
            'amount' => '10',
            'status' => '1',
            'created_at' => Carbon::now(),
            
        ]);      

        // Get all the roles attaching up to 3 random roles to each user
$membership_types = MembershipType::all();

// Populate the pivot table
MembershipType::all()->each(function ($user) use ($membership_types) { 
    $user->eligibility_types()->attach(
        $membership_types->random(rand(1, 4))->pluck('id')->toArray()
    ); 
});
        
        
    }
}
