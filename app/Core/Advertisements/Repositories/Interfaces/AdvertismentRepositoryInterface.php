<?php

namespace App\Core\Advertisements\Repositories\Interfaces;

use App\Core\Advertisements\Advertisement;

interface AdvertisementsRepositoryInterface
{
    public function add(array $requestDatas): Advertisement;

    public function update(Advertisement $ads, array $requestDatas): Advertisement;

    public function delete(Advertisement $ads): mixed;
}
