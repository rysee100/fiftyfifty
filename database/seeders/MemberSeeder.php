<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Hash;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members')->insert([[
            'user_id' => 1,
            'member_name' => 'メンバー1'
            ], 
            [
            'user_id' => 1,
            'member_name' => 'メンバー2'
            ],
            ]);
    
    }
}
