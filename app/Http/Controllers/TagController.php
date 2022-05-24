<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
       $tags=Tag::all();
        return response()->json($tags); 
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $request->validate([
            'name' => 'required',
        ]);
        $tag =  Tag::create($input);
        
        return response()->json($tag);

    }
}
