<?php

use App\User;
use App\Seller;
use App\Model\Tag;
use App\Model\Order;
use App\Model\Commodity;
use App\Model\CarrierStatus;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run()
    {
        
        $user = User::where('name', 'DreamLive')->first();
        $user_id = $user->id;
        $seller = Seller::where('name', 'Koishi')->first();
        $seller_id = $seller->id;

        for($i = 0; $i < 8; ++$i) {
            Tag::create([
                'name' => '标签' . $i,
            ]);
        }
        
        for($i = 0; $i < 3; ++$i) {
            $order = Order::create([
                'seller_id' => $seller_id,
                'sender_id' => $user_id,
                'sender_address' => '地点' . mt_rand(0, 100),
                'receiver_address' => '地点' . mt_rand(0, 100),
                'receiver_tel' => '158690' . mt_rand(10000, 99999),
                'reward_for_carrier' => mt_rand(50, 100),
            ]);

            if($i < 1) continue;
            CarrierStatus::create([
                'user_id' => $user_id,
                'want_order_id' => $order->id,
            ]);
        }

        for($i = 0; $i < 5; ++$i) {
            Commodity::create([
                'seller_id' => $seller_id,
                'name' => "商品{$i}" . mt_rand(0, 100),
                'price' => mt_rand(50, 1000),
            ]);
        }
        
    }
}
