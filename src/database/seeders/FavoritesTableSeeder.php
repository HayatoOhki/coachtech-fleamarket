<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $create_item_count = 100; // シーディングするアイテム数

        for($i = 1; $i <= $create_item_count; $i++) {
            $tentative_params[] = [
                'user_id' => mt_rand(2, 6), // 一般ユーザーのid:2~6
                'item_id' => mt_rand(1, 30), // アイテムのid:1~30
            ];
        }

        $check_param_array = [];
        $params = [];
        foreach($tentative_params as $tentative_param) {
            $check_param = $tentative_param['user_id'] . $tentative_param['item_id'];
            if(!in_array($check_param, $check_param_array, true)) {
                $array = [
                    'user_id' => $tentative_param['user_id'],
                    'item_id' => $tentative_param['item_id'],
                ];
                array_push($params, $array);
            }
            array_push($check_param_array, $check_param);
        }

        DB::table('favorites')->insert($params);
    }
}
