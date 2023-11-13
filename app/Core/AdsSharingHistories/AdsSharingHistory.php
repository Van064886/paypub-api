<?php

namespace App\Core\AdsSharingHistories;

use App\Core\AdsSubscriptions\AdsSubscription;
use App\Core\SocialMedias\SocialMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdsSharingHistory extends Model
{
    use HasFactory;

    const ENTRIES = [
        "token",
        "gained_amount"
    ];

    protected $fillable = self::ENTRIES;

    // Relations
    public function adsSubscription(): BelongsTo
    {
        return $this->belongsTo(AdsSubscription::class);
    }

    public function socialMedia(): BelongsTo
    {
        return $this->belongsTo(SocialMedia::class);
    }
}
