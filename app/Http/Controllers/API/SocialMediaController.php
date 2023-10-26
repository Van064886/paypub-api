<?php

namespace App\Http\Controllers\API;

use App\Core\SocialMedias\SocialMedia;
use App\Http\Controllers\ApiBaseController;
use App\Http\Resources\SocialMediaResource;
use Illuminate\Http\JsonResponse;


/**
 * @group Social medias
 * @authenticated
 */
class SocialMediaController extends ApiBaseController
{
    /**
     * Class constructor
     */
    public function __construct()
    {
    }

    /**
     * Get the list of social medias
     *
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $result = SocialMedia::all();
        return $this->successResponse(data: SocialMediaResource::collection($result));
    }
}
