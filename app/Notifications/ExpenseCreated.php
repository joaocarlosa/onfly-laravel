<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ExpenseCreated extends Notification implements ShouldQueue
{
    use Queueable;

    protected $expense;

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
                ->subject('Despesa Cadastrada')
                ->line('Uma nova despesa foi cadastrada.')
                ->line('Descrição: ' . $this->expense->description)
                ->line('Valor: ' . $this->expense->value);
    }
}
