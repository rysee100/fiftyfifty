<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           ホーム
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form method="GET" action="{{ route('dashboard') }}">
                <div class="m-4">
                    <select name="month">
                        @foreach($months as $month)
                        <option value="{{$month}}">{{$month}}分</option>
                        @endforeach
                    </select>
                    <button class="ml-2 text-white bg-orange-500 border-0 py-2 px-6 hover:bg-orange-400 rounded">
                    表示する
                   </button>
                </div>
                @if($monthPrice)
                <div>
                    {{$selectMonth}}
                    合計額
                {{number_format($monthPrice)}}
                    円<br>
                       @if($memberMonthTotal < 0)
                        {{$member->member_name}}は{{number_format(abs($memberMonthTotal))}}円もらう
                        @else
                        {{$member->member_name}}は{{number_format(abs($memberMonthTotal))}}円支払う
                        @endif
                </div>
                @endif
                </form>
                 <div class="mr-4">
                    <button onclick="location.href='{{ route('posts.create')}}'" class="flex mt-4 ml-auto text-white bg-green-600 border-0 py-2 px-6 hover:bg-green-500 rounded">投稿する</button>
     　　　     　  </div>
               <section class="text-gray-600 body-font">
                 
                  <div class="container px-5 py-2 mx-auto">
                          @if (session('status'))
                            <div class="mb-4 font-medium text-base text-green-600">
                                {{ session('status') }}
                            </div>
                          @endif
                    @foreach($posts as $post)
                      <div class="w-full mr-4 mb-4 p-4 bg-orange-50 sm:rounded-lg border">
                           @foreach($members as $member)
                             @if($post->member_id ==  $member->id)
                              <div class="text-base">{{ $member->member_name }}</div>
                             @endif
                           @endforeach
                         <div class="text-xl mt-4 font-bold">{{ $post->post_name }}</div>
                         <div class="text-xl mt-2">¥ {{ number_format($post->price) }}</div>
                         <div class="text-base mt-4">{{ $post->comment }}</div>
                         <div class="flex justify-end">
                          <div class="text-sm text-right mt-2">{{ $post->date }}</div>
                           <form method="get" action="{{ route('posts.edit', ['post' => $post->id ]) }}">
                            <div class="text-sm text-right mt-2">
                             <button class="ml-4 text-blue-500">編集</button>
                            </div>
                           </form>
                           <form class="delete" method="post" onsubmit="return confirm('本当に削除しますか？')" action="{{ route('posts.destroy', ['post' => $post->id ]) }}">
                              @csrf
                              @method('delete')
                              <div class="text-sm text-right mt-2">
                                <button type="submit"  class="ml-4 text-red-500">削除</button>
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
