<?php

namespace App\Http\Controllers\API;

use App\Models\Expense;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExpenseResource;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        return ExpenseResource::collection(Expense::all());
    }

    public function store(Request $request)
    {
        $expense = Expense::create($request->all());

        return new ExpenseResource($expense);
    }

    public function show(Expense $expense)
    {
        return new ExpenseResource($expense);
    }

    public function update(Request $request, Expense $expense)
    {
        $expense->update($request->all());

        return new ExpenseResource($expense);
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();

        return response()->json(null, 204);
    }
}

