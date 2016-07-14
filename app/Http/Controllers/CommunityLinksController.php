<?php

namespace App\Http\Controllers;

use App\CommunityLink;
use App\Http\Requests;
use Illuminate\Http\Request;

class CommunityLinksController extends Controller
{
    public function index()
    {
        $links = CommunityLink::paginate(25);

        return view('community.index', compact('links'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'link' => 'required|active_url',
        ]);

        CommunityLink::from(auth()->user())
            ->contribute($request->all());

        return back();
    }
}
