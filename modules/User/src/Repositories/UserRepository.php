<?php

namespace Modules\User\src\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Modules\User\src\Models\User;
use Modules\User\src\Repositories\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @return string
     */
    public function getModel()
    {
        return User::class;
    }

    /**
     * @param $limit
     *
     * @return mixed
     */
    public function getUsers($limit)
    {
        return $this->model->paginate($limit);
    }

    /**
     * @param $password
     * @param $id
     *
     * @return false|mixed
     */
    public function setPassword($password, $id)
    {
        return $this->update($id, ['password' => Hash::make($password)]);
    }
    public function getAllUsers()
    {
        return $this->model->select(['id', 'name', 'email', 'group_id', 'created_at']);
    }
    public function checkPassword($password, $id)
    {
        $user = $this->find($id);
        if ($user) {
            $hashPassword = $user->password;
            return Hash::check($password, $hashPassword);
        }
        return false;
    }
}
