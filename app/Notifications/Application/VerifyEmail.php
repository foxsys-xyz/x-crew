<?php

namespace App\Notifications\Application;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyEmail extends Notification implements ShouldQueue
{
    use Queueable;

    protected $applicant;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($applicant)
    {
        $this->applicant = $applicant;
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
        return (new MailMessage)
                    ->subject('🟡 [ECAM] Application Verification Required')
                    ->greeting('Hey there!')
                    ->line('
                        You need to verify your email before you proceed to fill up your application details.
                        This is a mandatory step & cannot be skipped. On successful verification, please complete your application further when prompted.
                        Here is your application UUID just in case [' . $applicant->uuid . ']
                    ')
                    ->action('Verify Email', $verifyUrl)
                    ->line('In case you haven\'t requested this operation, please ignore this email. If you possess any queries, please contact us at [hr@emirates-virtual.com].');   
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
