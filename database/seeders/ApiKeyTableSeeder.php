<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApiKeyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('api_key')->delete();
        DB::table('api_key')->insert(array(
            0 =>
            array(
                'id' => 1,
                'api_key' => 'key1',
                'count' => '3',
            ),
            1 =>
            array(
                'id' => 2,
                'api_key' => 'key2',
                'count' => '3',
            ),
            2 =>
            array(
                'id' => 3,
                'api_key' => 'key3',
                'count' => '3',
            ),
            3 =>
            array(
                'id' => 4,
                'api_key' => 'key4',
                'count' => '3',
            ),
            4 =>
            array(
                'id' => 5,
                'api_key' => 'key5',
                'count' => '3',
            ),
            5 =>
            array(
                'id' => 6,
                'api_key' => 'key6',
                'count' => '3',
            ),
            6 =>
            array(
                'id' => 7,
                'api_key' => 'key7',
                'count' => '3',
            ),
            7 =>
            array(
                'id' => 8,
                'api_key' => 'key8',
                'count' => '3',
            ),
            8 =>
            array(
                'id' => 9,
                'api_key' => 'key9',
                'count' => '3',
            ),
            9 =>
            array(
                'id' => 10,
                'api_key' => 'key10',
                'count' => '3',
            ),
        ));
    }
}
