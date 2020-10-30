<?php

use Illuminate\Database\Seeder;

use App\User;

class UserlogTableSeeder extends Seeder
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
            DB::table('userlogs')->insert([
                'member_id' => User::all()->random()->id,
                'note' => Str::random(30),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
