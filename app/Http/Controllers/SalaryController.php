<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Salary;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{
    //
    public function __construct()
    {
        $this->path = 'salary.';

    }


    public  function  allAdvancedSalary(){

                $advanced_salaries = DB::table('advanced_salaries')
                    ->join('employees','advanced_salaries.employee_id','employees.id')
                    ->select('advanced_salaries.*','employees.*')
//                    ->orderBy('id','DESC')
                    ->get();

        return view($this->path.'all_advanced_salary',compact('advanced_salaries'));
    }




    public  function  addAdvanced(Request $request){

        if($request->isMethod('Post')){

            DB::beginTransaction();
            try {

                $month = $request->month;
                $employee_id = $request->employee_id;

                $existEmployee = DB::table('advanced_salaries')->where('month',$month)->where('employee_id',$employee_id)->first();

                if($existEmployee === NULL){
                    $salary =  new Salary();
                    $salary->employee_id = $request->employee_id;
                    $salary->month = $request->month;
                    $salary->year = $request->year;
                    $salary->advanced_salary = $request->advanced_salary;
                    $salary->save();
                    DB::commit();
                    Toastr::success('Success', 'Salary Give  Success');
                    return redirect()->route('salary.advanced.add');
                }else{
                    Toastr::error('Error', 'Oopss!!! Already Advanced Paid in this month ');
                    return redirect()->route('salary.advanced.add');
                }

            }catch (\Exception $e){
                DB::rollBack();
                return $e->getMessage();
            }
        }
        $employees = Employee::all();
        return view($this->path.'add_advanced_salary',compact('employees'));
    }


    public  function  paySalary(){
        $employees = Employee::all();
        return view($this->path.'pay_salary',compact('employees'));
    }
}
