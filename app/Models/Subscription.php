<?php

namespace App\Models;

use App\Models\User;
use App\Models\SubscriptionAble;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'subscriptions';
    protected $with = ['userRelation', 'subscriptionAbleRelation'];

    // Tambahkan ? (nullable) agar aman jika suatu saat user dihapus
    public function user(): ?User
    {
        return $this->userRelation;
    }

    public function userRelation(): BelongsTo
    {
        // Ubah B besar menjadi b kecil sesuai bawaan fungsi Laravel
        return $this->belongsTo(User::class, 'user_id');
    }

    // Tambahkan ? (nullable)
    public function subscriptionAble(): ?SubscriptionAble
    {
        return $this->subscriptionAbleRelation;
    }

    public function subscriptionAbleRelation(): MorphTo
    {
        return $this->morphTo('subscriptionAbleRelation', 'subscriptionable_type', 'subscriptionable_id');
    }
}
