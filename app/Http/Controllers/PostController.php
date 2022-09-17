<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $posts = Post::where('user_id', '=', Auth::id())
                 ->paginate(10);
        
       $members = Member::where('user_id', '=', Auth::id())->get();
        
        return view('dashboard', compact('posts', 'members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = Member::where('user_id', '=', Auth::id())->get();
        
        return view('posts.create', compact('members'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validated = $request->validate([
        'member_name' => ['required'],
        'post_name' => ['required', 'max:50'],
        'price' => ['required', 'numeric', 'between:1,10000000'],
        'comment' => ['max:200'],
        'date' => ['required', 'date'],
       ]);
       
       $member = Member::where('user_id', '=', Auth::id())->where('member_name', $request['member_name'])->first();
       
        Post::create([
           'user_id' => Auth::id(),
           'member_id' => $member->id,
           'post_name' => $request['post_name'],
           'price' => $request['price'],
           'comment' => $request['comment'],
           'date' => $request['date']
        ]);
        
        
        session()->flash('status', '登録okです');
        
        return to_route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $post = Post::findOrFail($post->id);
        
        $members = Member::where('user_id', '=', Auth::id())->get();
        
        return view('posts.edit',
        compact('post', 'members'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
        'member_name' => ['required'],
        'post_name' => ['required', 'max:50'],
        'price' => ['required', 'numeric', 'between:1,10000000'],
        'comment' => ['max:200'],
        'date' => ['required', 'date'],
       ]);
       
       $member = Member::where('user_id', '=', Auth::id())->where('member_name', $request['member_name'])->first();
       
       $post->user_id = Auth::id();
       $post->member_id = $member->id;
       $post->post_name = $request['post_name'];
       $post->price = $request['price'];
       $post->comment = $request['comment'];
       $post->date = $request['date'];
       $post->save();
       
       session()->flash('status', '更新しました');
        
        return to_route('dashboard');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::findOrFail($id)->delete();
        
        session()->flash('status', '削除しました');
        
        return to_route('dashboard');
    }
}
