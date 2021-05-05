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
    protected $verifyUrl;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($applicant, $verifyUrl)
    {
        $this->applicant = $applicant;
        $this->verifyUrl = $verifyUrl;
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
                    ->subject('⚡ [ECAM] Application Verification Required')
                    ->greeting('Hey there!')
                    ->line('
                        You need to verify your email before you proceed to fill up your application details.
                        This is a mandatory step & cannot be skipped. On successful verification, please complete your application further when prompted.
                    ')
                    ->line('
                        Given below is your application unique identifier.
                        This can be used in reference with the staff when there is some issue with your application.
                    ')
                    ->line('UUID: **' . $this->applicant->uuid . '**')
                    ->action('Verify Email 🚀', $this->verifyUrl)
                    ->line('In case you haven\'t requested this operation, please ignore this email. If you possess any queries, please contact us at [' . config('app.va_email') . '].');   
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
