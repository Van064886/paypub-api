<?php

namespace App\Core\CallToActions\Repostories;
use App\Core\BaseRepository;
use App\Core\CallToActions\CallToAction;
use App\Core\CallToActions\Repostories\Interfaces\CallToActionsRepositoryInterface;

class CallToActionsRepository extends BaseRepository implements CallToActionsRepositoryInterface
{
    /**
     * Class constructor
     */
    public function __construct()
    {
        parent::__construct(new CallToAction());
    }
}
