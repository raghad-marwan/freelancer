<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class emailverificationController extends Controller
{
    //
    function verify(Request $request){
     $token=$request->guery('token');
      $provider=config("auth.guards.$guard.provider");
      $modelclass=config("auth.providers.$provider.model");
     $user= $modelclass::where('verification_token', $token)->first();
           

     $sendAt=Carbon::parse($user->verification_token_sent_at);
     if(Carbon::now()->diffInHours($sendA>24)){
        return 'انتهت مدة الرابط';
     }
       $user->update([
            'verification_token'=>null,
        'verification_token_sent_at'=>null,
        'email_verified_at'=>now(),

        ]);
        return 'تمت العملية بنجاح';
    }

  

}
