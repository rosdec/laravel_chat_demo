<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\User;

Broadcast::channel('channel_for_everyone', function (User $user) {
    return true;
});
   