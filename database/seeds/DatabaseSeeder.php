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
        // 用 Seeder 來告訴 Factory 需要多少筆資料

        // 清空資料表，避免每次執行都會增加10筆資料
        $db = DB::table('users')->get();
        if(count($db) != 0){
            DB::table('users')->truncate();
            // DB::table('userlogs')->truncate();
        }else{
            // 呼叫寫好的 Seeder
            $this->call(UserTableSeeder::class);
    
            // 使用 Factory - Faker 協助建立測試資料
            // 建 10 筆資料
            // User的id 與userlog的member_id做關聯，要先建立users再建立userlogs
            factory(App\Models\User::class, 10)->create()->each(function ($user) {
                $user->posts()->save(factory(App\Models\Userlog::class)->make());
            });

        }
    }
}
