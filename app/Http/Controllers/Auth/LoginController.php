<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

    public function autenticate(Request $request){

        $user = User::where( "email", $request->input('email'))->get();

        foreach ($user as $hsl)
        {
             $passwordtemp = $hsl->password;
             $emailtemp = $hsl->email;
             $nametemp = $hsl->name;
        }

        if (isset($passwordtemp)) {
            if (Hash::check($request->input('password'), $passwordtemp)){
                //TUDO OK

                session()->put('USERNAME',$nametemp);
                session()->put('USEREMAIL',$emailtemp );

                return redirect('/dashboard');
            }else{
                //SENHA ERRADA
                return redirect('/login');
            }
        } else{
            //E-MAIL NÃO ENCONTRADO
            return redirect('/register');
        }

    }

    public function logout(){

        session()->flush();

        return redirect('/login');

    }

}
