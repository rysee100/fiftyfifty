<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;
use Carbon\Carbon;

class PostController extends Controller
{
    
    public function index(Request $request)
    {
        
        if(!is_null($request->month))
        {
           $date = Carbon::rawCreateFromFormat('Y年m月', $request->month);
           
            $year = $date->format('Y');
            $month = $date->format('m');
          
           $posts = Post::where('user_id', '=', Auth::id())
                   ->whereYear('date', $year)
                   ->whereMonth('date', $month)
                   ->orderBy('date', 'desc')
                   ->get(); 
                   
           $selectMonth = $year . "年" . $month . "月分";
           
           
          $arrayMonthPrice = Post::selectRaw('SUM(price) as month_price')
                            ->where('user_id', '=', Auth::id())
                            ->whereYear('date', $year)
                            ->whereMonth('date', $month)
                            ->get()
                            ->toArray();
                            
                            
          $arrayMonthPrice = array_shift($arrayMonthPrice);
                
        
          $monthPrice = (int)$arrayMonthPrice['month_price'];
            
        
        $firstMember = Member::where('user_id', '=', Auth::id())->first();
        
        $arraySecondMember = Member::where('user_id', '=', Auth::id())
                       ->where('id', '!=', $firstMember->id)
                       ->get()
                       ->toArray();
                       
        $secondMember = array_shift($arraySecondMember);
        
        
        $arrayMemberMonthPrice = Post::selectRaw('SUM(price) as month_price')
                            ->where('user_id', '=', Auth::id())
                            ->whereYear('date', $year)
                            ->whereMonth('date', $month)
                            ->where('member_id', '=',  $firstMember->id)
                            ->get()
                            ->toArray();
                            
        $arrayMemberMonthPrice = array_shift($arrayMemberMonthPrice);
                            
        $memberMonthPrice = (int)$arrayMemberMonthPrice['month_price'];
        
        $memberMonthTotal = ($monthPrice / 2) -  $memberMonthPrice;
  
        } 
        
        else
        {
            $posts = Post::where('user_id', '=', Auth::id())
           ->orderBy('date', 'desc')
           ->get(); 
           
           $monthPrice = null;
           $selectMonth = null;
           $member = null;
           $memberMonthTotal = null;
           $firstMember = null;
           $secondMember = null;
        }
        
      $allPost = Post::where('user_id', '=', Auth::id())
                 ->orderBy('date', 'desc')
                 ->get();
                 
      if($allPost->isNotEmpty())
      {
      
      foreach($allPost as $onlyPost)
      {
       $dateList = Carbon::rawCreateFromFormat('Y-m-d', $onlyPost->date);
       
       $dateListYear = $dateList->format('Y');
       $dateListMonth = $dateList->format('m');
       
       $monthList = $dateListYear . "年" .  $dateListMonth . "月";
       
        $months[] = $monthList;
      }
     
      $months = array_unique($months);
        
       $members = Member::where('user_id', '=', Auth::id())->get();
       
      } 
      
      else {
          $months = null;
          $members = null;
      }
       
        
        return view('dashboard', 
        compact('posts', 'months', 'members', 'monthPrice', 'selectMonth', 'firstMember', 'secondMember', 'memberMonthTotal'));
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
        
        
        session()->flash('status', '登録しました');
        
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
        $this->middleware('auth');
        
        $post = Post::findOrFail($post->id);
        
        $postsUserId = $post->user_id;
        $userId = (int)$postsUserId;
        $authId = Auth::id();
        if($userId !== $authId){
           abort(404);
        }
        
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
