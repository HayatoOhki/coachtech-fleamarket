<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
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
            $params[] = [
                'user_id' => mt_rand(2, 6), // 一般ユーザーのid:2~6
                'item_id' => mt_rand(1, 30), // アイテムid:1~30
                'comment' => 'サンプルコメント' . $i,
            ];
        }

        DB::table('comments')->insert($params);
    }
}
