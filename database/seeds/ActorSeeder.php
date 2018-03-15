<?php

use App\User;
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
        User::create([
            'name' => 'DreamLive',
            'email' => '995928339@qq.com',
            'password' => bcrypt('yu19960815'),
        ]);
    }
}
