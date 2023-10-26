<?php

namespace App\Core\Enterprises;

use App\Core\ActivitySectors\ActivitySector;
use App\Core\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enterprise extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "balance"
    ];

    // Relations
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, "owner");
    }

    public function activitySector(): BelongsTo
    {
        return $this->belongsTo(ActivitySector::class,"activity_sector");
    }
}
