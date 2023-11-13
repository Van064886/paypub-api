<?php

namespace App\Core\AdsSharingHistories\Repositories\Interfaces;

use App\Core\AdsSubscriptions\AdsSubscription;

interface AdsSharingHistoryRepositoryInterface
{
    public function add(AdsSubscription $adsSubscription);
}
