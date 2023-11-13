<?php

namespace App\Http\Controllers\API;

use App\Core\AdsSharingHistories\Repositories\Interfaces\AdsSharingHistoryRepositoryInterface;
use App\Core\AdsSubscriptions\Repositories\Interfaces\AdsSubscriptionRepositoryInterface;
use App\Core\AdsSubscriptions\Requests\AddSubscriptionRequest;
use App\Core\AdsSubscriptions\Requests\FilterAdsSubscriptionRequest;
use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    /**
     * Add subscription
     *
     * @param AddSubscriptionRequest $request
     * @return JsonResponse
     */
    public function addSubscription(AddSubscriptionRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            // Proceed to subscription
            $adsSubscription = $this->adsSubscriptionRepo->add($request->validated());

            // Generate subscription socials trackers
            $this->adsSharingHistoryRepo->add($adsSubscription);
            $adsSubscription->load('sharingHistories');
            DB::commit();
            return $this->successResponse();
        } catch(Exception $e) {
            DB::rollBack();
            return $this->errorResponse();
        }
    }

    // public function all(FilterAdsSubscriptionRequest $request): JsonResponse
    // {
    //     $requestDatas = $request->validated();
    //     $subscriptions = $this->adsSubscriptionRepo->listAllSubscriptions(
    //         $request->input(),
    //     );
    // }
}
