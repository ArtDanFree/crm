<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/


Broadcast::channel('user.{toUserId}', function ($user, $toUserId) {
    return (int)$user->id == (int)$toUserId;
});

Broadcast::channel('admins', function ($user) {
    return $user->hasRole('Администратор');
});

Broadcast::channel('underwriters', function ($user) {
    return $user->hasRole('Андеррайтер');
});

Broadcast::channel('underwriter.online', function ($user) {
    if ($user->hasRole('Частный инвестор')) {
        return ['id' => $user->id, 'full_name' => fullName($user)];

    } elseif ($user->hasRole('Андеррайтер')) {
        return ['id' => 'underwriter-' . $user->id, 'full_name' => fullName($user), 'underwriter' => true];
    }
});