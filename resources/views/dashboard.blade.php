<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           ホーム
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-xl">
                <section class="text-gray-600 body-font">
                   <form method="GET" action="{{ route('dashboard') }}">
               @if($posts->isNotEmpty())
                 <div class="ml-6 mt-6">
                    <select name="month">
                        @foreach($months as $month)
                        <option value="{{$month}}">{{$month}}分</option>
                        @endforeach
                    </select>
                    <button class="ml-2 text-white bg-orange-500 border-0 py-2 px-6 hover:bg-orange-400 rounded">
                    精算額を確認する
                    </button>
                </div>
                @endif
                 @if($monthPrice)
                 <div class="grid justify-items-center my-8">
                    <div class="text-xl font-bold sm:text-2xl">
                    {{$selectMonth}}
                    総支出額
                   {{number_format($monthPrice)}}
                    円
                    </div>
                    <div class="text-lg text-center font-bold mt-2 mx-2 grid grid-column lg:flex flex-center sm:text-xl">
                       @if($memberMonthTotal < 0)
                        {{$secondMember['member_name']}}さんは{{$firstMember->member_name}}さんに
                        <span class="text-red-600 text-center">{{number_format(abs($memberMonthTotal))}}円</span>
                        支払ってください。
                        @else
                        {{$firstMember->member_name}}さんは{{$secondMember['member_name']}}さんに
                        <span class="text-red-600 text-center">{{number_format(abs($memberMonthTotal))}}円</span>
                        支払ってください。
                        @endif
                    </div>
                 </div>
                @endif
                </form>
                 <div class="md:mt-4 mt-12 mr-6">
                    <button onclick="location.href='{{ route('posts.create')}}'" class="flex ml-auto text-white bg-green-600 border-0 py-2 px-6 hover:bg-green-500 rounded">投稿する</button>
     　　　     　  </div>
                 
                  <div class="container px-5 py-2 mx-auto">
                          @if (session('status'))
                            <div class="mb-4 font-medium text-lg text-green-700">
                                {{ session('status') }}
                            </div>
                          @endif
                    @foreach($posts as $post)
                      <div class="grid grid-col mx-6  mb-4 py-4 px-6 bg-orange-50 rounded-lg border">
                           @foreach($members as $member)
                             @if($post->member_id ==  $member->id)
                              <div class="text-base">{{ $member->member_name }}</div>
                             @endif
                           @endforeach
                         <div class="text-xl mt-4 font-bold">{{ $post->post_name }}</div>
                         <div class="text-xl mt-2">¥ {{ number_format($post->price) }}</div>
                         <div class="text-base mt-4">{{ $post->comment }}</div>
                         <div class="flex justify-end">
                           <div class="text-sm text-right mt-2">{{ $post->postDate }}</div>
                           <form method="get" action="{{ route('posts.edit', ['post' => $post->id ]) }}">
                             <div class="text-sm text-right mt-2">
                               <button class="ml-5 text-blue-500">編集</button>
                             </div>
                           </form>
                           <form class="delete" method="post" onsubmit="return confirm('本当に削除しますか？')" action="{{ route('posts.destroy', ['post' => $post->id ]) }}">
                              @csrf
                              @method('delete')
                              <div class="text-sm text-right mt-2">
                                <button type="submit"  class="ml-5 text-red-500">削除</button>
                              </div>
                            </form>
                           </div>
                      </div>
                    @endforeach
                  </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
