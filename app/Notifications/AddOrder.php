<?php

namespace App\Notifications;

use App\Invoice;
use App\Person;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AddOrder extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public  $user_invoice;
    public  $user;
    public function __construct(Invoice $user_invoice,Person $user)
    {
        $this->invoice=$user_invoice;
        $this->user=$user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
//    public function toMail($notifiable)
//    {
//        return (new MailMessage)
//                    ->line('The introduction to the notification.')
//                    ->action('Notification Action', url('/'))
//                    ->line('Thank you for using our application!');
//    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [

           // 'data' =>'New Order Added By:'   .$this->user->first_name,
        ];
    }
    public function toDatabase($notifiable)
    {
        return [

            'data' =>'New Order Added By:' .$this->user->first_name,
            'user' =>$this->user->first_name,
        ];
    }
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([

            'data' =>'New Order Added By:' .$this->user->first_name,
            'user' =>$this->user->first_name,
        ]);
    }
}
