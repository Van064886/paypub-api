<?php

namespace App\Http\Controllers\API;

use App\Core\Enterprises\Enterprise;
use App\Core\Enterprises\Repositories\Interfaces\EnterpriseRepositoryInterface;
use App\Core\Enterprises\Requests\AddEnterpriseRequest;
use App\Core\Enterprises\Requests\SearchEnterpriseRequest;
use App\Core\Enterprises\Requests\UpdateEnterpriseRequest;
use App\Http\Controllers\ApiBaseController;
use App\Http\Resources\EnterpriseResource;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Enterprises
 * @authenticated
 */
class EnterpriseController extends ApiBaseController
{
    /**
     * Class constructor
     */
    public function __construct(private EnterpriseRepositoryInterface $enterpriseRepo)
    {
    }

    /**
     * Add new enterprise
     *
     * @param AddEnterpriseRequest $request
     * @return JsonResponse
     */
    public function addEnterprise(AddEnterpriseRequest $request): JsonResponse
    {
        $requestDatas = $request->validated();
        try {
            $requestDatas["owner"] = $request->user()->id;
            $enterprise = $this->enterpriseRepo->add($requestDatas);
            $enterprise->load('owner', 'activitySector');
            return $this->successResponse(data: new EnterpriseResource($enterprise), code: 201);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * Check if user is allowed to proceed
     *
     * @param mixed $request
     * @param Enterprise $enterprise
     * @return JsonResponse | null
     */
    public function checkUserAuthorization(mixed $request, Enterprise $enterprise): JsonResponse | null
    {
        $user = $request->user();
        if ($user->id !== $enterprise->owner && !$user->is_admin)
            return $this->errorResponse('Action non autorisée', 403);
        else return null;
    }

    /**
     * Update an enterprise informations
     *
     * @param Enterprise $enterprise
     * @param UpdateEnterpriseRequest $request
     * @return JsonResponse
     */
    public function updateEnterprise(Enterprise $enterprise, UpdateEnterpriseRequest $request): JsonResponse
    {
        // Check if user is allowed to proceed
        $authorizationResult = $this->checkUserAuthorization($request, $enterprise);
        if (!is_null($authorizationResult)) return $authorizationResult;

        // Update enterprise
        $requestDatas = $request->validated();
        try {
            $enterprise = $this->enterpriseRepo->update($enterprise, $requestDatas);
            $enterprise->load('owner', 'activitySector');
            return $this->successResponse(data: new EnterpriseResource($enterprise));
        } catch (Exception $e) {
            return $this->errorResponse();
        }
    }

    /**
     * List all enterprise with filter
     *
     * @param SearchEnterpriseRequest $request
     * @return JsonResponse
     */
    public function allEnterprises(SearchEnterpriseRequest $request): JsonResponse
    {
        $requestDatas = $request->validated();
        return $this->successResponse(data: EnterpriseResource::collection(
            $this->enterpriseRepo->listEnterprises(
                $requestDatas,
                $request->input('order_by', 'id'),
                $request->input('per_page', 20),
                $request->input('page', 1),
                $request->user()->is_admin,
                $request->user()->id
            )
        )->resource);
    }


    /**
     * Get a reservation
     *
     * @param Enterprise $enterprise
     * @param Request $request
     * @return JsonResponse
     */
    public function getEnterprise(Enterprise $enterprise, Request $request): JsonResponse
    {
        // Check if user is allowed to proceed
        $authorizationResult = $this->checkUserAuthorization($request, $enterprise);
        if (!is_null($authorizationResult)) return $authorizationResult;

        // Load datas and return enterprise
        $enterprise->load('owner', 'activitySector');
        return $this->successResponse(data: new EnterpriseResource($enterprise));
    }

    /**
     * Delete an enterprise
     *
     * @param Enterprise $enterprise
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteEnterprise(Enterprise $enterprise, Request $request): JsonResponse
    {
        // Check if user is allowed to proceed
        $authorizationResult = $this->checkUserAuthorization($request, $enterprise);
        if (!is_null($authorizationResult)) return $authorizationResult;

        // TODO: Check if the enterprise has an ongoing advertisement campaign
        try {
            $this->enterpriseRepo->deleteEnterprise($enterprise);
            return $this->successResponse();
        } catch (Exception $e) {
            return $this->errorResponse();
        }
    }
}
