<?php

namespace App\Core\Enterprises\Repositories;

use App\Core\BaseRepository;
use App\Core\Enterprises\Enterprise;
use App\Core\Enterprises\Repositories\Interfaces\EnterpriseRepositoryInterface;

class EnterpriseRepository extends BaseRepository implements EnterpriseRepositoryInterface
{
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
     * @param integer $owner
     * @param integer $sector
     * @return Enterprise
     */
    public function add(array $requestDatas, int $owner, int $sector): Enterprise
    {
        $enterprise = $this->model->make($requestDatas);
        $enterprise->owner = $owner;
        $enterprise->sector = $sector;
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
        if (isset($requestDatas["activity_sector"]))
            $enterprise->activity_sector = $requestDatas["activity_sector"];

        $enterprise->update($requestDatas);
        return $enterprise;
    }

    public function listEnterprises(array $requestDatas, string $orderBy, int $perPage, int $page, bool $is_admin = false, int $userId = null): array
    {
        // $enterprises = $this->model->where("", $userId)->orderBy($orderBy,
    }
}
