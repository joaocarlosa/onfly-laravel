<?php

namespace App\Http\Controllers\API;

use App\Models\Expense;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExpenseResource;
use Illuminate\Http\Request;
use App\Notifications\ExpenseCreated;
use App\Http\Requests\StoreExpenseRequest;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::all();
        return ExpenseResource::collection($expenses);
    }

    public function store(StoreExpenseRequest $request)
    {
        $validatedData = $request->validated();
        $expense = Expense::create($validatedData);

        try {
            $expense->user->notify(new ExpenseCreated($expense));
        } catch (\Exception $e) {
            return (new ExpenseResource($expense))->additional([
                'error' => 'Error sending email notification',
                'message' => $e->getMessage(),
            ]);
        }

        return new ExpenseResource($expense);
    }

    public function show(Expense $expense)
    {
        return new ExpenseResource($expense);
    }

    public function update(StoreExpenseRequest $request, Expense $expense)
    {
        $expense->update($request->validated());
        return new ExpenseResource($expense);
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();
        return response()->json('Successful', 204);
    }

}

