<?php

namespace App\Core\AdsSubscriptions\Repositories;

use App\Core\AdsSubscriptions\AdsSubscription;
use App\Core\AdsSubscriptions\Repositories\Interfaces\AdsSubscriptionRepositoryInterface;
use App\Core\Advertisements\Advertisement;
use App\Core\BaseRepository;
use App\Core\Users\User;
use Illuminate\Pagination\LengthAwarePaginator;

class AdsSubscriptionRepository extends BaseRepository implements AdsSubscriptionRepositoryInterface
{
    /**
     * Class constructor
     */
    public function __construct()
    {
        parent::__construct(new AdsSubscription());
    }

    /**
     * Add new ads subscription
     *
     * @param User $user
     * @param Advertisement $advertisement
     * @return AdsSubscription
     */
    public function add(User $user, Advertisement $advertisement): AdsSubscription
    {
        $adsSubscription = $this->model;
        $adsSubscription->user_id = $user->id;
        $adsSubscription->advertisement_id = $advertisement->id;
        $adsSubscription->save();
        return $adsSubscription;
    }

    /**
     * Return the list of all subscriptions
     *
     * @param string $orderBy
     * @param integer $perPage
     * @param integer $page
     * @param integer|null $user
     * @param integer|null $ads
     * @return LengthAwarePaginator
     */
    public function listAllSubscriptions(
        string $orderBy,
        int $perPage,
        int $page,
        int $user = null,
        int $ads = null
    ): LengthAwarePaginator {
        return $this->model->with(['user', 'advertisement'])
            ->when(!is_null($user), function ($query) use ($user) {
                $query->where("user_id", $user);
            })->when(!is_null($ads), function ($query) use ($ads) {
                $query->where("advertisement_id", $ads);
            })->orderBy($orderBy, "DESC")->paginate(perPage: $perPage, page: $page);
    }

    /**
     * Delete an ads subscription
     *
     * @param AdsSubscription $adsSubscription
     * @return void
     */
    public function delete(AdsSubscription $adsSubscription): bool | null
    {
        return $adsSubscription->delete();
    }
}
