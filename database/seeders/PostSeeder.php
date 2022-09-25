<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Hash;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([[
            'user_id' => 1,
            'member_id' => 1,
            'post_name' => '水道',
            'price' => '3990',
            'comment' => '備考',
            'date' => '2022-09-15'
            ], 
            [
            'user_id' => 1,
            'member_id' => 1,
            'post_name' => '電気',
            'price' => '6000',
            'comment' => '備考',
            'datet' => '2022-09-14'
            ],
            [
            'user_id' => 1,
            'member_id' => 2,
            'post_name' => 'ガス',
            'price' => '3000',
            'comment' => '備考',
            'date' => '2022-09-13'
            ],
            [
            'user_id' => 1,
            'member_id' => 2,
            'post_name' => '米',
            'price' => '1000',
            'comment' => '備考',
            'date' => '2022-09-13'
            ],
            [
            'user_id' => 1,
            'member_id' => 2,
            'post_name' => 'お茶',
            'price' => '1000',
            'comment' => '備考',
            'date' => '2022-09-14'
            ],
            [
            'user_id' => 1,
            'member_id' => 2,
            'post_name' => '食材',
            'price' => '3000',
            'comment' => '備考',
            'date' => '2022-09-15'
            ],
            [
            'user_id' => 1,
            'member_id' => 1,
            'post_name' => '家賃',
            'price' => '100000',
            'comment' => '備考',
            'date' => '2022-09-15'
            ],
            [
            'user_id' => 1,
            'member_id' => 1,
            'post_name' => '保険',
            'price' => '1000',
            'comment' => '備考',
            'date' => '2022-09-15'
            ],
            [
            'user_id' => 1,
            'member_id' => 2,
            'post_name' => 'クリーニング',
            'price' => '1000',
            'comment' => '備考',
            'date' => '2022-09-13'
            ],
            [
            'user_id' => 1,
            'member_id' => 2,
            'post_name' => 'おやつ',
            'price' => '500',
            'comment' => '備考',
            'date' => '2022-09-13'
            ],
            [
            'user_id' => 1,
            'member_id' => 2,
            'post_name' => '外食',
            'price' => '3000',
            'comment' => '備考',
            'date' => '2022-09-13'
            ],
            [
            'user_id' => 1,
            'member_id' => 2,
            'post_name' => '家具',
            'price' => '30000',
            'comment' => '備考',
            'date' => '2022-09-13'
            ],
            ]);
    
    }
}
