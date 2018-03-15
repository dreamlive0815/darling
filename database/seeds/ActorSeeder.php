<?php

use App\User;
use App\Seller;
use Illuminate\Database\Seeder;

class ActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::updateOrCreate(
            ['name' => 'DreamLive', 'email' => '995928339@qq.com'],
            ['password' => bcrypt('yu19960815')]
        );
        Seller::updateOrCreate(
            ['name' => 'Koishi', 'email' => '1113704512@qq.com'],
            ['password' => bcrypt('yu19960815')]
        );
    }
}
