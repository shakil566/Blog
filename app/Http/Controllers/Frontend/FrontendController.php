<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogComment;
use App\Models\BlogPosts;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
{
    public function index(){
        $targetArr = BlogPosts::orderBy('id', 'asc')->get();
        return view('frontend.index')->with(compact('targetArr'));
    }
    public function blogdetails(Request $request ,$id, $slug)
    {
        $comment = '';
        $target = BlogPosts::where('id', $id)->select('*')->first();
        if(!empty(Auth::id())){
            $comment = BlogComment::where('user_id', Auth::id())->where('blog_id', $id)->select('*')->get();
        }
        // return $id;
        if (empty($target)) {
            Session::flash('error', 'Invalid data Id');
            return redirect('/');
        }

        return view('frontend.blogComment')->with(compact('target','comment'));
    }

    public function blogComment(Request $request)
    {
        $qpArr = $request->all();
        // return $qpArr;
        $validator = Validator::make($request->all(), [

            'comment' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/blog-comment'.'/'.$request->id.'/'.$request->slug)
                ->withInput()
                ->withErrors($validator);
        }
        if(!empty(Auth::id())){
            $target = new BlogComment;
            $target->comment = $request->comment;
            $target->blog_id = $request->id;
            $target->user_id = Auth::id();
        }else{
            Session::flash('error', 'You need to login');
            return redirect('/login');
        }
        if ($target->save()) {
            Session::flash('success', 'Comment Added Successfully');
            return redirect('/blog-comment'.'/'.$request->id.'/'.$request->slug);
        } else {
            Session::flash('error', 'Could Not be Added');
            return redirect('/');
        }
    }
}
