<?php

namespace App\Core\AdsSubscriptions\Repositories;
use App\Core\AdsSubscriptions\AdsSubscription;
use App\Core\AdsSubscriptions\Repositories\Interfaces\AdsSubscriptionRepositoryInterface;
use App\Core\BaseRepository;

class AdsSubscriptionRepository extends BaseRepository implements AdsSubscriptionRepositoryInterface
{
    /**
     * Class constructor
     */
    public function __construct()
    {
        parent::__construct(new AdsSubscription());
    }
}
