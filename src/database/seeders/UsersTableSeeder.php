<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $SplFileObject = new \SplFileObject(__DIR__ . '/data/users.csv');
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
                'email' => trim($row[0]),
                'password' => Hash::make(trim($row[1])),
                'role' => trim($row[2]),
            ];
        }

        DB::table('users')->insert($params);
    }
}
