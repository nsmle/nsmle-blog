<?php

use Illuminate\Support\Facades\Broadcast;
use App\Broadcasting\NotifyChannel;

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

/*
Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
*/


Broadcast::channel('notify-event.{userId}', function($user, $userId) {
    return $user->id == $userId;
});

Broadcast::channel('chat-event.{roomId}', function($user, $roomId) {
    if ($user->canJoinRoom($roomId)) {
        return ['roomId' => $roomId];
    }
});

Broadcast::channel('post-event', function () {
    return true;
});



Broadcast::channel('user-followed', function() {
    return true;
}, ['middleware' => ['auth:sanctum']]);
