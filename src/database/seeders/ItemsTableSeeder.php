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
                'image_1' => 'https://coachtech-fleamarket-bucket.s3.ap-northeast-1.amazonaws.com/item_images/sample_image_' . mt_rand(1, 50) . '.jpg',
                'image_2' => 'https://coachtech-fleamarket-bucket.s3.ap-northeast-1.amazonaws.com/item_images/sample_image_' . mt_rand(1, 50) . '.jpg',
                'image_3' => 'https://coachtech-fleamarket-bucket.s3.ap-northeast-1.amazonaws.com/item_images/sample_image_' . mt_rand(1, 50) . '.jpg',
                'image_4' => 'https://coachtech-fleamarket-bucket.s3.ap-northeast-1.amazonaws.com/item_images/sample_image_' . mt_rand(1, 50) . '.jpg',
                'image_5' => 'https://coachtech-fleamarket-bucket.s3.ap-northeast-1.amazonaws.com/item_images/sample_image_' . mt_rand(1, 50) . '.jpg',
            ];
        }

        DB::table('items')->insert($params);
    }
}
