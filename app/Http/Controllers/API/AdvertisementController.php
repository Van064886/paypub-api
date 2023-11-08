<?php

namespace App\Http\Controllers\API;

use App\Core\Advertisements\Advertisement;
use App\Core\Advertisements\Repositories\Interfaces\AdvertisementsRepositoryInterface;
use App\Core\Advertisements\Requests\AddAdvertisementRequest;
use App\Core\Advertisements\Requests\UpdateAdvertisementRequest;
use App\Http\Controllers\ApiBaseController;
use App\Http\Resources\AdvertisementResource;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdvertisementController extends ApiBaseController
{
    /**
     * Class construct
     */
    public function __construct(private AdvertisementsRepositoryInterface $advertisementsRepo)
    {
    }


    /**
     * Add new advertisement
     *
     * @param AddAdvertisementRequest $request
     * @return JsonResponse
     */
    public function add(AddAdvertisementRequest $request): JsonResponse
    {
        try {
            $ads = $this->advertisementsRepo->add($request->validated());
            return $this->successResponse(data: $ads, code: 201);
        } catch (Exception $e) {
            return $this->errorResponse();
        }
    }

    /**
     * Check if user can handle ads
     *
     * @param mixed $request
     * @param Advertisement $ads
     * @return mixed
     */
    public function canHandleAds(mixed $request, Advertisement $ads): mixed
    {
        $user = $request->user();
        if (($ads->enterprise->owner->id !== $user->id) || $user->is_admin) {
            return $this->errorResponse(message: "Action non autorisée !", code: 403);
        } else return null;
    }


    /**
     * Update an advertisement
     *
     * @param UpdateAdvertisementRequest $request
     * @param Advertisement $advertisement
     * @return JsonResponse
     */
    public function update(UpdateAdvertisementRequest $request, Advertisement $advertisement): JsonResponse
    {
        // Check if the user is allowed to proceed
        $canHandle = $this->canHandleAds($request, $advertisement);
        if (!is_null($canHandle)) return $canHandle;

        // Proceed update
        try {
            $ads = $this->advertisementsRepo->update($advertisement, $request->validated());
            return $this->successResponse();
        } catch (Exception $e) {
            return $this->errorResponse();
        }
    }

    /**
     * List all the advertisements
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function listAll(Request $request): JsonResponse
    {
        $response = $this->advertisementsRepo->allWithPagination(
            $request->input('order_by', 'id'),
            $request->input('page', 1),
            $request->input('per_page', 10)
        );

        return $this->successResponse(data: AdvertisementResource::collection($response)
            ->resource);
    }

    /**
     * Get enterprise by id
     *
     * @param Request $request
     * @param Advertisement $advertisement
     * @return JsonResponse
     */
    public function get(Request $request, Advertisement $advertisement): JsonResponse
    {
        // Check if the user is allowed to proceed
        $canHandle = $this->canHandleAds($request, $advertisement);
        if (!is_null($canHandle)) return $canHandle;

        // Send response
        return $this->successResponse(data: new AdvertisementResource($advertisement));
    }

    /**
     * Delete an advertisement
     *
     * @param Request $request
     * @param Advertisement $advertisement
     * @return JsonResponse
     */
    public function delete(Request $request, Advertisement $advertisement): JsonResponse
    {
        // Check if the user is allowed to proceed to the deletion
        $canHandle = $this->canHandleAds($request, $advertisement);
        if (!is_null($canHandle)) return $canHandle;

        // Proceed deletion
        try {
            $this->advertisementsRepo->delete($advertisement);
            return $this->successResponse();
        } catch (Exception $e) {
            return $this->errorResponse();
        }
    }
}
