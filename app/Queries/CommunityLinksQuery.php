<?php

namespace App\Queries;

use App\CommunityLink;

class CommunityLinksQuery
{
    public function get($sortByPopular, $channel)
    {
        $orderBy = $sortByPopular ? 'votes_count' : 'updated_at';

        return CommunityLink::with('creator', 'channel')
            ->withCount('votes')
            ->forChannel($channel)
            ->where('approved', 1)
            ->orderBy($orderBy, 'DESC')
            ->paginate(3);
    }
}
