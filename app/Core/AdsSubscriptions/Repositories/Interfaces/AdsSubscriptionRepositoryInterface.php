<?php

namespace App\Core\AdsSubscriptions\Repositories\Interfaces;

use App\Core\AdsSubscriptions\AdsSubscription;
use Illuminate\Pagination\LengthAwarePaginator;

interface AdsSubscriptionRepositoryInterface
{
    public function add(array $requestDatas): AdsSubscription;

    public function canSubscribe(int $user, int $ads): bool;

    public function listAllSubscriptions(
        string $orderBy,
        int $perPage,
        int $page,
        int $user = null,
        int $ads = null
    ): LengthAwarePaginator;

    public function delete(AdsSubscription $adsSubscription): bool | null;
}
