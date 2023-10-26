<?php

namespace App\Http\Controllers\API;

use App\Core\ActivitySectors\ActivitySector;
use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\ActivitySectorResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ActivitySectorsController extends ApiBaseController
{
    /**
     * Class construct
     */
    public function __construct()
    {}

    public function getAll(): JsonResponse
    {
        $result = ActivitySector::all();
        return $this->successResponse(data: ActivitySectorResource::collection($result));
    }
}
