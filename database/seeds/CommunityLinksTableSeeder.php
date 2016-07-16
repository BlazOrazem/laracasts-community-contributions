<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CommunityLinksTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $items = [
            [
                'id' => '1',
                'title' => 'PHP',
                'slug' => 'php',
                'color' => 'red',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '2',
                'title' => 'JavaScript',
                'slug' => 'javascript',
                'color' => 'pink',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '3',
                'title' => 'Ruby',
                'slug' => 'ruby',
                'color' => 'green',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
        ];

        DB::table('channels')->insert($items);
    }
}
