<?php
namespace App\Mail;

use App\Models\Expense;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExpenseCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $expense;

    public function __construct(Expense $expense)
    {
        $this->expense = $expense;
    }

    public function build()
    {
        return $this
            ->subject('Despesa cadastrada')
            ->markdown('emails.expenses.created');
    }
}
