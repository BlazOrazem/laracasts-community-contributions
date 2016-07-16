<?php

use App\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $items = [
            [
                'id' => '1',
                'name' => 'JohnDoe',
                'email' => 'john@numencode.com',
                'password' => '$2y$10$5QYFCfkd5lSOxX20i0w2p.hwSupOP.YcJxRRoL8073FzXQXADTDZy',
                'trusted' => true,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id' => '2',
                'name' => 'JaneDoe',
                'email' => 'jane@numencode.com',
                'password' => '$2y$10$5QYFCfkd5lSOxX20i0w2p.hwSupOP.YcJxRRoL8073FzXQXADTDZy',
                'trusted' => false,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
        ];

        DB::table('users')->insert($items);
    }
}
