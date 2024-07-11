<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class customerController extends Controller
{
    public function customer(){
        $customer = DB::table('customer')->paginate(5);
        return view('admin.customer',['customer'=>$customer]);
    }

    public function addCustomer(){
        return view('admin/addCustomer');
    }

    public function addCustomerSubmit(Request $data){
        try{
            DB::table('customer')->insert([
                'name'   => $data->name,
                'gender' => $data->gender,
                'email'  => $data->email,
                'phone'  => $data->phone,
                'address'=> $data->address,
                'status' => $data->status
            ]);
            return redirect('/admin/customer')->with('insert','success');
        }catch(Exception $ex){
            // return $ex;
            return redirect('/admin/add-customer')->with('error','error');
        }
    }

    public function editCustomer($id){
        $customer = DB::table('customer')->where('id',$id)->first();
        return view('admin.editCustomer',['customer'=>$customer]);
    }

    public function editCustomerSubmit($id,Request $data){
        try{
            DB::table('customer')->where('id',$id)->update([
                'name'   => $data->name,
                'gender' => $data->gender,
                'email'  => $data->email,
                'phone'  => $data->phone,
                'address'=> $data->address,
                'status' => $data->status
            ]);
            return redirect('/admin/customer')->with('edit','success');
        }catch(Exception $ex){
            // return $ex;
            return redirect('/admin/add-customer')->with('error','error');
        }
    }

    public function deleteCustomer($id){
        try{
            DB::table('customer')->where('id',$id)->delete();
            return redirect('/admin/customer')->with('delete','success');
        }catch(Exception $ex){
            return redirect('/admin/customer')->with('error','error');
        }
    }
}
