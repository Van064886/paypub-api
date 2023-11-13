<?php

namespace App\Core\AdsSubscriptions;

use App\Core\AdsSharingHistories\AdsSharingHistory;
use App\Core\Advertisements\Advertisement;
use App\Core\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AdsSubscription extends Model
{
    use HasFactory;

    const ENTRIES = [
    ];

    protected $fillable = self::ENTRIES;

    // Relations
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function advertisement(): BelongsTo
    {
        return $this->belongsTo(Advertisement::class);
    }

    public function sharingHistories(): HasMany
    {
        return $this->hasMany(AdsSharingHistory::class, 'ads_subscription_id');
    }
}
