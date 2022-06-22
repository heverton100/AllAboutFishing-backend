<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class UsersController extends Controller
{
    public function dashboard()
    {
        return view('home', [
            
        ]);
    }

    public function store(Request $request)
    {
        $user = User::where( "email", $request->email)->get();

        foreach ($user as $hsl)
        {
             $emailtemp = $hsl->email;
        }

        if (isset($emailtemp)) {
            //EMAIL JA CADASTRADO
            return json_encode(array("response"=>"failed"));
        }else{
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'token' => md5($request->email),
            ]);

            $to_name = $request->name;
            $to_email = $request->email;
            $data = array('name'=>$request->name, 'body' => "https://api2-allaboutfishing.azurewebsites.net/api/users/verifyemail/".md5($request->email));
            Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)->subject('Verification Email - All About Fishing');
                $message->from('teste@dotipsandtricks.com','All About Fishing');
            });

            return json_encode(array("response"=>"success"));
        }

    }

    public function verifyemail(Request $request)
    {
        $token = $request->token;

        $user = User::where( "token", $token)->get();

        foreach ($user as $hsl)
        {
            $userid = $hsl->id;
        }

        $user = User::findOrfail($userid);

        $user->update([
            'email_verified_at' => now(),
        ]);

        return view('auth.emailverifiedsuccess', [
        ]);

    }

    public function login(Request $request){

        $user = User::where( "email", $request->email)->get();

        foreach ($user as $hsl)
        {

            $passwordtemp = $hsl->password;
            $emailtemp = $hsl->email;
            $emailverify = $hsl->email_verified_at;
            $nametemp = $hsl->name;
            $idtemp = $hsl->id;
            $phonetemp = $hsl->phone;
            $url_imagetemp = $hsl->url_image;
             
        }

        if (isset($passwordtemp) && isset($emailverify)) {
            if (Hash::check($request->input('password'), $passwordtemp)){
                //TUDO OK

                return json_encode(array("response"=>"success",
                    "id"=>$idtemp,
                    "name"=>$nametemp,
                    "email"=>$emailtemp,
                    "phone"=>$phonetemp,
                    "url_image"=>$url_imagetemp,
                ));
            }else{
                //SENHA ERRADA

                return json_encode(array("response"=>"failed"));
            }
        } else{
            //E-MAIL NÃO ENCONTRADO OU NÃO CONFIRMADO

            return json_encode(array("response"=>"email not found"));
        }

    }


    public function sendresetlink(Request $request)
    {

        $user = User::where( "email", $request->email)->get();

        foreach ($user as $hsl)
        {
            $to_email = $hsl->email;
            $to_name = $hsl->name;
        }

        if (isset($to_email)) {

            $data = array('name'=>$to_name, 'body' => "https://api2-allaboutfishing.azurewebsites.net/api/users/resetpassword/".md5($request->email));
            Mail::send('emails.resetlinkpassword', $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)->subject('Reset Password - All About Fishing');
                $message->from('teste@dotipsandtricks.com','All About Fishing');
            });

            return json_encode(array("response"=>"success"));

        }else{
            return json_encode(array("response"=>"failed"));
            //E-MAIL NAO ENCONTRADO
        }

    }

    public function resetpassword(Request $request)
    {
        return view('auth.resetpassword', [
            'user' => User::where( "token", $request->token)->firstOrFail()
        ]);
    }

    public function changepassword($id)
    {

        $user = User::findOrfail($id);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return view('auth.resetpasswordsuccess', [
        ]);

    }

    public function uploadimageprofile(Request $request)
    {

        if ($request->hasFile('image')) {

            $extension = $request->image->extension();
            $nameFile =  md5($request->email).random_int(10000, 99999).".".$extension;
            $upload = $request->image->storeAs('public/image_profile', $nameFile);

            if ( !$upload ){
                return json_encode(array("response"=>"failed"));
            }else{
                return json_encode(array("response"=>"success","url_image" => env('APP_URL').'/storage/image_profile/'.$nameFile));
            }
            
        }

    }

    public function update(Request $request)
    {
        $user = User::findOrfail($request->id);

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'url_image' => $request->url_image,
        ]);

        return json_encode(array("response"=>"success"));

    }


}
