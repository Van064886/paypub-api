<?php

namespace App\Http\Controllers\API;

use App\Core\Enterprises\Repositories\Interfaces\EnterpriseRepositoryInterface;
use App\Core\Enterprises\Requests\AddEnterpriseRequest;
use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\EnterpriseResource;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
            return $this->successResponse(data: new EnterpriseResource($enterprise));
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
