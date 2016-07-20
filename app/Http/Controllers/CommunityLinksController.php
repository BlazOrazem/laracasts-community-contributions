<?php

namespace App\Http\Controllers;

use App\Channel;
use App\CommunityLink;
use App\Http\Requests\CommunityLinkForm;
use App\Exceptions\CommunityLinkAlreadySubmitted;

class CommunityLinksController extends Controller
{
    /**
     * Show all community links.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $links = CommunityLink::where('approved', 1)->latest('updated_at')->paginate(25);
        $channels = Channel::orderBy('title', 'asc')->get();

        return view('community.index', compact('links', 'channels'));
    }

    /**
     * Publish a new community link.
     *
     * @param CommunityLinkForm $form
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CommunityLinkForm $form)
    {
        try {
            $form->persist();

            if(auth()->user()->isTrusted()) {
                flash('Thanks for the contribution!', 'success');
            } else {
                flash()->overlay('This contribution will be approved shortly.', 'Thanks!');
            }
        } catch (CommunityLinkAlreadySubmitted $e) {
            flash()->overlay(
                "We'll instead bump the timestamps and bring that link back to the top. Thanks!",
                'That Link Has Already Been Submitted.'
            );
        }

        return back();
    }
}
