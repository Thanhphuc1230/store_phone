<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
class NewsController extends Controller
{
    public function blog(){

        $data['news']= DB::table('news')->where('status',1)->get();

        return view('website.modules.blog.category',$data);
    }
    public function blogDetail($id){
        $news = DB::table('news')->where('title',$id)->get();
        
       $id_new=$news->pluck('uuid')->toArray();
    
        $data['news_random'] = DB::table('news')
        ->where('status',1)
        ->inRandomOrder()
        ->limit(6)
        ->get();
        $data['news_random1'] = DB::table('news')
        ->where('status',1)
        ->inRandomOrder()        
        ->limit(6)
        ->get();
        $data['products'] = DB::table('categories')
        ->join('products','categories.id','=','products.category_id')->get();

        $data['comments'] = DB::table('comments')
        ->select('comments.*','users.fullname','users.avatar')
        ->join('users','comments.user_id_comments','=','users.uuid')
        ->join('news','comments.post_id_comments','=','news.uuid')
        ->where('post_id_comments',$id_new)
        ->where('status_comments',1)
        ->get();
      
        $data['news'] =DB::table('news')->where('uuid', $id_new)->get();
        
        return view('website.modules.blog.details',$data);
    }
    public function postComment(Request $request,$id){
        

        $data['comments'] = $request->comments;
        $data['user_id_comments'] = Auth::user()->uuid;
        $data['post_id_comments'] = $id;
        $data['created_at'] = New \DateTime;
        $data['status_comments'] = 0;
            
        DB::table('comments')->insert($data);

        return back()->with('success', 'Đã thêm comment thành công, chúng tôi sẽ xem xét comments');
    }
    public function comingSoon(){
        return view('website.modules.blog.comingsoon');
    }
    public function about(){
        return view('website.modules.pages.about');
    }
    public function map(){
        return view('website.modules.maps.map');
    }
    public function like(Request $request)
    {
        $count=DB::table('likes')->where([
            ['user_id',$request->user],
            ['new_id',$request->new],
        ])->count();
       
        if($count <= 0){
        DB::table('likes')->insert([
            'user_id' =>$request->user,
            'new_id'=>$request->new,
        ]);
        }

        $countAfterLike =DB::table('likes')->where([['new_id',$request->new],])->count();

         
    }
}
