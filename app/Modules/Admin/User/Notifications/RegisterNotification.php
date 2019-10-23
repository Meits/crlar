<?php
declare(strict_types=1);

namespace App\Modules\Admin\User\Notifications;

use App\Models\Email;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\DB;

class RegisterNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $system_email;
    private $settings;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {

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
        
        $emailTemplate = Email::where('type','1')->first();

        $emailContent = $emailTemplate->template;

        $emailContent = str_replace('%firstname%',$notifiable->firstname,$emailContent);
        $emailContent = str_replace('%lastname%',$notifiable->lastname,$emailContent);
        $emailContent = str_replace('%confirm%','<a href="'.route('register.confirm',array('token'=>$notifiable->token)).'">'.route('register.confirm',array('token'=>$notifiable->token)).'</a>',$emailContent);

        return (new MailMessage)
            ->view('public::mail.confirm',
                [
                    'emailContent' => $emailContent,
                    'settings' => $this->settings
                ]
            )
            ->from($this->system_email)
            ->subject(__('auth.register_subject'));
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
