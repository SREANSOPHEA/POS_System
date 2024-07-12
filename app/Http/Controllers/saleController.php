<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class saleController extends Controller
{
    public function sale(){
        $customer = DB::table('customer')->where('status','Active')->get();
        $product = DB::table('product')->join('category','category.id','product.category')->join('units','units.id','product.unit')->select('product.*','units.name as unit','category.name as category')->get();
        return view('admin.sale',['product'=>$product,'customer'=>$customer]);
    }

    public function addSale(Request $data){
        $product = DB::table('product')
            ->join('category','category.id','product.category')
            ->join('currency','currency.id','product.currency')
            ->join('units','units.id','product.unit')
            ->select('product.*','units.name as unit','category.name as category','currency.name as currency')
            ->where('barcode',$data->barcode)->first();

        $exchange = DB::table('exchange')->first();
        $id = $product->id;
        $barcode = $product->barcode;
        $currency = $product->currency;
        $name = $product->name;
        $price = number_format($product->price,2);
        $image = $product->image;
        $category = $product->category;
        $unit = $product->unit;
        if($currency == 'Riel'){
            $price = number_format($product->price/$exchange->riel,2);
        }
            echo  "
                <tr>
                    <td><input type='hidden' name='id[]' value='$id'>$id</td>
                    <td>$name</td>
                    <td>$category</td>
                    <td id='text_qty$barcode'><input type='hidden' name='qty[]' value='1'>1</td>
                    <td>$unit</td>
                    <td>$price $<input type='hidden' name='price[]' value='$price'></td>
                    <td><img src='http://localhost:8000/images/$image'></td>
                    <td><button class='deleteBTN'>Remove</button></td>
                </tr>
            ";
        // return $text;
    }

    public function SaleSubmit(Request $data){
        try{
            DB::table('sale')->insert([
                'customer' => $data->customer,
                'seller'   => Auth::user()->id,
                'date'     => now(),
            ]);
            $sale = DB::table('sale')->limit(1)->orderByDesc('id')->first();
                for($i=0; $i<count($data->id); $i++){
                    DB::table('saleDetail')->insert([
                        'saleID'    => $sale->id,
                        'productID' => $data->id[$i],
                        'qty'       => $data->qty[$i],
                        'price'     => $data->price[$i]
                    ]);

                    $stock = DB::table('stock')->where('productID',$data->id[$i])->first();
                    $instock = $stock->qty;
                    $newstock = $instock- $data->qty[$i];
                    DB::table('stock')->where('productID',$data->id[$i])->update([
                        'qty' => $newstock
                    ]);
                }
                return redirect('/admin/invoice-sale');
        }catch(Exception $ex){
            // return $ex;
            return redirect('/admin/sale')->with('error','error');
        }
    }

    public function invoiceSale(Request $data){
        $sale = DB::table('sale')->join('customer','customer.id','sale.customer')->join('users','users.id','sale.seller')->select('sale.*','customer.name as customer','users.name as seller')->get();
        return view('admin.invoice',['sale'=>$sale]);
    }

    public function invoicePurchase(Request $data){
        $purchase = DB::table('purchase')->join('supplier','supplier.id','purchase.supplierID')->join('users','users.id','purchase.buyerID')->select('purchase.*','supplier.name as supplier','users.name as buyer')->get();
        return view('admin.invoicePurchase',['purchase'=>$purchase]);
    }

    public function invoiceSaleDetail($id){
        $detail = DB::table('sale')
        ->join('saleDetail','sale.id','saleDetail.saleID')
        ->join('customer','customer.id','sale.customer')
        ->join('users','users.id','sale.seller')
        ->join('product','product.id','saleDetail.productID')
        ->join('currency','currency.id','product.currency')
        ->join('category','category.id','product.category')
        ->join('units','units.id','product.unit')
        ->where('sale.id',$id)
        ->select('sale.id as ID','currency.name as currency','sale.date as date','saleDetail.qty as quantity','product.name as product','customer.name as customer','users.name as seller','category.name as category','units.name as unit','product.price as price')
        ->get();

        $exchange = DB::table('exchange')->first();
        return view('admin.invoiceDetail',['detail'=>$detail,'exchange'=>$exchange]);
    }

    public function invoicePurchaseDetail($id){
        $detail = DB::table('purchase')
        ->join('purchaseDetail','purchase.id','purchaseDetail.purchaseID')
        ->join('supplier','supplier.id','purchase.supplierID')
        ->join('users','users.id','purchase.buyerID')
        ->join('product','product.id','purchaseDetail.productID')
        ->join('currency','currency.id','product.currency')
        ->join('category','category.id','product.category')
        ->join('units','units.id','product.unit')
        ->where('purchase.id',$id)
        ->select('purchase.id as ID','purchase.discount as discount','currency.name as currency','purchase.date as date','purchaseDetail.qty as quantity','product.name as product','supplier.name as supplier','users.name as buyer','category.name as category','units.name as unit','purchaseDetail.price as price')
        ->get();
        return view('admin.invoicePurchaseDetail',['detail'=>$detail]);
    }
}
