<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogPosts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class BlogApiController extends Controller
{
    public function index(Request $request)
    {

        $targetArr = BlogPosts::all();

        return response($targetArr);
    }

    public function create(Request $request)
    {
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
            return response()->json([
                'status' => 400,
                'message' => $validator->messages()
            ], 400);
        } else {

            $target = new BlogPosts;
            $target->title = $request->title;
            $target->slug = $request->slug;
            $target->description = $request->description;
            $target->user_id = Auth::id();

            // return $target;

            $target->save();
            return response()->json([
                'status' => 200,
                'message' => 'Blog (' . $request->title . ') Created Successfully'
            ], 200);
        }
    }

    public function show($id)
    {

        $blog = BlogPosts::find($id);
        if ($blog) {
            return response($blog);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Blog id ' . $id . ' not found'
            ], 404);
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

        if ($target) {
            $validator = Validator::make($request->all(), [
                'title' => 'required|unique:blog_posts,title,' . $id,
                'slug' => 'required|unique:blog_posts,slug,' . $id,
                'description' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'message' => $validator->messages(),
                ], 400);
            } else {

                $target->title = $request->title;
                $target->slug = $request->slug;
                $target->description = $request->description;
                $target->update();
                // return $target;
                return response()->json([
                    'status' => 200,
                    'message' => $request->name . ' updated',
                ], 200);
            }
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Blog Id ' . $id . ' not found'
            ], 404);
        }
    }

    public function destroy(Request $request, $id)
    {
        $target = BlogPosts::find($id);

        if ($target) {
            $target->delete();
            return response()->json([
                'message' => 'Id (' . $id . ') and name (' . $target->title . ') deleted'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Blog ' . $id . ' not found'
            ], 404);
        }
    }
}
