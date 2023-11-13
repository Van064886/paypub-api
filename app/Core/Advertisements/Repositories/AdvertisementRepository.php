<?php

namespace App\Core\Advertisements\Repositories;

use App\Core\Advertisements\Advertisement;
use App\Core\Advertisements\Repositories\Interfaces\AdvertisementRepositoryInterface;
use App\Core\BaseRepository;
use App\Core\Tools\FileUploadTrait;
use Illuminate\Http\UploadedFile;
use Ramsey\Uuid\Uuid;

class AdvertisementRepository extends BaseRepository implements AdvertisementRepositoryInterface
{
    use FileUploadTrait;

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
        // Store the ads logo
        if (isset($requestDatas['picture']) && $requestDatas['picture'] instanceof UploadedFile) {
            $requestDatas["picture"] = $this->upload($requestDatas['picture'], 'ads');
        }

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
        // Update action type if it is provided
        if (isset($requestDatas['action_type']))
            $ads->action_type = $requestDatas['action_type'];

        // Update ads picture if it is provided
        if (isset($requestDatas['picture']) && $requestDatas['picture'] instanceof UploadedFile) {
            if (file_exists(public_path("logos/{$ads->picture}"))) {
                unlink(public_path("logos/{$ads->picture}"));
            }

            $requestDatas["picture"] = $this->upload($requestDatas['picture'], 'ads');
        }

        // Save changes and return ads
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
