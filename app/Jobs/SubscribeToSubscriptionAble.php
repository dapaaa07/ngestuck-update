<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Subscription;
use App\Models\SubscriptionAble;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SubscribeToSubscriptionAble implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // WAJIB UBAH MENJADI PUBLIC
    public $user;
    public $subscriptionAble;

    public function __construct(User $user, SubscriptionAble $subscriptionAble)
    {
        $this->user = $user;
        $this->subscriptionAble = $subscriptionAble;
    }

    public function handle()
    {
        $subscription = new Subscription();
        $subscription->userRelation()->associate($this->user);
        $this->subscriptionAble->subscriptionsRelation()->save($subscription);
    }
}
