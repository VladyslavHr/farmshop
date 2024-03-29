<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


class OrderClientStoreSend extends Notification
{
    use Queueable;

    public $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $path = public_path('logo/logoimg.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data_img = file_get_contents($path);
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($data_img);
        $logoUrl = asset('logo/logoimg.png');
        return (new MailMessage)
            ->subject('Замовлення №' . $this->order->id)
            ->markdown('emails.orders.store', [
                'order' => $this->order,
                'logo' => $logo,
                'logoUrl' => $logoUrl,
            ]);
        // return (new MailMessage)
        //             ->line('The introduction to the notification.')
        //             ->action('Notification Action', url('/'))
        //             ->line('Thank you for using our application!');
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
