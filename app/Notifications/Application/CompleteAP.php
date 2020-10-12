<?php

namespace App\Notifications\Application;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CompleteAP extends Notification implements ShouldQueue
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
                    ->subject('⚡ [ECAM] Application Complete')
                    ->greeting('Hey there!')
                    ->line('
                        Your application is now complete as per our database systems.
                    ')
                    ->line('
                        Please note, no further changes in the application will now be allowed.
                        However, in case your application gets accepted, you can make changes afterwards but only to \'non-critical\' data.
                    ')
                    ->line('You will receive an email as a follow up when your application is reviewed by the staff.')
                    ->line('
                        Given below is your application unique identifier.
                        This can be used in reference with the staff when there is some issue with your application.
                    ')
                    ->line('UUID: **' . $this->applicant->uuid . '**')
                    ->line('We sincerely thank you for taking interest in applying. If you possess any queries, please contact us at [' . env('VA_EMAIL') . '].');   
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
