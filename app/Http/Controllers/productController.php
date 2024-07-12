<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class productController extends Controller
{
    public function home(){
        $currency     = DB::table('exchange')->first(); 
        $product      = DB::table('product')->count();
        $customer     = DB::table('customer')->count();
        $warning_stock= DB::table('stock')->where('qty','>',0)->where('qty','<=',10)->count();
        $bad_stock    = DB::table('stock')->where('qty',0)->count();
        $good_stock   = DB::table('stock')->where('qty','>',5)->count();
        $cost = DB::table('purchaseDetail')->select(DB::raw('SUM(qty * price) as cost'))->first();
        $price = DB::table('saleDetail')->select(DB::raw('SUM(qty * price) as price'))->first();
        $purchase = DB::table('purchase')->join('purchaseDetail','purchase.id','purchaseDetail.purchaseID')->select('purchase.id as ID',DB::raw('SUM(purchaseDetail.qty * purchaseDetail.price)+(SUM(purchaseDetail.qty * purchaseDetail.price)*0.05) as cost'))->groupBy('purchase.id')->get();
        $sale = DB::table('sale')->join('saleDetail','sale.id','saleDetail.saleID')->select('sale.id as ID',DB::raw('SUM(saleDetail.qty * saleDetail.price) as price'))->groupBy('sale.id')->get();
        return view('admin.home',['product'=>$product,'customer'=>$customer,'bad'=>$bad_stock,'good'=>$good_stock,'warning'=>$warning_stock,'currency'=>$currency,'cost'=>$cost,'price'=>$price,'purchase'=>$purchase,'sale'=>$sale]);
    }

    Public function product(){
        $product  = DB::table('product')
        ->join('units','units.id','product.unit')
        ->join('category','category.id','product.category')
        ->select('product.*','category.name as category','units.name as unit')
        ->orderByDesc('id')->paginate(5);
        return view('admin.product',['product'=>$product]);
    }

    public function addProduct(){
        $category = DB::table('category')->get();
        $unit     = DB::table('units')->get();
        $currency = DB::table('currency')->get();
        return view('admin.addProduct',['category'=>$category,'unit'=>$unit,'currency'=>$currency]);
    }

    public function addProductSubmit(Request $data){
      $check = $this->checkName('product',$data->name);
      if($check > 0 ) return redirect('admin/products')->with('exist','product exist');
      $barcode = rand(100000,999999);
      $file = $data->file('image');
      if(empty($file)) return redirect('/admin/add-product')->with('error','error');
      $image = $this->uploadImage($file);
      try{
        DB::table('product')->insert([
            'name'    => $data->name,
            'barcode' => $barcode,
            'category'=> $data->category,
            'unit'    => $data->unit,
            'cost'    => $data->cost,
            'currency'=> $data->currency,
            'price'   => $data->price,
            'image'   => $image,
            'detail'  => $data->detail,
          ]);
          $product = DB::table('product')->orderByDesc('id')->first();
          DB::table('stock')->insert([
            'productID' => $product->id,
            'qty'       => 0
          ]);
          return redirect('/admin/products')->with('insert','success');
      }catch(Exception $ex){
        // return redirect('/admin/add-product')->with('error','error');
        return $ex;
      }
    
    }

    public function productDetail(Request $data){
      try{
        $product  = DB::table('product')
        ->join('units','units.id','product.unit')
        ->join('category','category.id','product.category')
        ->join('currency','currency.id','product.currency')
        ->join('stock','stock.productID','product.id')
        ->select('product.*','category.name as category','units.name as unit','currency.name as currency','stock.qty as qty')
        ->where('barcode',$data->barcode)->first();
        return view('admin.productDetail',['product'=>$product]);
      }catch(Exception $ex){
        return $ex;
      }
    }

    public function editProduct($id){
      $product  = DB::table('product')->where('id',$id)->first();
      $category = DB::table('category')->get();
      $unit     = DB::table('units')->get();
      $currency = DB::table('currency')->get();
      return view('admin.editProduct',['product'=>$product,'category'=>$category,'unit'=>$unit,'currency'=>$currency]);
    }

    public function editProductSubmit($id,Request $data){
      $check = $this->checkEditName('product',$data->name,$id);
      if($check > 0) return redirect('/admin/products')->with('exist','exist');

      if(empty($data->file('image'))) $image = $data->old_image;
      else $image = $this->uploadImage($data->file('image'));
      try{
        DB::table('product')->where('id',$id)->update([
          'name'     => $data->name,
          'category' => $data->category,
          'currency' => $data->currency,
          'unit'     => $data->unit,
          'cost'     => $data->cost,
          'price'    => $data->price,
          'image'    => $image,
          'detail'   => $data->detail
        ]);
        return redirect('/admin/products')->with('edit','success');
      }catch(Exception $ex){
        return redirect('/admin/products')->with('error','error');
      }
    }

    public function deleteProduct($id){
      $check = DB::table('stock')->where('productID',$id)->first();
      if($check->qty > 0) return redirect('/admin/products')->with('error','error');
      try{
        DB::table('product')->where('id',$id)->delete();
        return redirect('/admin/products')->with('delete','success');
      }catch(Exception $ex){
        return redirect('/admin/products')->with('error','error');
      }
    }

    public function stock(){
      $stock = DB::table('stock')
      ->join('product','stock.productID','product.id')
      ->join('category','category.id','product.category')
      ->join('units','units.id','product.unit')
      ->select('product.id as ID','product.name as name','category.name as category','product.image as img','stock.qty as qty','units.name as unit','product.price as price')
      ->paginate(5);
      return view('admin.stock',['stock'=>$stock]);
    }
}
