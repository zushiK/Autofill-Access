<?php

namespace App\Services\Front;

use App\Repositories\Front\UserRepository;
use App\Services\AbstractService;

class UserService extends AbstractService
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
}
