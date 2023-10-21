<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiBaseController;
use App\Http\Resources\UserResource;
use App\Core\Users\Repositories\Interfaces\UserRepositoryInterface;
use App\Core\Users\Requests\UpdateUserRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends ApiBaseController
{
    /**
     * Class constructor
     */
    public function __construct(private UserRepositoryInterface $userRepo
    ) {}


    /**
     * Show user
     * @param int $id
     * @return JsonResponse
     */
    public function showUser(int $id): JsonResponse
    {
        return $this->successResponse(data: new UserResource($this->userRepo->show($id)));
    }

    /**
     * Delete user
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteUser(Request $request): JsonResponse
    {
        // Retrieve the user
        $user = $request->user();

        // Send unauthorized response if the concerned user is an admin
        if ($user->is_admin) {
            return $this->errorResponse(
                message: "Un compte administrateur ne peut être supprimé !",
                code: 403
            );
        }

        // Delete and send response
        if ($this->userRepo->delete($user))
            return $this->successResponse();
        else
            return $this->errorResponse();
    }


    /**
     * Search user by params
     * @param string $type
     * @param Request $request
     * @return JsonResponse
     */
    public function searchUsersByParams(Request $request): JsonResponse
    {
        $params = [];

        $users = $this->userRepo->findByParams(
            $request->all(),
            $request->get("per_page", 20),
            $request->get("page", 1),
            $request->get("order_by", "id")
        );

        return $this->successResponse(data: UserResource::collection($users)->resource);
    }


    /**
     * Update user profile
     * @param UpdateUserRequest $request
     * @return JsonResponse
     */
    public function updateProfile(UpdateUserRequest $request): JsonResponse
    {
        // Get the authenticated user
        $user = $request->user();
        $datas = $request->all();

        // Update it's profile with the datas
        DB::beginTransaction();

        try {
            $updatedUser = $this->userRepo->update($user, $datas);

            DB::commit();
            return $this->successResponse(data: new UserResource($updatedUser));
        } catch (Exception $e) {
            DB::rollback();
            return $this->errorResponse();
        }
    }
}
