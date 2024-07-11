<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

abstract class Controller
{
    public function checkName($table,$name){
        $check = DB::table($table)->where('name',$name)->count();
        return $check;
    }
    public function checkCode($table,$code){
        $check = DB::table($table)->where('code',$code)->count();
        return $check;
    }
    public function checkBarode($table,$barcode){
        $check = DB::table($table)->where('barcode',$barcode)->count();
        return $check;
    }
    public function checkEditName($table,$name,$id){
        $check = DB::table($table)->where([['name',$name],['id','<>',$id]])->count();
        return $check;
    }
    public function checkEditCode($table,$code,$id){
        $check = DB::table($table)->where([['code',$code],['id','<>',$id]])->count();
        return $check;
    }

    public function uploadImage($file){
        $image = rand(0,9999)."-".$file->getClientOriginalName();
        $file->move('images',$image);
        return $image;
    }
}
