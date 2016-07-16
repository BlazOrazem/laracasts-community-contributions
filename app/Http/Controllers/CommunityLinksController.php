<?php

namespace App\Http\Controllers;

use App\Channel;
use App\CommunityLink;
use App\Http\Requests;
use Illuminate\Http\Request;

class CommunityLinksController extends Controller
{
    /**
     * Show all community links.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $links = CommunityLink::where('approved', 1)->paginate(25);
        $channels = Channel::orderBy('title', 'asc')->get();

        return view('community.index', compact('links', 'channels'));
    }

    /**
     * Publish a new community link.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'channel_id' => 'required|exists:channels,id',
            'title' => 'required',
            'link' => 'required|active_url|unique:community_links',
        ]);

        CommunityLink::from(auth()->user())
            ->contribute($request->all());

        return back();
    }
}
