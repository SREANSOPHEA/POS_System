<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class categoryController extends Controller
{
    public function category(){
        $category = DB::table('category')->orderByDesc('id')->paginate(5);
        return view('admin.category',['category'=>$category]);
    }
    
    public function addCategory(Request $data){
        $code = $this->checkCode('category',$data->code);
        if($code>0)  return redirect('/admin/categories')->with('exist','data exist');
        $check = $this->checkName('category',$data->name);
        if($check>0)  return redirect('/admin/categories')->with('exist','data exist');
        try{
            DB::table('category')->insert([
                'code' => $data->code,
                'name' => $data->name,
                'note' => $data->note
            ]);
            return redirect('/admin/categories')->with('insert','success');
        }catch(Exception $er){
            return redirect('/admin/categories')->with('error','something went wrong');
        }
        
    }

    public function editCategory(Request $data){
        $code = $this->checkEditCode('category',$data->code,$data->id);
        if($code>0)  return redirect('/admin/categories')->with('exist','data exist');
        $check = $this->checkEditName('category',$data->name,$data->id);
        if($check>0)  return redirect('/admin/categories')->with('exist','data exist');
        try{
            DB::table('category')->where('id',$data->id)->update([
                'code' => $data->code,
                'name' => $data->name,
                'note' => $data->note
            ]);
            return redirect('/admin/categories')->with('edit','success');
        }catch(Exception $er){
            return redirect('/admin/categories')->with('error','something went wrong');
        }
        
    }

    public function deleteCategory($id){
        $count = DB::table('product')->where('category',$id)->count();
        if($count > 0 ) return redirect('/admin/categories')->with('error','something went wrong');
        try{
            DB::table('category')->where('id',$id)->delete();
            return redirect('/admin/categories')->with('delete','success');
        }catch(Exception $er){
            return redirect('/admin/categories')->with('error','something went wrong');
        }
        
    }
}
