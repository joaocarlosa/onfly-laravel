<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Expense;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExpenseTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_fillable_fields()
    {
        $fillable = ['value', 'description', 'user_id'];
        $expense = new Expense();

        $this->assertEquals($fillable, $expense->getFillable());
    }
}
