<?php

namespace App\Modules\Admin\User\Notifications;

use App\Models\Email;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ModerateUserNotification extends Notification
{
    use Queueable;

    private $system_email;
    private $settings;
    private $user;

    /**
     * Create a new notification instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->system_email = Setting::where('field','system_email')->first()->value;
        $this->settings = Setting::all();

        $this->user = $user;
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
        $emailTemplate = Email::where('type','4')->first();

        $emailContent = $emailTemplate->template;

        $emailContent = str_replace('%link%',"<a href='".route('users.edit',['user' => $this->user->id])."'>". __('public.title_link_reset_password') ."</a>",$emailContent);
        
        return (new MailMessage)
            ->view('public::mail.common-content',
                [
                    'emailContent' => $emailContent,
                    'settings' => $this->settings
                ]
            )
            ->from($this->system_email)
            ->subject(__('public.moderate_profile_subject'));
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
