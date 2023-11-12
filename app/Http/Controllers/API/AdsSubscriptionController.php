<?php

namespace App\Http\Controllers\API;

use App\Core\AdsSharingHistories\Repositories\Interfaces\AdsSharingHistoryRepositoryInterface;
use App\Core\AdsSubscriptions\Repositories\Interfaces\AdsSubscriptionRepositoryInterface;
use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdsSubscriptionController extends ApiBaseController
{
    /**
     * Class constructor
     */
    public function __construct(
        private AdsSubscriptionRepositoryInterface $adsSubscriptionRepo,
        private AdsSharingHistoryRepositoryInterface  $adsSharingHistoryRepo
    ) {
    }

    public function addSubscription(AddSubscriptionRequest $request)
}
