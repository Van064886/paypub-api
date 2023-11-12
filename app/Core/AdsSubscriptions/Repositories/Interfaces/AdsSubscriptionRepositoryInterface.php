<?php

namespace App\Core\AdsSubscriptions\Repositories\Interfaces;

use App\Core\AdsSubscriptions\AdsSubscription;
use App\Core\Advertisements\Advertisement;
use App\Core\Users\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface AdsSubscriptionRepositoryInterface
{
    public function add(User $user, Advertisement $advertisement): AdsSubscription;

    public function listAllSubscriptions(
        string $orderBy,
        int $perPage,
        int $page,
        int $user = null,
        int $ads = null
    ): LengthAwarePaginator;

    public function delete(AdsSubscription $adsSubscription): bool | null;
}
