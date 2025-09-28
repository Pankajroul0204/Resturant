<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingNotification extends Notification
{
    use Queueable;
    protected $bookingData;
    /**
     * Create a new notification instance.
     */
    public function __construct($bookingData)
    {
        $this->bookingData = $bookingData;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //         ->line('The introduction to the notification.')
    //         ->action('Notification Action', url('/'))
    //         ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'booking_id' => $this->bookingData->id,
            'name' => $this->bookingData->name,
            'email' => $this->bookingData->email,
            'contact_no' => $this->bookingData->contact_no,
            'number_of_people' => $this->bookingData->number_of_people,
            'booking_datetime' => $this->bookingData->booking_datetime,
            'event_id' => $this->bookingData->event_id,
            'special_request' => $this->bookingData->special_request,
            'created_at' => $this->bookingData->created_at,
        ];
    }
}
