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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('purchases')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $SplFileObject = new \SplFileObject(__DIR__ . '/data/purchases.csv');
        $SplFileObject->setFlags(
            \SplFileObject::READ_CSV |
            \SplFileObject::READ_AHEAD |
            \SplFileObject::SKIP_EMPTY |
            \SplFileObject::DROP_NEW_LINE
        );

        foreach ($SplFileObject as $key => $row) {
            if ($key === 0) {
                continue;
            }

            $params[] = [
                'user_id' => trim($row[0]),
                'item_id' => trim($row[1]),
                'payment_id' => trim($row[2]),
            ];
        }

        DB::table('purchases')->insert($params);
    }
}
