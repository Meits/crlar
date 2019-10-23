<?php

namespace App\Modules\Admin\User\Notifications;

use App\Models\Email;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    use Queueable;

    private $token;
    private $system_email;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
        $this->system_email = Setting::where('field','system_email')->first()->value;
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

        $linkTitle = "Link";
        if($notifiable->is_register) {
            $emailTemplate = Email::where('type','2')->first();
            $linkTitle = __("public.title_link_password");
        }
        else {
            $emailTemplate = Email::where('type','3')->first();
            $linkTitle = __("public.title_link_reset_password");
        }

        $emailContent = $emailTemplate->template;

        $emailContent = str_replace('%reset%',"<a href='".url('password/reset', $this->token)."'>" . $linkTitle . "</a>",$emailContent);
        $emailContent = str_replace('%name%',$notifiable->firstname,$emailContent);

        return (new MailMessage)
            ->view('public::mail.common-content',
                [
                'token' => $this->token,
                'emailContent' => $emailContent
                ]
            )
            ->from($this->system_email)
            ->subject(__("public.password_reset_email_subject"));

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
