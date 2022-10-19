<?php

namespace App\Http\Controllers;

use App\Reply;
use Illuminate\Http\Request;

class BestRepliesController extends Controller
{
    public function store(Reply $reply)
    {
        $this->authorize('update', $reply->thread); // the thread policy

        // OR abort_if($reply->thread->user_id !== auth()->id(), 401);

        $reply->thread->markBestReply($reply);
    }
}
