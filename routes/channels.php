<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

//Premade channel created by laravel
// Broadcast::channel('users.{id}', function (User $user, $id) {
        //id sent from client
//     Log::info('id ='.$id);
        //logged in user
//     Log::info('user ='.$user);
//     return (int) $user->id === (int) $id;
// });


//Example Broadcast Channel
Broadcast::channel('example',function(){
});

Broadcast::channel('adminNotification',function(User $user){
    if($user->type == 1){
        return true;
    }
    else{
        return false;
    }
});