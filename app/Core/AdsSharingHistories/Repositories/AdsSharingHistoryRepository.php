<?php

namespace App\Core\AdsSharingHistories\Repositories;
use App\Core\AdsSharingHistories\AdsSharingHistory;
use App\Core\AdsSharingHistories\Repositories\Interfaces\AdsSharingHistoryRepositoryInterface;
use App\Core\AdsSubscriptions\AdsSubscription;
use App\Core\BaseRepository;
use App\Core\SocialMedias\SocialMedia;
use Ramsey\Uuid\Uuid;

class AdsSharingHistoryRepository extends  BaseRepository implements AdsSharingHistoryRepositoryInterface
{
    /**
     * Class constructor
     */
    public function __construct()
    {
        parent::__construct(new AdsSharingHistory());
    }

    /**
     * Create an ads subscription history
     *
     * @param AdsSubscription $adsSubscription
     * @return void
     */
    public function add(AdsSubscription $adsSubscription)
    {
        // Get the list of of social medias
        $socialsMedias = SocialMedia::get();

        foreach ($socialsMedias as $key => $socialMedia) {
            $history = new AdsSharingHistory();
            $history->token = Uuid::uuid4()->toString();
            $history->social_media_id = $socialMedia->id;
            $history->ads_subscription_id = $adsSubscription->id;
            $history->gained_amount = 0;
            $history->save();
        }
    }
}
