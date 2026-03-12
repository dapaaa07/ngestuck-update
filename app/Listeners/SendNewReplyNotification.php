<?php

namespace App\Listeners;

use App\Events\ReplyWasCreated;
use App\Models\User;
use App\Notifications\NewReplyNotification;

class SendNewReplyNotification
{
    public function handle(ReplyWasCreated $event)
    {
        $thread = $event->reply->replyAble();

        foreach ($thread->subscriptions() as $subscription) {
            // Ambil data user terlebih dahulu
            $user = $subscription->user();

            // Cek apakah user masih ada di database untuk mencegah error "notify() on null"
            if ($user && $this->replyAuthorDoesNotMatchSubscriber($event->reply->author(), $user)) {
                $user->notify(new NewReplyNotification($event->reply, $subscription));
            }
        }
    }

    // Parameter diubah untuk menerima User secara langsung
    private function replyAuthorDoesNotMatchSubscriber(User $author, User $subscriber): bool
    {
        return !$author->matches($subscriber);
    }
}
