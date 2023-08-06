<?php

namespace Modules\User\src\Repositories;

use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    /**
     * @param $limit
     *
     * @return mixed
     */
    public function getUsers($limit);

    /**
     * @param $password
     * @param $id
     *
     * @return mixed
     */
    public function setPassword($password, $id);

    /**
     * @param $password
     * @param $id
     *
     * @return mixed
     */
    public function checkPassword($password, $id);
}
