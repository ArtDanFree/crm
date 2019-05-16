<?php

use Carbon\Carbon;

/**
 * Удаляет из url https://
 * @param $url
 * @return mixed
 */
function friendlyURL($url)
{
    return str_replace('https://', '', $url);
}

/**
 * @param $user
 * Возвращает полное имя пользователя
 * @return string
 */
function fullName($user)
{
    return "$user->last_name $user->first_name $user->surname";
}

/**
 * Возвращает путь до Avatar user
 * @param \App\Models\User $user
 * @return string
 */
function srcAvatar(\App\Models\User $user)
{
    return $user->avatar ? asset('/storage/' . $user->avatar) : asset('img/noAvatar.jpg');
}

/**
 * @param $utc
 * @return string
 */
function utcToTimezone($utc)
{
    switch ($utc) {
        case 1:
            return 'Europe/Kaliningrad';
        case 2:
            return 'Europe/Moscow';
        case 3:
            return 'Europe/Samara';
        case 4:
            return 'Asia/Yekaterinburg';
        case 5:
            return 'Asia/Omsk';
        case 6:
            return 'Asia/Krasnoyarsk';
        case 7:
            return 'Asia/Irkutsk';
        case 8:
            return 'Asia/Yakutsk';
        case 9:
            return 'Asia/Vladivostok';
        case 10:
            return 'Asia/Srednekolymsk';

    }
}


/**
 * @param $userUtc
 * @param $time
 * @return Carbon|\Carbon\CarbonInterface
 */
function timeFromAuthUserTime($userUtc, $time)
{
    $time = str_replace(':', '', $time);
    $time = str_split($time, 2);

    $result = Carbon::createFromTime($time[0], $time[1], 0, utcToTimezone($userUtc))
        ->timezone(utcToTimezone(auth()->user()->utc))
        ->format('H:i');

    return $result;
}