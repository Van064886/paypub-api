<?php

namespace App\Core\Advertisements\Repositories\Interfaces;

use App\Core\Advertisements\Advertisement;
use Illuminate\Pagination\LengthAwarePaginator;

interface AdvertisementsRepositoryInterface
{
    public function add(array $requestDatas): Advertisement;

    public function update(Advertisement $ads, array $requestDatas): Advertisement;

    public function delete(Advertisement $ads): mixed;

    public function allWithPagination(string $orderBy = 'id', int $page = 1, int $perPage = 10): LengthAwarePaginator;
}
