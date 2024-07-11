<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class currencyController extends Controller
{
    public function currency(){
        $currency = DB::table('currency')->get();
        $exchange = DB::table('exchange')->first();
        return view('admin.currency',['currency'=>$currency,'exchange'=>$exchange]);
    }

    public function editRiel(Request $data){
        try{
            $riel = $data->money;
            $exchange = DB::table('exchange')->first();
            if($riel > $exchange->dollar) $rate = $riel/$exchange->dollar;
            else if($riel < $exchange->dollar) $rate = $exchange->dollar/$riel;
            else $rate = 1;
            DB::table('exchange')->where('id',1)->update([
                'riel' => $riel,
                'rate' => $rate
            ]);
            return "success";
        }catch(Exception $ex){
            return 'error';
        }
    }

    public function editDollar(Request $data){
        try{
            $dollar = $data->money;
            $exchange = DB::table('exchange')->first();
            if($dollar > $exchange->dollar) $rate = $dollar/$exchange->riel;
            else if($dollar < $exchange->dollar) $rate = $exchange->riel/$dollar;
            else $rate = 1;
            DB::table('exchange')->where('id',1)->update([
                'dollar' => $dollar,
                'rate' => $rate
            ]);
            return "success";
        }catch(Exception $ex){
            return 'error';
        }
    }
}
