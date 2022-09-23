<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('eligibility_types')->insert([
            'title' => 'I am a Nepali citizen and have lived out of Nepal (other than SAARC countries) more than 2 years and currently living in the Australia.I am not a Permanent Resident of the Australia',
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
        DB::table('eligibility_types')->insert([
            'title' => 'I am a foreign (Non-Nepali, Non-Australia and Non-SAARC country) citizen but I am a PNO [People of Nepali Origin = I was or my parents or my grand-parents are/were citizen(s) of Nepal]',
            'status' => '1',
            'created_at' => Carbon::now(),
            
        ]);
        DB::table('eligibility_types')->insert([
            'title' => 'I am an international nepali student currently living in Australia.',
            'status' => '1',
            'created_at' => Carbon::now(),
            
        ]);
        
    }
}
