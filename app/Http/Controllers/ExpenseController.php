<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreExpenseRequest;


class ExpensesController extends Controller
{
    public function index()
    {
        $expenses = Auth::user()->expenses;

        return response()->json($expenses);
    }

    public function store(StoreExpenseRequest $request)
    {
        $expense = Auth::user()->expenses()->create($request->validated());
        return response()->json($expense, 201);
    }

    public function show(Expense $expense)
    {
        
        if (Auth::id() !== $expense->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json($expense);
    }

    public function update(StoreExpenseRequest $request, Expense $expense)
    {
        
        if (Auth::id() !== $expense->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $expense->update($request->validated());

        return response()->json($expense);
    }

    public function destroy(Expense $expense)
    {
        if (Auth::id() !== $expense->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $expense->delete();

        return response()->json(null, 204);
    }
}
