<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class unitContoller extends Controller
{
    public function unit(){
        $unit = DB::table('units')->orderByDesc('id')->paginate(5);
        return view('admin.unit',['unit'=>$unit]);
    }

    public function addUnit(Request $data){
        $check = $this->checkCode('units',$data->code);
        if($check>0) return redirect('/admin/units')->with('exist','data exist');
        $check = $this->checkName('units',$data->name);
        if($check>0) return redirect('/admin/units')->with('exist','data exist');

        try{
            DB::table('units')->insert([
                'code' => $data->code,
                'name' => $data->name,
                'note' => $data->note,
            ]);
            return redirect('/admin/units')->with('insert','success');
        }catch(Exception $ex){
            return redirect('/admin/units')->with('error','error');
        }
    }

    public function editUnit(Request $data){
        $check = $this->checkEditCode('units',$data->code,$data->id);
        if($check>0) return redirect('/admin/units')->with('exist','data exist');
        $check = $this->checkEditName('units',$data->name,$data->id);
        if($check>0) return redirect('/admin/units')->with('exist','data exist');

        try{
            DB::table('units')->where('id',$data->id)->update([
                'code' => $data->code,
                'name' => $data->name,
                'note' => $data->note,
            ]);
            return redirect('/admin/units')->with('edit','success');
        }catch(Exception $ex){
            return redirect('/admin/units')->with('error','error');
        }
    }

    public function deleteUnit($id){
        $count = DB::table('product')->where('unit',$id)->count();
        if($count > 0)  return redirect('/admin/units')->with('error','error');
        try{
            DB::table('units')->where('id',$id)->delete();
            return redirect('/admin/units')->with('delete','success');
        }catch(Exception $ex){
            return redirect('/admin/units')->with('error','error');
        }
    }
}
