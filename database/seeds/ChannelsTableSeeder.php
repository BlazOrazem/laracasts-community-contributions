<?php

use App\CommunityLink;
use Illuminate\Database\Seeder;

class ChannelsTableSeeder extends Seeder
{
    public function run()
    {
        factory(CommunityLink::class, 20)->create();
    }
}
