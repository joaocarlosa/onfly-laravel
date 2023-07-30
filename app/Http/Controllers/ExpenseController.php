<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreExpenseRequest;


class ExpenseController extends Controller
{
    public function index()
    {
        return Expense::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'value' => 'required',
        ]);
    
        $expense = new Expense;
        $expense->description = $request->description;
        $expense->value = $request->value;
        $expense->user_id = $request->user()->id;
        $expense->save();
    
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
