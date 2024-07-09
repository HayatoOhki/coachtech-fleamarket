<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $create_item_count = 30; // シーディングするアイテム数

        for($i = 1; $i <= $create_item_count; $i++) {
            $params[] = [
                'user_id' => mt_rand(2, 6), // 一般ユーザーのid:2~6
                'category_id' => mt_rand(159, 1470), // カテゴリ―のリーフid:159~1470
                'condition_id' => mt_rand(1, 6), // 商品の状態のid:1~6
                'name' => 'サンプルアイテム' . $i,
                'brand' => 'サンプルブランド',
                'description' => 'サンプルテキスト',
                'price' => mt_rand(1000, 10000), // 価格のランダム設定
                'image_1' => 'storage/images/sample_image_1.png',
                'image_2' => 'storage/images/sample_image_2.png',
                'image_3' => 'storage/images/sample_image_3.png',
                'image_4' => 'storage/images/sample_image_4.png',
                'image_5' => 'storage/images/sample_image_5.png',
            ];
        }

        DB::table('items')->insert($params);
    }
}
