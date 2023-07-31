<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Http\Requests\ExpenseRequest;
use App\Notifications\ExpenseCreated;
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
            $request->user()->notify(new ExpenseCreated($expense));
            $notifyMessage = 'Notificação enviada com sucesso!';
        } catch (\Exception $e) {
            $notifyMessage = 'Falha ao enviar notificação: ' . $e->getMessage();
        }
    
        return response()->json(['expense' => $expense, 'notifyMessage' => $notifyMessage], 201);

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
