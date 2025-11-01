<?php

namespace App\Http\Controllers\Auth;
use App\Notifications\VerifyEmailNotification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class AuthController extends Controller
{
    // -------------------- Login --------------------
    public function indexLogin(Request $request)
    {
        $guard = $request->route('guard');
        return view('auth.login', compact('guard'));
    }

    public function login(Request $request)
    {
        $guard = $request->route('guard');

        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if (Auth::guard($guard)->attempt($data, $request->filled('remember'))) {
            return redirect()->route("{$guard}.dashboard");
        }

        return redirect()->back();
    }

    // -------------------- Register --------------------
    function indexRegister(Request $request)
    {
        $guard = $request->route('guard');
        return view('auth.register', compact('guard'));
    }

    function register(Request $request)
    {
        $guard = $request->route('guard');
        $provider=config("auth.guards.$guard.provider");
        $modelclass=config("auth.providers.$provider.model");
             

         $request->validate([
        'fullname' => 'required|string|max:255',
        'email' => 'required|email|unique:freelancers,email',
        'password' => 'required|min:6|confirmed', // يتأكد من وجود confirm_password
      
    ]);
     $token=Str::random();
         $user=$modelclass::create([
          'name'=>$request->fullname,
          'email'=>$request->email,
          'password'=>$request->password,
            'verification_token'=>$token,
        'verification_token_sent_at'=>now(),
          ]);
         $user->notify(new VerifyEmailNotification( $token,$guard));
      
       //  dd($request->all()); // مؤقتًا للاختبار
        //return redirect()->route($guard.'.login');
        return 'تم ارسال رابط تحقق للبريد الالكتروني';
          }
          function dashboard(){

            return view($guard);
          }
}
