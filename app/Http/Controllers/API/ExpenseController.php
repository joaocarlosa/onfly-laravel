<?php

namespace App\Http\Controllers\API;

use App\Models\Expense;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExpenseResource;
use Illuminate\Http\Request;
use App\Notifications\ExpenseCreated;
use App\Http\Requests\StoreExpenseRequest;
use Illuminate\Support\Facades\Auth;


class ExpenseController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $expenses = $user->expenses;
        return ExpenseResource::collection($expenses);
    }

    public function store(StoreExpenseRequest $request)
    {   
        $this->authorize('create', Expense::class);
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $expense = Expense::create($data);        

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
        $this->authorize('view', $expense);
        return new ExpenseResource($expense);
    }

    public function update(StoreExpenseRequest $request, Expense $expense)
    {        
        $this->authorize('update', $expense);        
        $expense->update($request->validated());        
        return new ExpenseResource($expense);
    }

    public function destroy(Expense $expense)
    {
        $this->authorize('delete', $expense);
        $expense->delete();
        return response()->json('Successful', 204);
    }

}

