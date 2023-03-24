<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Http\Requests\RegisterPostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Product;
use App\Models\Sepet;
class AdminController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function loginPost(Request $request)
    {
        $remember = $request->remember ? true:false;
        
        if($remember == true){
            setcookie('loginemail',$request->email,time()+60*60*24*365);
            setcookie('loginpassword',$request->password,time()+60*60*24*365);                      
        } 
      
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            $user=Admin::whereId(Auth::user()->id)->first();
            $user->updated_at=Carbon::now();
            $ip = $request->getClientIp();
            // $data = Location::get('176.54.225.189');
            $user->ip=$ip;
            $user->save();
                toastr()->info('Hoşgeldiniz ' . Auth::user()->name,'Karşılama');  
                return redirect()->route("dashboard");
        }
        else
        {
            return redirect()->back()->withFail('Kullanıcı Adı veya Şifreniz hatalı');
        }

    }
    
    public function registerPost(RegisterPostRequest $request)
    {
        //dd($request);
        try
        {
            $user=Admin::create(
                [
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=>Hash::make($request->password),
                ]);
                if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
                {
                    return redirect()->route("dashboard");
                }
                else
                {
                    return redirect()->back()->withFail('Kullanıcı Adı veya Şifreniz hatalı');
                }
                
        }  
        catch(\Exception $e)
        {
            return redirect()->back()->withFail('Beklenmedik bir hata oluştu');
        } 
    }
    public function dashboard()
    {
        $usercount=User::get()->count();
        $uruncount=Product::get()->count();
        $sipariscount=Sepet::get()->count();
        return view('dashboard',compact('uruncount','usercount','sipariscount'));
    } 
    public function profil()
    {
        return view('profilpages.profil');
    }
    public function logout()
    {
        setcookie('loginemail','');
        setcookie('loginpassword','');
        unset($_COOKIE['loginemail']);
        unset($_COOKIE['loginpassword']);
        Auth::logout();
        return redirect()->route('login');
    }
}
