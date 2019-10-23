<?php

namespace App\Modules\Admin\User\Jobs;

use App\Models\User;
use App\Notifications\User\SendAuthSmsCodeNotifications;
use App\Services\User\UserNotifications;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendAuthSmsCode implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 1;

    private $user;

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
    public function handle(UserNotifications $userNotifications)
    {
        $this->user->notify((new SendAuthSmsCodeNotifications(
            $userNotifications->getContentSmsCode($this->user)
        )));
    }
}
