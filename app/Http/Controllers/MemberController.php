<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    
    public function index()
    {
        $members = Member::where('user_id', '=', Auth::id())
                 ->get();
        
        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('members.create');
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
        'first_member_name' => ['required', 'max:10'],
        'second_member_name' => ['required', 'max:10']
    ]);
    
    if($request->first_member_name === $request->second_member_name){
            session()->flash('error', 'メンバー1とメンバー2の名前が重複しています。');
            return view('members.create');
        }
        
        Member::create([
            'user_id' => Auth::id(),
           'member_name' => $request['first_member_name']
        ]);
        
         Member::create([
            'user_id' => Auth::id(),
           'member_name' => $request['second_member_name']
        ]);
        
        session()->flash('status', '登録しました');
        
        return to_route('members.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        $this->middleware('auth');
        
        $member = Member::findOrFail($member->id);
        
        $memberUserId = $member->user_id;
        $userId = (int)$memberUserId;
        $authId = Auth::id();
        if($userId !== $authId){
           abort(404);
        }
        
        
        return view('members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
       $validated = $request->validate([
        'member_name' => ['required', 'max:10'],
       ]);
       
      $allMember = Member::where('user_id', '=', Auth::id())
                 ->get();
        
        foreach($allMember as $onlyMember)
        {
            if($onlyMember->id !== $member->id)
            {
                if($onlyMember->member_name === $request['member_name'])
                {
                    session()->flash('error', 'メンバー1とメンバー2の名前が重複しています。');
                    return view('members.edit', compact('member'));
                }
            }
        }
  
       
       $member->member_name = $request['member_name'];
       $member->save();
        
        session()->flash('status', '更新しました');
        
        return to_route('members.index');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
