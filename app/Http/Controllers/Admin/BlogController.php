<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPosts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class BlogController extends Controller
{
    public function index(Request $request)
    {

        $qpArr = $request->all();
        $targetArr = BlogPosts::orderBy('id', 'desc');
        $titleArr = BlogPosts::select('title')->orderBy('id', 'desc')->get();

        //begin filtering
        $searchText = $request->search;
        if (!empty($searchText)) {
            $targetArr->where(function ($query) use ($searchText) {
                $query->where('title', 'LIKE', '%' . $searchText . '%');
            });
        }
        //end filtering

        $targetArr = $targetArr->paginate();

        return view('admin.blog.index')->with(compact('targetArr', 'qpArr', 'titleArr'));
    }

    public function create(Request $request)
    {
        $qpArr = $request->all();

        return view('admin.blog.create')->with(compact('qpArr'));
    }

    public function store(Request $request)
    {
        $qpArr = $request->all();

        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:blog_posts,title',
            'slug' => 'required|unique:blog_posts,slug',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('blog/create')
                ->withInput()
                ->withErrors($validator);
        }

        $target = new BlogPosts;
        $target->title = $request->title;
        $target->slug = $request->slug;
        $target->description = $request->description;
        $target->user_id = Auth::id();

        // return $target;

        if ($target->save()) {
            Session::flash('success', 'Created Successfully');
            return redirect('/blog');
        } else {
            Session::flash('error', 'Could Not be Created');
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
