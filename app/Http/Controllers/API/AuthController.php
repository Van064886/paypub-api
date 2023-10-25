<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiBaseController;
use App\Http\Resources\UserResource;
use App\Core\Users\Repositories\Interfaces\UserRepositoryInterface;
use App\Core\Users\Requests\ChangePasswordWithCodeRequest;
use App\Core\Users\Requests\LoginRequest;
use App\Core\Users\Requests\RegisterUserRequest;
use App\Core\Users\Requests\RequestValidationCodeRequest;
use App\Core\Users\Requests\ResetPasswordRequest;
use App\Core\Users\Requests\ValidateUserAccountRequest;
use App\Core\UsersTokens\UsersTokens;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * @group Authentication
 * @authenticated
 */
class AuthController extends ApiBaseController
{
    /**
     * Create a new controller instance.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        private UserRepositoryInterface $userRepo
    ) {
    }

    /**
     * Register user
     *
     * @param  RegisterUserRequest $request
     * @return JsonResponse
     */
    public function register(RegisterUserRequest $request): JsonResponse
    {
        // Start transaction
        DB::beginTransaction();

        try {
            $user = $this->userRepo->register($request->validated());
            $this->userRepo->sendVerificationCode($user, "Code de vérification de compte", "verify");

            // Commit changes and send response
            DB::commit();

            return $this->successResponse("Création de compte reussie", 201, new UserResource($user));
        } catch (Exception $e) {
            // Rollback and send response
            DB::rollBack();
            return $this->errorResponse($e);
        }
    }

    /**
     * Activate user account
     *
     * @param ValidateUserAccountRequest $request
     * @return JsonResponse
     */
    public function validateUserAccount(ValidateUserAccountRequest $request): JsonResponse
    {
        // Find user with the given email
        $user = $this->userRepo->findByEmail($request->email);

        if (!is_null($user->email_verified_at))
            return $this->errorResponse("Ce compte est déja validé", 422, []);

        // Find the code
        $user_token = $this->userRepo->findCodeByUser(
            new UsersTokens(),
            $user->id,
            $request["code"],
            'account_verification'
        );


        if ($user_token !== null) {
            // Check if the code is expired or not
            if ($user_token->expiration_date > $user_token->created_at) {
                // Expire the code and active user account
                $user_token->used_at = now();
                $user_token->save();

                $user->email_verified_at = now();
                $user->save();

                return $this->successResponse("Compte validé avec succès", 200, []);
            } else
                return $this->errorResponse("Ce code a déja expiré", 422, []);
        } else
            return $this->errorResponse(
                "Veuillez renseigner des données correctes !",
                404,
                []
            );
    }


    /**
     * Request validation code
     * @param RequestValidationCodeRequest $request
     * @return JsonResponse
     */
    public function requestValidationCode(RequestValidationCodeRequest $request): JsonResponse
    {
        // Get the user and send the code
        $user = $this->userRepo->findByEmail($request->email);

        // Check if the user account is already verified and proceed
        if ($user->email_verified_at !== null)
            return $this->errorResponse("Ce compte a déja été validé", 403, []);

        // Check if the is allowed to request code
        if ($this->userRepo->isAllowedToRequestCode(
            new UsersTokens(),
            $user->id,
            "account_verification"
        ))
            return $this->errorResponse(
                "Vous avez atteint la limite de demande de code pour cette journée. Veuillez réessayer dans 24 heures.",
                403,
                []
            );


        $this->userRepo->sendVerificationCode($user, "Code de vérification de compte", "verify");
        return $this->successResponse(
            "Le code a été envoyé sur votre adresse mail",
            200,
            []
        );
    }


    /**
     * Password forgotten
     * @param RequestValidationCodeRequest
     * @return JsonResponse
     */
    public function passwordForgotten(RequestValidationCodeRequest $request): JsonResponse
    {
        // Get user and send code
        $user = $this->userRepo->findByEmail($request['email']);

        // Check if the is allowed to request code
        if ($this->userRepo->isAllowedToRequestCode(
            new UsersTokens(),
            $user->id,
            "reset_password"
        ))
            return $this->errorResponse(
                "Vous avez atteint la limite de demande de code pour cette journée. Veuillez réessayer dans 24 heures.",
                403,
                []
            );

        $this->userRepo->sendVerificationCode($user, "Code de vérification de compte", "reset");
        return $this->successResponse(
            "Le code a été envoyé sur votre adresse mail",
            200,
            []
        );
    }

    /**
     * Change password with code
     * @param ChangePasswordWithCodeRequest $request
     * @return JsonResponse
     */
    public function changePasswordWithCode(ChangePasswordWithCodeRequest $request): JsonResponse
    {
        // Find user with the given email
        $user = $this->userRepo->findByEmail($request["email"]);

        // Find the code
        $user_token = $this->userRepo->findCodeByUser(new UsersTokens(), $user->id, $request["code"], 'reset_password');

        if (!is_null($user_token)) {
            // Check if the code is expired or not
            if ($user_token->expiration_date > $user_token->created_at) {
                // Start transaction
                DB::beginTransaction();
                try {
                    // Expire the code and change the password
                    $user_token->used_at = now();
                    $user_token->save();

                    $user->password = bcrypt($request['password']);
                    $user->save();

                    // Commit changes and send response
                    DB::commit();
                    return $this->successResponse(code: 200);
                } catch (Exception $e) {
                    // Rollback and send response
                    DB::rollBack();
                    return $this->errorResponse();
                }
            } else
                return $this->errorResponse(
                    "Le code renseigné a déja expiré !",
                    422,
                    []
                );
        } else
            return $this->errorResponse("Code invalide !", 404, []);
    }


    /**
     * Log user in
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        if (Auth::attempt($request->only(["email", "password"]))) {
            // Get the user
            $user = $request->user();

            // Check if user can login and proceed
            if (is_null($user->email_verified_at))
                return $this->errorResponse(
                    "Vous devez vérifier votre compte avant de pouvoir vous connecter",
                    403,
                    []
                );

            // Generate token and send response
            $token =  $user->createToken('userToken')->plainTextToken;

            return $this->successResponse(
                "Connexion effectuée avec succès !",
                200,
                [
                    "user" => new UserResource($user),
                    "token" => $token
                ]
            );
        } else
            return $this->errorResponse("Identifiants incorrects", 422, []);
    }


    /**
     * Logout user
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $user = $request->user();
        // Deconnect the user
        if ($user->currentAccessToken()->delete()) {
            return $this->successResponse("Déconnexion effectuée avec succès !");
        } else
            return $this->errorResponse();
    }

    /**
     * Reset password
     * @param ResetPasswordRequest
     * return JsonResponse
     */
    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        // Get the connected user
        $user = $request->user();

        // Check if the given password matches before resetting the password
        if (Hash::check($request->old_password, $user->password)) {
            $data = $this->userRepo->ResetPassword($user, $request->new_password);
            if ($data) {
                // Disable all user active tokens
                $user->tokens()->delete();

                return $this->successResponse();
            } else
                return $this->errorResponse();
        } else
            return $this->errorResponse("Les données fournies sont incorrectes !", 403, []);
    }
}
