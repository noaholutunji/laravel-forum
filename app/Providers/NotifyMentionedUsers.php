<?php

namespace App\Providers;

use App\Notifications\YouWereMentioned;
use App\Providers\ThreadReceivedNewReply;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyMentionedUsers
{
    /**
     * Handle the event.
     *
     * @param  ThreadReceivedNewReply  $event
     * @return void
     */
    public function handle(ThreadReceivedNewReply $event)
    {
        User::whereIn('name', $event->reply->mentionedUsers())
            ->get()
            ->each(function ($user) use ($event) {
                $user->notify(new YouWereMentioned($event->reply));
            });

        // OR $mentionedUsers = $event->reply->mentionedUsers();

        // foreach ($mentionedUsers as $name) {
        //     $user = User::whereName($name)->first();

        //     if ($user) {
        //         $user->notify(new YouWereMentioned($event->reply));
        //     }
        // }
    }
}
