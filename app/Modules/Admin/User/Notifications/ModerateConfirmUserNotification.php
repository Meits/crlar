<?php

namespace App\Modules\Admin\User\Notifications;

use App\Models\Email;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ModerateConfirmUserNotification extends Notification
{
    use Queueable;

    private $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;

        $this->system_email = Setting::where('field','system_email')->first()->value;
        $this->settings = Setting::all();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $emailTemplate = Email::where('type','5')->first();

        $emailContent = $emailTemplate->template;

        $emailContent = str_replace('%reset%',"<a href='".url('password/reset', $this->token)."'>". __('public.title_link_reset_password') ."</a>",$emailContent);

        return (new MailMessage)
            ->view('public::mail.confirm',
                [
                    'emailContent' => $emailContent,
                    'settings' => $this->settings
                ]
            )
            ->from($this->system_email)
            ->subject(__('public.moderate_confirm_profile_subject'));
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
