<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Http\Requests\ExpenseRequest;
use App\Mail\ExpenseCreated;
use Illuminate\Support\Facades\Mail;

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
            Mail::to($request->user())->send(new ExpenseCreated($expense));
        } catch (\Exception $e) {
            $emailMessage = 'Falha ao enviar o e-mail: ' . $e->getMessage();
        }

        return response()->json(['expense' => $expense, 'emailMessage' => $emailMessage], 201);

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
