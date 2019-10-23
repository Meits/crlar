<?php

namespace App\Modules\Admin\User\Jobs;

use App\Models\User;
use App\Notifications\ModerateConfirmUserNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendModerateConfirmEmail implements ShouldQueue
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
        $token = app(PasswordBroker::class)->createToken($this->user);
        $this->user->notify((new ModerateConfirmUserNotification($token)));

    }
}
