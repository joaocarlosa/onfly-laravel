<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Http\Requests\ExpenseRequest;
use App\Http\Controllers\Controller;
use App\Notifications\ExpenseCreated;

class ExpenseController extends Controller
{
    

    public function index()
    {
        return Expense::all();
    }

    public function store(Request $request, Expense $expense)
    {
        $request->validate([
            'description' => 'required',
            'value' => 'required',
        ]);

        $expense->description = $request->description;
        $expense->value = $request->value;
        $expense->user_id = $request->user()->id;
        $expense->save();

        try {
            $request->user()->notify(new ExpenseCreated($expense));
            $notifyMessage = 'Sent with success';
        } catch (\Exception $e) {
            $notifyMessage = 'Sending failed: ' . $e->getMessage();
        }

        return response()->json(['expense' => $expense, 'emailMessage' => $notifyMessage], 201);
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
        return response()->json(['success' => 'successfully deleted'], 200);
    }

}