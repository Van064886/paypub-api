<?php

namespace App\Core\AdsSharingHistories\Repositories;
use App\Core\AdsSharingHistories\AdsSharingHistory;
use App\Core\AdsSharingHistories\Repositories\Interfaces\AdsSharingHistoryRepositoryInterface;
use App\Core\BaseRepository;

class AdsSharingHistoryRepository extends  BaseRepository implements AdsSharingHistoryRepositoryInterface
{
    /**
     * Class constructor
     */
    public function __construct()
    {
        parent::__construct(new AdsSharingHistory());
    }
}
