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

        <form method="POST" action="{{ route('members.update', ['member' => $member->id ]) }}">
  
            @csrf
            @method('put')

            <div class="mt-4 mx-4 mb-4">
                <x-jet-label for="member_name" value="変更後の名前" />
                <x-jet-input id="member_name" class="block mt-1 w-full" type="text" name="member_name" value="{{ $member->member_name }}" required autofocus />
            </div>
            
            <div class="md:flex justify-between items-end">
                <x-jet-button class="ml-4">
                    変更
                </x-jet-button>
            </div>

        </form>
            </div>
         </div>
        </div>
    </div>
 
 
</x-app-layout>