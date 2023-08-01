<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_fillable_fields()
    {
        $fillable = ['name', 'email', 'password'];
        $user = new User();

        $this->assertEquals($fillable, $user->getFillable());
    }

    public function test_it_hides_password()
    {
        $hidden = ['password'];
        $user = new User();

        $this->assertEquals($hidden, $user->getHidden());
    }
}
