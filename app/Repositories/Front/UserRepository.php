<?php

namespace App\Repositories\Front;

use App\Models\Front\User;
use App\Repositories\AbstractRepository;

class UserRepository extends AbstractRepository
{
    /**
     * @var User
     */
    protected $model;

    /**
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
