<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UnitController extends Controller
{
    //

    //
    public  function __construct()
    {
        $this->path = 'unit.';
    }

    public  function  index(){
        $units = Unit::all();
        return view($this->path.'index',compact('units'));
    }

    public  function  store(Request $request){
        try{
            $unit = new Unit();

            $unit->name = $request->name;
            $unit->slug = Str::slug($request->name);
            $unit->status = $request->status;
            $unit->save();
            DB::commit();
            Toastr::success('message', 'Unit create  Success');
            return redirect()->route('unit.index');
        }catch (\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }


    public function  edit($id){
        $unit = Unit::find($id);
        return view($this->path.'index',compact('unit'));
    }

    public  function  update(Request $request){
        $unit = Unit::find($request->id);
        $unit->name  = $request->name;
        $unit->slug = Str::slug($request->name);
        $unit->status = $request->status;
        $unit->save();
        DB::commit();
        Toastr::success('message', 'Unit Update  Success');
        return redirect()->route('unit.index');
    }

    public  function  active($id){
        $unit = Unit::find($id);
        $unit->status = 'Active';
        $unit->save();
        Toastr::success('Success', 'Unit  Active Success');
        return redirect()->back();
    }

    public  function  inactive($id){
        $unit = Unit::find($id);
        $unit->status = 'Inactive';
        $unit->save();
        Toastr::success('Success', 'Unit  InActive Success');
        return redirect()->back();
    }

    public  function  delete($id){
        $unit = Unit::findOrFail($id);
        $unit->delete();
        Toastr::success('Success', 'Unit  Delete Success');
        return redirect()->back();
    }
}
