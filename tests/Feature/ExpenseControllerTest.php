<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExpenseControllerTest extends TestCase
{
    use RefreshDatabase; 

    public function test_unauthenticated_user_cannot_view_expenses()
    {
        $response = $this->getJson('/api/expenses');
        $response->assertStatus(500);
    }
}
