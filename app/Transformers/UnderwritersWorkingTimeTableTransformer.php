<?php

namespace App\Transformers;

use App\Models\User;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class UnderwritersWorkingTimeTableTransformer extends TransformerAbstract
{

    /**
     * @param  User  $user
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'DT_RowId' => 'underwriter-'.$user->id,
            fullName($user),
            $this->getWorkingTime($user),
             '<b>offline</b>',
        ];
    }

    public function getWorkingTime(User $user)
    {
        if (filled($user->workingTime)) {
            $result = 'C '.timeFromAuthUserTime($user->utc,
                    $user->workingTime->from).' По '
                .timeFromAuthUserTime($user->utc, $user->workingTime->to);

            return $result;
        } else {
            return 'Не указано';
        }
    }
}