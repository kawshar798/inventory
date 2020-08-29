<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SupplierController extends Controller
{
    //

    public  function  __construct()
    {
        $this->path = 'supplier.';

    }
    public  function  index(){
 $suppliers =  Supplier::where('status','Active')->get();
        return view($this->path.'index',compact('suppliers'));
    }

    public  function  create(Request $request){
        if($request->isMethod('post')){
            try{
                $supplier = new Supplier();
                $supplier->name  = $request->name;


                $slug =  Str::slug( $request->name );
                if ($request->hasFile( 'image' ) ) {
                    $image = $request->image;
                    $file_name = $slug . "." . $image->getClientOriginalExtension();
                    $path = 'public/backend/assets/uploads/image/supplier/';
                    if ( !file_exists( $path ) ) {
                        mkdir( $path, 0777, true );
                    }
                    $image->move( $path, $file_name );
                    $supplier->image = $path.$file_name;
                }

                $supplier->business_name  = $request->business_name;
                $supplier->vat_number  = $request->vat_number;
                $supplier->email  = $request->email;
                $supplier->phone_number  = $request->phone_number;
                $supplier->address  = $request->address;
                $supplier->city  = $request->city;
                $supplier->state  = $request->state;
                $supplier->postal_code  = $request->postal_code;
                $supplier->country  = $request->country;
                $supplier->status  = 'Active';
                $supplier->save() ;
                DB::commit();
                $output = ['success' => true,
                    'messege'            => "Suppler  Create success",
                ];
                return $output;

            }catch (\Exception $e){
                DB::rollBack();
                return $e->getMessage();

            }

        }
        return view($this->path.'create');
    }

    public function active($id){
        $supplier = Supplier::find( $id );
        $supplier->status = 'Active';
        $supplier->save();
        $output = ['success' => true,
            'messege'            => "Supplier Active success",
        ];
        return $output;
    }

    public function inactive($id){
        $supplier = Supplier::find( $id );
        $supplier->status = 'Inactive';
        $supplier->save();
        $output = ['success' => true,
            'messege'            => "Supplier InActive success",
        ];
        return $output;
    }

    public function delete( $id ) {
        $supplier = Supplier::find( $id );
        if (file_exists($supplier->image)) {
            unlink( $supplier->image );
        }

        $supplier->delete();
        $output = ['success' => true,
            'messege'            => "Supplier Delete success",
        ];
        return $output;
    }

}
