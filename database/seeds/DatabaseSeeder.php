<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        // 呼叫剛剛寫好的 Seeder
        $this->call(UserTableSeeder::class);

        // 使用 Factory
        // 一次建 50 筆資料
        factory(App\Models\User::class, 50)->create();
    }
}
