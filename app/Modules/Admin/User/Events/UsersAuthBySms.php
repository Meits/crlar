<?php

namespace App\Modules\Admin\User\Events;

use App\Models\User;
use App\Services\User\UserService;
use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UsersAuthBySms
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    private $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->setUserSmsCode();
    }


    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    private function setUserSmsCode()
    {
        if($this->user) {
            UserService::setSmsCode($this->user, mt_rand(1000, 9999), Carbon::now()->addMinutes(15));
        }
    }
}
