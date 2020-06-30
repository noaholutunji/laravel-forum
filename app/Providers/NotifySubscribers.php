<?php

namespace App\Providers;

use App\Providers\ThreadReceivedNewReply;

class NotifySubscribers
{
    /**
     * Handle the event.
     *
     * @param  ThreadReceivedNewReply  $event
     * @return void
     */
    public function handle(ThreadReceivedNewReply $event)
    {
        $thread = $event->reply->thread;

        // prepare notifications
        $thread->subscriptions
            ->where('user_id', '!=', $event->reply->user_id)
            ->each
            ->notify($event->reply);
    }
}
