<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class supplierController extends Controller
{
    public function supplier(){
        $supplier = DB::table('supplier')->where('status',1)->get();
        return view('admin.viewSupplier',['supplier'=>$supplier]);
    }

    public function addSupplier(){
        return view('admin.addSupplier');
    }

    public function addSupplierSubmit(Request $data){
        $file = $data->file('image');
        if(empty($file))  return redirect('admin/add-supplier')->with('error','error');
        $image = $this->uploadImage($file);
        try{
           DB::table('supplier')->insert([
            'name'    => $data->name,
            'phone'   => $data->phone,
            'email'   => $data->email,
            'address' => $data->address,
            'note'    => $data->note,
            'photo'   => $image
           ]); 
           return redirect('/admin/supplier')->with('insert','success');
        }catch(Exception $ex){
            return redirect('admin/add-supplier')->with('error','error');
        }
    }

    public function supplierDetail($id){
        $detail = DB::table('supplier')->find($id);
        return view('admin.supplierDetail',['detail'=>$detail]);
    }

    public function deleteSupplier($id){
        DB::table('supplier')->where('id',$id)->update([
            'status' => 0
        ]);
        return redirect('admin/supplier')->with('delete','success');
    }

    public function editSupplier($id){
        $supplier = DB::table('supplier')->find($id);
        return view('admin.editSupplier',['supplier'=>$supplier]);
    }

    public function purchase(){
        $supplier = DB::table('supplier')->where('status',1)->get();
        return view('admin.purchase',['supplier'=>$supplier]);
    }

    public function addPurchase($id){
        $exchange = DB::table('exchange')->first();
        $supplier = DB::table('supplier')->find($id);
        $product = DB::table('product')->join('stock','stock.productID','product.id')->get();
        return view('admin.addPurchase',['supplier'=>$supplier,'product'=>$product,'exchange'=>$exchange]);
    }

    public function addPurchaseSubmit($sup_id,Request $data){
        // return $data;
        try{
            if($data->subtotal == 0){
                return redirect("/admin/purchase/$sup_id")->with('error','error');
            }
            DB::table('purchase')->insert([
                'supplierID' =>$sup_id,
                'buyerID'    => Auth::user()->id,
                'date'       => now(),
                'discount'   => $data->discount
            ]);
            $purchase = DB::table('purchase')->orderByDesc('id')->first();
            for($i=0;$i<count($data->id);$i++){
                $StockQty = DB::table('stock')->find($data->id[$i]);
                $qty = $StockQty->qty+ $data->qty[$i];
                DB::table('stock')->where('productID',$data->id[$i])->update(['qty'=>$qty]);
                DB::table('purchaseDetail')->insert([
                    'purchaseID' => $purchase->id,
                    'productID'  => $data->id[$i],
                    'qty'        => $data->qty[$i],
                    'price'      => $data->price[$i]
                ]);
            }
            return redirect("/admin/stock");
        }catch(Exception $ex){

        }
    }

    public function editSupplierSubmit($id,Request $data){
        try{
            $file = $data->file('image');
            if(empty($file)){
                $image = $data->old_image;
            }else{
                $image = $this->uploadImage($file);
            }
            DB::table('supplier')->where('id',$id)->update([
                'name'    => $data->name,
                'email'   => $data->email,
                'phone'   => $data->phone,
                'address' => $data->address,
                'note'    => $data->note,
                'photo'   => $image,
            ]);
            return redirect('admin/supplier')->with('edit','success');
        }catch(Exception $ex){
            return $ex;
            return redirect('admin/supplier')->with('error','error');
        }
    }
}
