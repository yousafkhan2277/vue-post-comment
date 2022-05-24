<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['media','comments','comments.replies','comments.user','comments.replies.user','user','tags'])->latest()->get();
        return response()->json($posts); 
    }
    /**
     * Write Your Code..
     *
     * @return string
    */

    /**
     * Write Your Code..
     *
     * @return string
    */
    public function store(Request $request)
    {
        $tagsId = $request->input('tag');
        
        // dd($tagsId[0]);
        
        // foreach ($tagsId as $tagId)
        // { 
        //     dd($tagId);

        // }

        $input = $request->all();
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        $post =  Post::create($input);
        
        $post->tags()->attach($tagsId);

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
        $post = Post::with(['comments','comments.replies','comments.user','comments.replies.user','tags'])->find($id);
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
