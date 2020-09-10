<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    //
    protected  $path;
    public  function __construct()
    {
        $this->path = 'coupon.';
    }

    public function  index(){
        $coupons = Coupon::all();
        return view($this->path.'index',compact('coupons'));
    }

    public function  create(Request $request){
        DB::beginTransaction();
        try{
            if($request->id){
                $coupon = Coupon::find($request->id);
            }else{
                $coupon = new Coupon();
            }
            $coupon->code = $request->code;
            $coupon->amount = $request->amount;
            $coupon->start_date = $request->start_date;
            $coupon->end_date = $request->end_date;
            $coupon->status = $request->status;
            $coupon->save();
            DB::commit();
            if($request->id){
                $output = ['success' => true,
                    'messege'            => "Coupon  Update success",
                ];
            }else{
                $output = ['success' => true,
                    'messege'            => "Coupon  Create success",
                ];
            }
            return  $output;
        }catch (\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }


    public function  delete($id){
        $coupon = Coupon::find($id);
        $coupon->delete();
        $output = ['success' => true,
            'messege'            => "Coupon  Delete success",
        ];
        return $output;
    }
}
