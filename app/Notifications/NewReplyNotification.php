<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Reply;
use App\Mail\NewReplyEmail;
use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels; // WAJIB DITAMBAHKAN UNTUK QUEUE MODEL

class NewReplyNotification extends Notification implements ShouldQueue
{
    use Queueable, SerializesModels; // TAMBAHKAN SerializesModels DI SINI

    public $reply;
    public $subscription;

    public function __construct(Reply $reply, ?Subscription $subscription)
    {
        $this->reply = $reply;
        $this->subscription = $subscription;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new NewReplyEmail($this->reply, $this->subscription))
            ->to($notifiable->emailAddress(), $notifiable->name());
    }

    public function toDatabase($notifiable)
    {
        return [
            'type'              => 'new_reply',
            'reply'             => $this->reply->id(),
            'replyable_id'      => $this->reply->replyable_id,
            'replyable_type'    => $this->reply->replyable_type,
            'replyable_subject' => $this->reply->replyAble()->replyAbleSubject(),
        ];
    }
}
