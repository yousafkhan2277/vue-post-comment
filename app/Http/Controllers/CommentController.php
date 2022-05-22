<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{



    public function store(Request $request)
    {

        $input = $request->all();
        $request->validate([
            'body'=>'required',
        ]);
        $comment =  Comment::create($input);
       $commentData = Comment::where('id',$comment->id)->with(['replies','user','replies.user'])->first();
       return response()->json($commentData); 
       
    }
}
