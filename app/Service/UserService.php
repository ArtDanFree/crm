<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 12.03.19
 * Time: 14:39
 */

namespace App\Service;


class UserService
{
    public function birthdayIsComingSoon($birthdays)
    {
        $birthdays->transform(function ($item) {
            $item->date = $item->birthday->isoFormat('Do MMMM YYYY');
            $item->when = $item->birthday->year(date('Y'))->diffForHumans();
            $item->age = now()->longAbsoluteDiffForHumans($item->birthday);

            return $item;
        });
        return $birthdays;
    }
}