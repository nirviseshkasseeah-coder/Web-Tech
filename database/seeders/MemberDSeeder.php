<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberDSeeder extends Seeder
{
    public function run(): void
    {
        if (!DB::table('products')->where('ProductID', 9991)->exists()) {
            DB::table('products')->insert([
                'ProductID' => 9991,
                'Name' => 'Member D Demo Product',
                'Description' => 'Sample product used to demonstrate Eloquent relationships.',
                'Price' => 150.00,
                'Points' => 15,
            ]);
        }

        if (
            DB::table('users')->where('id', 1)->exists() &&
            !DB::table('reviews')->where('ProductID', 9991)->where('UserID', 1)->exists()
        ) {
            DB::table('reviews')->insert([
                'UserID' => 1,
                'ProductID' => 9991,
                'Rating' => 5,
                'Comment' => 'Great demo product for Member D.',
                'CreatedAt' => now(),
            ]);
        }
    }
}