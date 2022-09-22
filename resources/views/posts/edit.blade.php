<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           メンバー
        </h2>
    </x-slot>
      <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            　　<div class="max-w-2xl py-4 mx-auto">
                <x-jet-validation-errors class="mb-4" />
                
                @if (session('error'))
                <div class="mb-4 font-medium text-base text-red-600">
                    {{ session('error') }}
                </div>
                @endif

            <form method="POST" action="{{ route('posts.update', ['post' => $post->id ] ) }}">
            @csrf
            @method('put')
                
                 <div class="mt-4">
                    <x-jet-label for="member_name" value="支出者" />
                        <select name="member_name">
                            @foreach($members as $member)
                            <option value="{{$member->member_name}}" @if($post->member_id ==  $member->id) selected @endif>{{$member->member_name}}</option>
                            @endforeach
                            <input type="hidden" name="member_id" value="{{ $member->id }}"> 
                        </select>
                </div>
                <div class="mt-4 mx-4">
                    <x-jet-label for="post_name" value="支出名" />
                    <x-jet-input id="post_name" class="block mt-1 w-full" type="text" name="post_name" value="{{ $post->post_name }}" required autofocus />
                </div>
                <div class="mt-4 mx-4">
                        <x-jet-label for="price" value="支出額" />
                        <x-jet-input id="price" class="block mt-1 w-full" type="number" name="price" value="{{ $post->price }}" required/>
                 </div>
                 <div class="mt-4 mx-4">
                    <x-jet-label for="comment" value="備考（任意）" />
                    <x-textarea row="3" id="comment" name="comment" class="block mt-1 w-full">{{ $post->comment }}</x-textarea>
                </div>
                    <div class="mt-4 mx-4">
                        <x-jet-label for="date" value="支出日" />
                        <x-jet-input id="date" class="block mt-1 w-full" type="text" name="date" value="{{ $post->date }}" required />
                    </div>
                    <div class="mt-4 mx-4"> 
                       <x-jet-button class="ml-4">
                        編集する
                        </x-jet-button>
                    </div>
            </form>
            </div>
         </div>
        </div>
         <script src="{{ mix('js/flatpickr.js') }}"></script>
</x-app-layout>