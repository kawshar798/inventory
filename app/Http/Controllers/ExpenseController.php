<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    //

    protected  $path;

    public  function __construct()
    {
        $this->path = 'expense.';
    }

    public  function  index(){
        $expenses = Expense::all();
        return view($this->path.'index',compact('expenses'));
    }

    public  function  store(Request $request){
      DB::beginTransaction();
        try{
            $expense          = New Expense();
            $expense->details = $request->details;
            $expense->amount  = $request->amount;
            $expense->month   = $request->month;
            $expense->date    = $request->date;
            $expense->save();
            DB::commit();
            Toastr::success('message', 'Expense create  Success');
            return redirect()->route('expense.index');
        }catch (\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }
}
