<?php

namespace App\Core\Enterprises\Repositories;

use App\Core\BaseRepository;
use App\Core\Enterprises\Enterprise;
use App\Core\Enterprises\Repositories\Interfaces\EnterpriseRepositoryInterface;
use App\Core\Tools\FileUploadTrait;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;

class EnterpriseRepository extends BaseRepository implements EnterpriseRepositoryInterface
{
    use FileUploadTrait;

    /**
     * Class constructor
     */
    public function __construct()
    {
        parent::__construct(new Enterprise());
    }

    /**
     * Add an enteprise
     *
     * @param array $requestDatas
     * @return Enterprise
     */
    public function add(array $requestDatas): Enterprise
    {
        // Store the enterprise logo
        if (isset($requestDatas['logo']) && $requestDatas['logo'] instanceof UploadedFile) {
            $requestDatas["logo"] = $this->upload($requestDatas['logo'], 'logos');
        }

        // Fill datas in model and save
        $enterprise = $this->model->make($requestDatas);
        $enterprise->owner = $requestDatas['owner'];
        $enterprise->activity_sector = $requestDatas['activity_sector'];

        $enterprise->save();
        return $enterprise;
    }

    /**
     * Update an enterprise
     *
     * @param Enterprise $enterprise
     * @param array $requestDatas
     * @return Enterprise
     */
    public function update(Enterprise $enterprise, array $requestDatas): Enterprise
    {
        // Update activity sector if it is provided
        if (isset($requestDatas["activity_sector"]))
            $enterprise->activity_sector = $requestDatas["activity_sector"];

        // Update the enterprise the enterprise logo if it is provided
        if (isset($requestDatas['logo']) && $requestDatas['logo'] instanceof UploadedFile) {
            if (file_exists(public_path("logos/{$enterprise->logo}"))) {
                unlink(public_path("logos/{$enterprise->logo}"));
            }

            $requestDatas["logo"] = $this->upload($requestDatas['logo'], 'logos');
        }

        // Update and return enterprise
        $enterprise->update($requestDatas);
        return $enterprise;
    }


    /**
     * List all enterprises with filter
     *
     * @param array $requestDatas
     * @param string $orderBy
     * @param integer $perPage
     * @param integer $page
     * @param boolean $isAdmin
     * @param integer|null $userId
     * @return LengthAwarePaginator
     */
    public function listEnterprises(
        array $requestDatas,
        string $orderBy,
        int $perPage,
        int $page,
        bool $isAdmin = false,
        int $userId = null
    ): LengthAwarePaginator {
        $enterprises = $this->model->with(['owner', 'activitySector'])
            ->where($requestDatas)->when(
                !$isAdmin,
                function ($query) use ($userId) {
                    $query->where("owner", $userId);
                }
            );

        if (isset($requestDatas["name"]))
            $enterprises->where("name", "LIKE", "%" . $requestDatas["name"] . "%");

        return $enterprises->orderBy($orderBy, "DESC")
            ->paginate(perPage: $perPage, page: $page);
    }

    /**
     * Delete an enterprise
     *
     * @param Enterprise $enterprise
     * @return bool | null
     */
    public function deleteEnterprise(Enterprise $enterprise): bool | null
    {
        return $enterprise->delete();
    }
}
