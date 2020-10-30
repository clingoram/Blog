<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 建 10 筆
        for ($i = 1; $i <= 10; $i++) {
            // 透過 DB class 建立資料
            DB::table('users')->insert([
                // 'id' => rand(1, 100),
                'account' => Str::random(6),
                'name' => Str::random(10), // 產生長度 10 的字串
                'password' => bcrypt('secret'), // 產生亂數密碼
                // 'role' => Str::random(1),
                'email' => Str::random(10) . '@gmail.com', 
                'created_at' => now(),
                'updated_at' => now(),
                'register_time' => now()
            ]);
        }
    }
}
