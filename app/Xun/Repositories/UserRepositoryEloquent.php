<?php

namespace App\Xun\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Xun\Repositories\Interfaces\UserRepository;
use App\User;

/**
 * Class UsersRepositoryEloquent
 * @package namespace App\Xun\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function isRegisterPlatform($platform ,$platform_id)
    {
        return (bool)($this->findWhere(['platform_id' => $platform_id, 'register_platform' => $platform])->first());
    }

    public function isNameExist($name)
    {
        return (bool)($this->findWhere(['name' => $name])->first());
    }

    public function isApiTokenExist($api_token)
    {
        return (bool)($this->findWhere(['api_token' => $api_token])->first());
    }
}
