<?php

namespace App\Modules\Admin\User\Jobs;

use App\Models\User;
use App\Notifications\ModerateConfirmUserNotification;
use App\Notifications\ModerateUserNotification;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;

class SendModerateEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user = null;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $users = User::whereHas('roles',function($q) {
            $q->where('alias','administrator');
        })->get();
        Notification::send($users, new ModerateUserNotification($this->user));

    }
}
