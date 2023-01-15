<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogComment;
use App\Models\BlogPosts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class BlogCommentController extends Controller
{
    public function create(Request $request, $slug)
    {
        $target = BlogPosts::find($slug);

        // return $emailArr;
        if (empty($target)) {
            Session::flash('error', 'Invalid data Id');
            return redirect('blog');
        }

        $qpArr = $request->all();

        return view('frontend.blogComment')->with(compact('qpArr'));
    }

    public function store(Request $request, $slug)
    {
        $qpArr = $request->all();

        $target = new BlogComment();
        $target->comment = $request->comment;
        $target->user_id = Auth::id();

        return $target;

        if ($target->save()) {
            Session::flash('success', 'Comment Add Successfully');
            return redirect('/blog');
        } else {
            Session::flash('error', 'Could Not be Added');
            return redirect('/blog');
        }
    }

    public function edit(Request $request, $id)
    {
        $target = BlogPosts::find($id);

        // return $emailArr;
        if (empty($target)) {
            Session::flash('error', 'Invalid data Id');
            return redirect('blog');
        }


        $qpArr = $request->all();

        return view('admin.blog.edit')->with(compact('target', 'qpArr'));
    }

    public function update(Request $request, $id)
    {
        $target = BlogPosts::find($id);

        // echo '<pre>';print_r($target);exit;

        $qpArr = $request->all();

        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:blog_posts,title,' . $id,
            'slug' => 'required|unique:blog_posts,slug,' . $id,
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('blog/' . $id . '/edit')
                ->withInput()
                ->withErrors($validator);
        }

        $target->title = $request->title;
        $target->slug = $request->slug;
        $target->description = $request->description;
        // return $target;
        if ($target->save()) {
            Session::flash('success', 'Updated Successfully');
            return redirect('blog');
        } else {
            Session::flash('error', 'Could not be Updated');
            return redirect('blog' . $id . '/edit');
        }
    }

    public function destroy(Request $request, $id)
    {
        $target = BlogPosts::find($id);

        $qpArr = $request->all();


        if (empty($target)) {
            session()->flash('error', 'Invalid data id');
        }


        if ($target->delete()) {

            Session::flash('error', 'Deleted Successfully');
        } else {
            Session::flash('error', 'Could not be deleted');
        }
        return redirect('blog');
    }

    public function filter(Request $request)
    {
        $url = 'search=' . urlencode($request->search);
        return Redirect::to('blog?' . $url);
    }


}
