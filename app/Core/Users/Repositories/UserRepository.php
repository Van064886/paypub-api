<?php

namespace App\Core\Users\Repositories;

use App\Core\BaseRepository;
use App\Core\Tools\FileUploadTrait;
use App\Core\Users\Repositories\Interfaces\UserRepositoryInterface;
use App\Core\Users\User;
use App\Core\UsersTokens\UsersTokens;
use App\Mail\UserVerificationCodeMail;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Mail;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    use FileUploadTrait;

    /**
     *
     * @param User $model
     */
    public function __construct()
    {
        parent::__construct(new User());
    }

    /**
     * Register new user
     *
     * @param array $array
     * @return mixed
     */
    public function register(array $datas): User
    {
        // Store the picture
        if (isset($datas['picture']) && $datas['picture'] instanceof UploadedFile) {
            $datas["picture"] = $this->upload($datas['picture'], 'users');
        }

        // Filling datas into user model
        $user = $this->model->make($datas);
        $user->password = bcrypt($datas['password']);

        // Save datas and return user
        $user->save();

        return $user;
    }

    /**
     * Send verification code to user
     * @param User
     * @param string $subject
     * @param string $type
     */
    public function sendVerificationCode(User $user, string $subject, string $type)
    {
        $desc = "";
        $type === "verify" ? $desc = "account_verification" : $desc = "reset_password";
        // Generate the code
        $code = rand(100000, 999999);

        // Save the code
        $dateTime = new DateTime();
        $userToken = new UsersTokens();
        $userToken->type = $desc;
        $userToken->token = $code;
        $userToken->expiration_date = $dateTime->modify('+5 minutes');
        $userToken->user()->associate($user);
        $userToken->save();

        // Send the code
        Mail::to($user->email)->send(new UserVerificationCodeMail($user, $code, $subject));
    }

    /**
     * Reset user password
     * @param User $user
     * @param string $type
     * @return User
     */
    public function ResetPassword(User $user, string $password): User
    {
        $user->password = bcrypt($password);
        $user->save();
        return $user;
    }

    /**
     * Show a user
     * @param int $id
     * @return User
     */
    public function show(int $id): User
    {
        $user =  $this->model
            ->where('users.id', $id)
            ->first();

        if (is_null($user))
            throw new ModelNotFoundException("Model non trouvé");

        return $user;
    }

    /**
     * Update an user
     * @param User $user
     * @param array $array
     * @return User
     */
    public function update(User $user, array $params): User
    {
        // Collect datas except the picture
        $data = collect($params)->except(['picture', 'is_admin']);

        // Store the picture
        if (isset($params['picture']) && $params['picture'] instanceof UploadedFile) {
            $data["picture"] = $this->upload($params['picture'], 'users');
        }

        // Remove verification from account when the email changes
        if (isset($params['email']))
            $user->email_verified_at = null;

        // Save user changes
        $user->update($data->all());

        return $user;
    }


    /**
     * Delete user
     * @param User $user
     * @return bool
     */
    public function delete(User $user): bool
    {
        return $user->delete();
    }


    /**
     * Find user by email
     * @param string email
     * @return User | Model
     */
    public function findByEmail(string $email): User | Model
    {
        return $this->findBy("email", $email);
    }

    /**
     * Find user By id
     * @param int $id
     * @return User | Model
     */
    public function findUserById(int $id): User | Model
    {
        return $this->findBy("id", $id);
    }

    /**
     * Find user code
     * @param UsersTokens $model
     * @param int $userId
     * @param string $code
     * @param string $type
     */
    public function findCodeByUser(UsersTokens $model, int $userId, string $code, string $type)
    {
        $usercode = UsersTokens::where('type', '=', $type)
            ->where('user_id', '=', $userId)
            ->where('used_at', '=', null)
            ->where('token', '=', $code)
            ->get();

        if (count($usercode) === 0)
            return null;
        else
            return $usercode[count($usercode) - 1];
    }


    /**
     * Check if user is allowed to request code
     * @param UsersTokens $utokens
     * @param int $userId
     * @param string $type
     * @return bool
     */
    public function isAllowedToRequestCode(UsersTokens $utokens, int $userId, string $type): bool
    {
        $result = $utokens->where("user_id", "=", $userId)
            ->whereRaw("DATE(created_at) = DATE(NOW())")
            ->where("type", $type)
            ->get();

        return count($result) >= 3;
    }


    /**
     * Find users by params
     * @param array $params
     * @param int $perPage
     * @param int $page
     * @param string $country
     * @return LengthAwarePaginator
     */
    public function findByParams(array $params, int $perPage, int $page, string $order_by): LengthAwarePaginator
    {
        $result = User::where(collect($params)->except('name')->all())
            ->when(isset($params["name"]), function ($query) use ($params) {
                $query->whereRaw("CONCAT(users.firstname, ' ', users.lastname) LIKE ?", ['%' . $params["name"] . '%']);
            })
            ->orderBy($order_by, "DESC")
            ->paginate(perPage: $perPage, page: $page);

        return $result;
    }
}
