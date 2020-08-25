<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseCategory extends Controller
{
    //

    protected  $path;

    public  function __construct()
    {
        $this->path = 'expense.';
    }
    public  function  index(){
        $expenses = Expense::all();
        return view($this->path.'expense_category',compact('expenses'));
    }
}
