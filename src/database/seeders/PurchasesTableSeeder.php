<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $create_item_count = 10; // シーディングするアイテム数

        for($i = 1; $i <= $create_item_count; $i++) {
            $rand_user_id = mt_rand(2, 6); // 一般ユーザーのid:2~6
            $rand_item_id = mt_rand(1, 30); // アイテムのid:1~30
            $user_id = DB::table('items')->where('id', $rand_item_id)->value('user_id');
            if($rand_user_id == $user_id) {
                continue;
            } else {
                $params[] = [
                    'user_id' => $rand_user_id,
                    'item_id' => $rand_item_id,
                    'payment_id' => mt_rand(1, 3), // 支払い方法のid:1~3
                ];
            }
        }
        
        DB::table('purchases')->insert($params);
    }
}
