<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 07.03.19
 * Time: 9:46
 */

namespace App\Repositories;


use App\Models\User;

class UserRepository extends CoreRepository
{

    /**
     * @return mixed
     */
    protected function getModelClass()
    {
        return User::class;
    }

    /**
     * @param $days
     * @return mixed
     */

    public function birthdayIsComingSoon($days = null)
    {
        $columns = ['id', 'birthday'];

        $result = $this->startConditions()
            ->whereRaw('DAYOFYEAR(curdate()) <= DAYOFYEAR(birthday)')
            ->orderByRaw('DAYOFYEAR(birthday)')
            ->select($columns)
            ->addSelect(\DB::raw('CONCAT(last_name, " ", first_name, " ", surname) AS full_name'))
            ->limit($days)
            ->get();

        return $result;
    }

}