<?php

namespace App\Core\Users\Repositories\Interfaces;

use App\Core\Users\User;
use App\Core\UsersTokens\UsersTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    // Auth functions //
    public function register(array $datas): User;

    public function sendVerificationCode(User $user, string $subject, string $type);

    public function ResetPassword(User $user, string $password): User;

    // Core functions
    public function show(int $id): User;

    public function update(User $user, array $array): User;

    public function delete(User $user): bool;

    public function findByEmail(string $email): User | Model;

    public function findUserById(int $id): User | Model;

    public function findCodeByUser(UsersTokens $model, int $userId, string $code, string $type);

    public function isAllowedToRequestCode(UsersTokens $utokens, int $userId, string $type): bool;

    public function findByParams(array $params, int $perPage, int $page, string $order_by): LengthAwarePaginator;
}
