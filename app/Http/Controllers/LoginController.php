<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Mail;
use Carbon\Carbon;
use App\Models\User;
use App\Mail\NotifyMail;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{

public function getLogin(){

        if(!Auth::check()){
            return view('login.login');
        }

        return redirect()->route('admin.categories.index');
}
    
public function postLogin(LoginRequest $request){

        $login = [
            'email' => $request->email,
            'password' =>$request->password,      
            'status_user' => 1,
        ];

            if (Auth::attempt($login)) {
                if(Auth::user()->email_verified_at !=null){
                    if(Auth::user()->level == 1 && 2){
                        $request->session()->regenerate();

                        return redirect()->route('admin.categories.index');
                    }

                    return redirect()->route('website.index');
                }                              
                else {
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();

                    return back()->with([
                        'error' => 'Please confirm your email',
                    ]);
                }
                        
            }

        // if(Auth::user()->status_user != 1){
        //     Auth::logout();
        //         $request->session()->invalidate();
        //         $request->session()->regenerateToken();
        //     return back()->with([
        //     'error' => 'Tai khoan da bi cam dang nhap',
        // ]);  } 
        return back()->with([
            'error' => 'Email or password wrong, Please enter again',
        ]);
                            
}

public function getForgot(){
     
        return view('login.forgot');
}

public function sendResetLink(Request $request){
        $request->validate([
            'email'=>'required|email|exists:users,email'
        ]);
        $token = \Str::random(64);
        \DB::table('password_resets')->insert([
              'email'=>$request->email,
              'token'=>$token,
              'created_at'=>Carbon::now(),
            
        ]);
        
        $action_link = route('showResetFrom',['token'=>$token,'email'=>$request->email]);
        $body = "Ch??ng t??i ???? nh???n ???????c y??u c???u ?????t l???i m???t kh???u cho t??i kho???n  <b> Store Phone.online </b> ???????c li??n k???t v???i " .$request->email.". B???n c?? th??? ?????t l???i m???t kh???u c???a m??nh b???ng c??ch nh???p v??o li??n k???t b??n d?????i";

       \Mail::send('emails.forgot',['action_link'=>$action_link,'body'=>$body], function($message) use ($request){
             $message->from('noreply@example.com','Storephone.online');
             $message->to($request->email,'Your name')
                     ->subject('Reset Password');
       });

      
       return back()->with('success', 'We have e-mailed your password reset link!');
}

public function showResetFrom(Request $request, $token = null){
        return view('login.resetPassword')->with(['token'=>$token,'email'=>$request->email]);
}

public function resetPassword(Request $request){
        $request->validate([
            'email'=>'required|email|exists:users,email',
            'password'=>'required|min:5|confirmed',
            'password_confirmation'=>'required',
        ]);

        $check_token = \DB::table('password_resets')->where([
            'email'=>$request->email,
            'token'=>$request->token,
        ])->first();

        if(!$check_token){
            return back()->withInput()->with('error', 'Invalid token');
        }else{

            User::where('email', $request->email)->update([
                'password'=>\Hash::make($request->password)
            ]);

            \DB::table('password_resets')->where([
                'email'=>$request->email
            ])->delete();

            return redirect()->route('getLogin')->with('success', 'M???t kh???u ???? ???????c ?????i b???n c?? th??? ????ng nh???p v???i m???t kh???u m???i')->with('verifiedEmail', $request->email);
        }
}

public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect()->route('getLogin');
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
         return view ('login.register');
    }


    // public function sendMail(){
    //     return view('login/send-mail');
    // }

public function postRegister(RegisterRequest $request)
    {
        $data = $request->except('_token', 'password_confirmation', 'avatar');
        $data['password'] = bcrypt($request->password);
        $data['created_at'] = new \DateTime();
        
        $data['uuid'] = Str::uuid();
        
        $data['avatar'] = '';
        $data['status_user'] =1;

             $result = DB::table('users')->insert($data);
        if($result){
            Mail::to($request->email)->send(new NotifyMail($data));
            return view('login/send-mail');
        }

}

public function verify($uuid){
        $data =DB::table('users')->where('uuid', $uuid)->first();

        if($data->email_verified_at == null){
            DB::table('users')->where('uuid', $uuid)->update(['email_verified_at' => new \DateTime()]);

            return view('login.login');
        }else {
            return redirect()->route('website.index');
        }
    }

}