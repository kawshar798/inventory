<?php

namespace App\Http\Controllers;


use App\Models\Employee;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use File;

class EmployeeController extends Controller
{
    //
    public function __construct()
    {
        $this->path = 'employee.';

    }

    public function index()
    {
        $employees = Employee::orderBy('id', 'DESC')->get();
        return view($this->path . 'index', compact('employees'));
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $validateData = $request->validate([
//                    'email' => 'required|unique:employees|max:255',
//                    'nid_no' => 'required|unique:employees|max:255'
            ]);
            DB::beginTransaction();
            try {

                if ($request->id) {
                    $employee = Employee::find($request->id);
                } else {
                    $employee = new Employee();
                }

                $employee->name = $request->name;
                $employee->email = $request->email;
                $employee->phone = $request->phone;
                $employee->city = $request->city;
                $employee->address = $request->address;
                $employee->nid_no = $request->nid_no;
                $employee->vacation = $request->vacation;
//
                if ($request->hasfile('photo')) {
                    $image = $request->photo;
                    $extension = $image->getClientOriginalExtension();
                    $image_name = Str::slug($request->name) . "-" . time() . "." . $extension;
                    $path = 'public/images/employee/';
                    if (!file_exists($path)) {
                        mkdir($path, 0777, true);
                    }
                    $image->move($path, $image_name);

                    //delete old image
                    if ($employee->photo) {
                        unlink($employee->photo);
                    }
                    $employee->photo = $path . $image_name;
                }
                //update same database image
                if ($employee->photo) {
                    $employee->photo = $employee->photo;
                }

                $employee->salary = $request->salary;
                $employee->experience = $request->experience;
                $employee->save();
                DB::commit();
                if ($request->id) {
                    Toastr::success('message', 'Employee Update  Success');
                } else {
                    Toastr::success('message', 'Employee Create Success');
                }
                return redirect()->route('employee.index');

            } catch (\Exception $e) {
                DB::rollBack();
                return $e->getMessage();
            }
        }

        //view form
        return view($this->path . 'create');
    }


    public function edit($id)
    {
        $employee = Employee::find($id);
        return view($this->path . 'create', compact('employee'));
    }

    public function  delete($id){
        $employe =  Employee::find($id);
       unlink($employe->photo);//Delete photo from folder
        Toastr::success('message', 'Employee Delete Success');
        $employe->delete();
        return redirect()->route('employee.index');
    }


}
