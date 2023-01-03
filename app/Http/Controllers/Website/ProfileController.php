<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\UserRequest;
use Illuminate\Support\Facades\DB;
class ProfileController extends Controller
{
    public function account($id){
        $user = DB::table('users')->where('uuid',$id);

        $data['users'] =  $user->first();

        $user_id =$user->pluck('id')->toArray();

        $data['order_user'] = DB::table('users')
        ->join('order_status','users.id', '=','order_status.user_id')
        ->where('uuid',$id)
        ->get();
     
        $data['order_status'] = DB::table('order_shipping')
         ->join('order_status','order_shipping.id','=','order_status.shipping_id')
         ->whereIn('user_id',$user_id)
         ->get();
       
        if ($user->exists()) {
            $data['user'] = $user->first();
       
             return view('website.modules.profile.account', $data);
        } else {
            abort(404);
        }
        
    }
    public function accountOrder($id){
        $user = DB::table('order_status')->where('order_id',$id);

        $data['users'] =  $user->first();
       
        $data['order_user'] = DB::table('users')
        ->join('order_status','users.id', '=','order_status.user_id')
        ->where('order_id',$id)
        ->first();
       
        $data['order_status'] = DB::table('order_shipping')
         ->join('order_status','order_shipping.id','=','order_status.shipping_id')
         ->where('order_id',$id)
         ->get();
        
       
        $id1= $data['order_status']->pluck('id')->toArray();

             
        $data['order_product'] = DB::table('order_product')
        ->where('order_status',$id1)
        ->get();

        return view('website.modules.profile.view',$data);
    }
    
    public function accountEdit($id){
        $user = DB::table('users')->where('uuid',$id);

        $data['users'] =  $user->first();
            
        if ($user->exists()) {
            $data['user'] = $user->first();
        
            return view('website.modules.profile.edit', $data);
        } else {
            abort(404);
        }
    }

    public function accountUpdate(UserRequest $request, $id)
    
    {   $user_current = DB::table('users')->where('uuid', $id)->first();

        $data = $request->except('_token','password_confirmation');
              
        if (empty($request->password)) {
            $data['password'] = $user_current->password; 
        } else {
            $request->validate([
                'password' => 'min:8'
            ], [
                'password.min' => 'Mật khẩu ít nhất 8 ký tự'
            ]);

            $data['password'] = bcrypt($request->password);
        }

        if (empty($request->avatar)) {
            $data['avatar'] = $user_current->avatar;
             
        } else {
            $image_path = public_path('images/users') . "/" . $user_current->avatar;
  
            $imageName = time().'-'.$request->avatar->getClientOriginalName();  
            $request->avatar->move(public_path('images/users'), $imageName);
            $data['avatar'] = $imageName;
        }              
                DB::table('users')->where('uuid',$id)->update($data);

         return redirect()->route('website.account',$user_current->uuid)->with('success', 'Cập nhật thông tin người dùng thành công');
    }
}




