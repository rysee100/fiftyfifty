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
                
                @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
                @endif

　　　　　 @if(!$members->isEmpty())
            <form method="POST" action="{{ route('posts.store') }}">
                @csrf
                
                 <div>
                    <x-jet-label for="member_name" value="支出者" />
                   
                        <select name="member_name">
                            @foreach($members as $member)
                            <option value="{{$member->member_name}}">{{$member->member_name}}</option>
                            @endforeach
                        </select>
                </div>
                <div class="mt-4">
                    <x-jet-label for="post_name" value="支出名" />
                    <x-jet-input id="post_name" class="block mt-1 w-full" type="text" name="post_name" :value="old('post_name')" required autofocus />
                </div>
                <div class="mt-4">
                        <x-jet-label for="price" value="支出額" />
                        <x-jet-input id="price" class="block mt-1 w-full" type="number" name="price" required/>
                 </div>
                 <div class="mt-4">
                    <x-jet-label for="comment" value="備考" />
                    <x-textarea row="3" id="comment" name="comment" class="block mt-1 w-full">{{ old('comment')}}</x-textarea>
                </div>
                    <div class="mt-4">
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
            <div class="flex justify-center pb-8">
            メンバー登録後でないと利用できません。<br>
               “メンバー一覧”よりメンバーを２名登録してください。
            @endif
            </div>
               </div>
           </div>
        </div>
    　</div>
         <script src="{{ mix('js/flatpickr.js') }}"></script>
</x-app-layout>