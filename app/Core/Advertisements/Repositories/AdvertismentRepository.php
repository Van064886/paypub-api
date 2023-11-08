<?php

namespace App\Core\Advertisements\Repositories;

use App\Core\Advertisements\Advertisement;
use App\Core\Advertisements\Repositories\Interfaces\AdvertisementsRepositoryInterface;
use App\Core\BaseRepository;
use Ramsey\Uuid\Uuid;

class AdvertisementsRepository extends BaseRepository implements AdvertisementsRepositoryInterface
{
    /**
     * Class constructor
     */
    public function __construct()
    {
        parent::__construct(new Advertisement());
    }

    /**
     * Add an advertisement
     *
     * @param array $requestDatas
     * @return Advertisement
     */
    public function add(array $requestDatas): Advertisement
    {
        $ads = $this->model->make($requestDatas);
        $ads->reference = Uuid::uuid4()->toString();
        $ads->enterprise_id = $requestDatas['enterprise_id'];
        $ads->action_type = $requestDatas['action_type'];
        $ads->save();
        return $ads;
    }

    /**
     * Update an advertisement
     *
     * @param Advertisement $ads
     * @param array $requestDatas
     * @return Advertisement
     */
    public function update(Advertisement $ads, array $requestDatas): Advertisement
    {
        if (isset($requestDatas['action_type']))
            $ads->action_type = $requestDatas['action_type'];

        $ads->update($requestDatas);
        return $ads;
    }


    /**
     * Delete an advertisement
     *
     * @param Advertisement $ads
     * @return mixed
     */
    public function delete(Advertisement $ads): mixed
    {
        return $ads->delete();
    }
}
