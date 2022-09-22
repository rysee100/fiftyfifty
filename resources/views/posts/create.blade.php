<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           メンバー
        </h2>
    </x-slot>
      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            　　<div class="max-w-2xl py-4 mx-auto">
                <x-jet-validation-errors class="mb-4" />
                
                @if (session('error'))
                <div class="mb-4 font-medium text-base text-red-600">
                    {{ session('error') }}
                </div>
                @endif

　　　　　 @if(!$members->isEmpty())
            <form method="POST" action="{{ route('posts.store') }}">
                @csrf
                
                 <div class="mx-4">
                    <x-jet-label for="member_name" value="支出者"/>
                   
                        <select name="member_name">
                            @foreach($members as $member)
                            <option value="{{$member->member_name}}">{{$member->member_name}}</option>
                            @endforeach
                        </select>
                </div>
                <div class="mt-4 mx-4">
                    <x-jet-label for="post_name" value="支出名（食費、日用品など）" />
                    <x-jet-input id="post_name" class="block mt-1 w-full" type="text" name="post_name" :value="old('post_name')" required autofocus />
                </div>
                <div class="mt-4 mx-4">
                        <x-jet-label for="price" value="支出額" />
                        <x-jet-input id="price" class="block mt-1 w-full" type="number" name="price" required/>
                 </div>
                 <div class="mt-4 mx-4">
                    <x-jet-label for="comment" value="備考（任意）" />
                    <x-textarea row="3" id="comment" name="comment" class="block mt-1 w-full">{{ old('comment')}}</x-textarea>
                </div>
                    <div class="mt-4 mx-4">
                        <x-jet-label for="date" value="支出日" />
                        <x-jet-input id="date" class="block mt-1 w-full" type="text" name="date" required />
                    </div>
                    <div class="mt-4">
                       <x-jet-button class="ml-4">
                        投稿する
                        </x-jet-button>
                    </div>
            </form>
            @else
            <div class="grid grid-col pb-8">
              <div class="text-center">
                メンバー登録後でないと利用できません。
               </div>
               <div class="text-center">
                  <a href="{{ route('members.index') }}" class=text-blue-600> “メンバー一覧”</a>
                  よりメンバーを２名登録してください。
                 </div>
            @endif
            </div>
               </div>
           </div>
        </div>
    　</div>
         <script src="{{ mix('js/flatpickr.js') }}"></script>
</x-app-layout>