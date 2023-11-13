<?php

namespace App\Core\SocialMedias;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SocialMedia extends Model
{
    use HasFactory;

    protected $table = "social_medias";

    protected $fillable = [
        "name"
    ];

    // Relations
    public function linkedHistories(): HasMany
    {
        return $this->hasMany(SocialMedia::class);
    }
}
