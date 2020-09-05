<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseCategoryController extends Controller
{
    //
    protected  $path;

    public  function __construct()
    {
        $this->path = 'expense.';
    }

    public  function  index(){
        $expenses_Categories = ExpenseCategory::all();
        return view($this->path.'expense_category',compact('expenses_Categories'));
    }

    public function  store(Request $request){
//        return $request->all();
        DB::beginTransaction();
        try{
            if($request->id){
                $expenseCat  = ExpenseCategory::find($request->id);
            }else{
                $expenseCat = new ExpenseCategory();
            }
            $expenseCat->code = date("Ymd").'-'.date("his");
            $expenseCat->name =  $request->name;
            $expenseCat->save();
            DB::commit();
            $output = ['success' => true,
                'messege'            => "Expense Category  Create success",
            ];
            return $output;
        }catch (\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }


    public function  delete($id)
    {
        $expense_Cat = ExpenseCategory::find($id);
        $expense_Cat->delete();
        DB::commit();
        $output = ['success' => true,
            'messege'            => "Expense Category  Delete Success",
        ];
        return $output;

    }
}
