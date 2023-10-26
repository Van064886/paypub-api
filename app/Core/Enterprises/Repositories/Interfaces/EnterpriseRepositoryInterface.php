<?php

namespace App\Core\Enterprises\Repositories\Interfaces;

use App\Core\Enterprises\Enterprise;
use Illuminate\Pagination\LengthAwarePaginator;

interface EnterpriseRepositoryInterface
{
    public function add(array $requestDatas): Enterprise;

    public function update(Enterprise $enterprise, array $requestDatas): Enterprise;

    public function listEnterprises(
        array $requestDatas,
        string $orderBy,
        int $perPage,
        int $page,
        bool $isAdmin = false,
        int $userId = null
    ): LengthAwarePaginator;
    public function deleteEnterprise(Enterprise $enterprise): bool | null;
}
