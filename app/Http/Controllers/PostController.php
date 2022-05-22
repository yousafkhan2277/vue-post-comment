<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['media','comments','comments.replies','comments.user','comments.replies.user','user'])->latest()->get();
        return response()->json($posts); 
        return view('post.index',compact('posts'));
    }
    /**
     * Write Your Code..
     *
     * @return string
    */
    public function create()
    {
        return view('post.create');
    }
    /**
     * Write Your Code..
     *
     * @return string
    */
    public function store(Request $request)
    {

        $input = $request->all();
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        $post =  Post::create($input);
        if($request->hasFile('file') && $request->file('file')->isValid()){
            $post->addMediaFromRequest('file')->toMediaCollection('images');
        }

        return response()->json($post);

    }
    /**
     * Write Your Code..
     *
     * @return string
    */
    public function show($id)
    {
        $post = Post::with(['comments','comments.replies','comments.user','comments.replies.user'])->find($id);
        return response()->json($post);
    }

    public function delete($id)
    {


        $post = Post::find($id);
        $post->delete();
        return response()->json(['success' =>true]);
    }

    public function authPost($id)
    {
        $post = Post::where('user_id',$id)->with(['media'])->get();
        return response()->json($post);
    }

    public function update($id, Request $request)
    {

        $post = Post::find($id);
        $post->update($request->all());
        if($request->hasFile('file') && $request->file('file')->isValid()){
            $post->media()->delete();
            $post->addMediaFromRequest('file')->toMediaCollection('images');
            
        }
        return response()->json(['success' =>true]);






    }
    
}
