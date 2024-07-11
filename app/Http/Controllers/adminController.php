<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class adminController extends Controller
{
    public function register(Request $data){
        try{
            $check = $this->checkName('users',$data->name);
            if($check >0) return redirect('/register')->with('exist',"user exist");

            if($data->sex == "Male") $profile = "male-user.png";
            else $profile = "female-user.png";

            $password = Hash::make($data->password);
            DB::table('users')->insert([
                'name'       => $data->name,
                'sex'        => $data->sex,
                'email'      => $data->email,
                'password'   => $password,
                'profile'    => $profile,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return redirect('/');
        }catch(Exception $ex){
            return redirect('/register');
        }
    }

    public function login(Request $data){
        try{
            $name = $data->name;
            $password = $data->password;
    
            if(Auth::attempt(['name' => $name, 'password' => $password])){
                return redirect('/admin');
            }else{
                return redirect('/')->with('invalid','user not found');
            }
        }catch(Exception $ex){
            return redirect('/login');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
