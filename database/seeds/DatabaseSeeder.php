<?php

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DatabaseSeeder extends Seeder
{
    use DatabaseTransactions;

    /**
     * Database tables.
     *
     * @var array
     */
    private $tables = [
        'users',
        'community_links',
        'channels',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->cleanDatabase();
        $this->command->info('Database truncated.');

        $this->call(UsersTableSeeder::class);
        $this->call(CommunityLinksTableSeeder::class);
        $this->call(ChannelsTableSeeder::class);
    }

    /**
     * Truncate tables.
     */
    public function cleanDatabase()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        foreach ($this->tables as $tableName) {
            DB::table($tableName)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
