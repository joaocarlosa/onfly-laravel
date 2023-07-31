<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ExpenseCreated extends Notification
{
    use Queueable;

    private $expense;

    public function __construct($expense)
    {
        $this->expense = $expense;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Despesa cadastrada')
                    ->greeting('Olá!')
                    ->line('Uma nova despesa foi cadastrada.')
                    ->line('Descrição: ' . $this->expense->description)
                    ->line('Valor: ' . $this->expense->value);
    }

}
