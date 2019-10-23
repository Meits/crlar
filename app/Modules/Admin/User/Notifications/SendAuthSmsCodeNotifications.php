<?php

namespace App\Modules\Admin\User\Notifications;

use App\Services\OrderNotification\SMSWrapperService;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendAuthSmsCodeNotifications extends Notification
{
    use Queueable;

    private $content;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [SMSWrapperService::class];
    }


    public function toSMS($notifiable) {

        return $this->content;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
