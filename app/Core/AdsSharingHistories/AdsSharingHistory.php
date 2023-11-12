<?php

namespace App\Core\AdsSharingHistories;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsSharingHistory extends Model
{
    use HasFactory;

    const ENTRIES = [
        "token",
        "gained_amount"
    ];

    protected $fillable = self::ENTRIES;
}
