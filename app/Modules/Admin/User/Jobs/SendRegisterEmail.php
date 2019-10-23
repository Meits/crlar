<?php
declare(strict_types=1);

namespace App\Modules\Admin\User\Jobs;

use App\Models\User;
use App\Notifications\RegisterNotification;
use Illuminate\Auth\Authenticatable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendRegisterEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Authenticatable
     */
    protected $user;

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
        $this->user->notify((new RegisterNotification()));
    }
}
