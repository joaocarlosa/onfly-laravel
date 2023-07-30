<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\ExpenseRequest;


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

        return response()->json($expense);
    }

    public function update(ExpenseRequest $request, $id)
    {
        
        $expense = Expense::where('id', $id)
                            ->where('user_id', auth()->id())
                            ->firstOrFail();

        $expense->update($request->only(['description', 'value']));

        return response()->json($expense);
        
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();

        return response()->json(['success' => 'Excluído com sucesso'], 200);

    }
}
