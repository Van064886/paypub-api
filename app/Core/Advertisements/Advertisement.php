<?php

namespace App\Core\Advertisements;

use App\Core\CallToActions\CallToAction;
use App\Core\Enterprises\Enterprise;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Advertisement extends Model
{
    use HasFactory;

    const ENTRIES = [
        "name",
        "reference",
        "description",
        "action_content",
        "start_date",
        "end_date",
        "picture"
    ];

    protected $fillable = self::ENTRIES;

    // Relations
    public function actionType(): BelongsTo
    {
        return $this->belongsTo(CallToAction::class, "action_type");
    }

    public function enterprise(): BelongsTo
    {
        return $this->belongsTo(Enterprise::class, "enterprise_id");
    }

    // public function adsSubscriptions(): HasMany
    // {
    //     return $this->hasMany(AdsSubscription::class, "advsertisements_id");
    // }
}
