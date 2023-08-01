<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Requests\StoreExpenseRequest;

class StoreExpenseRequestTest extends TestCase
{
    public function test_store_expense_request_validation()
    {
        $data = [
            'value' => 'invalid_value',
            'description' => str_repeat('a', 192), // maior que o máximo permitido (191 caracteres)
            'created_at' => 'invalid_date',
            'updated_at' => 'invalid_date',
        ];

        $request = new StoreExpenseRequest();
        $request->replace($data);

        $validator = $this->app['validator']->make($request->all(), $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('value'));
        $this->assertTrue($validator->errors()->has('description'));
        $this->assertTrue($validator->errors()->has('created_at'));
        $this->assertTrue($validator->errors()->has('updated_at'));
    }
}
