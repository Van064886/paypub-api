<?php

namespace App\Core\ActivitySectors;

use App\Core\Enterprises\Enterprise;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ActivitySector extends Model
{
    use HasFactory;

    protected $fillable = [
        "name"
    ];

    // Relations
    public function enterprises(): HasMany
    {
        return $this->hasMany(Enterprise::class, "activity_sector");
    }
}
