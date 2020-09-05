<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseCategory;
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
        $expense_categories = ExpenseCategory::all();
        return view($this->path.'index',compact('expenses','expense_categories'));
    }

    public  function  store(Request $request){
      DB::beginTransaction();
        try{
            if($request->id){
                $expense  = Expense::find($request->id);
            }else{
                $expense          = New Expense();
            }
            $expense->expense_category  = $request->expense_category;
            $expense->amount  = $request->amount;
            $expense->month   = $request->month;
            $expense->date    = $request->date;
            $expense->note    = $request->note;
            $expense->save();
            DB::commit();
            $output = ['success' => true,
                'messege'            => "Expense   Create success",
            ];
            return $output;
        }catch (\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }
}
