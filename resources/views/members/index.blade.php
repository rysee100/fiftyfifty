<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           メンバー 一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
               <section class="text-gray-600 body-font">
                 
                  <div class="container px-5 py-2 mx-auto">
                          @if (session('status'))
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ session('status') }}
                            </div>
                          @endif
                          
          @if(count($members) < 2)
          <div class="flex justify-center m-4">
             <div>
               こちらからメンバー登録をしてください
             </div>
          </div>
           <div class="flex justify-center mb-4">
             <div>
               <button onclick="location.href='{{ route('members.create')}}'" class="flex mt-4 ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">新規登録</button>
             </div>
          </div>
          @else                 
            <div class="w-full mx-auto overflow-auto">
              <table class="table-auto w-full text-left whitespace-no-wrap">
                <thead>
                  <tr>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-orange-100">名前</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($members as $member)
                      <form method="get" action="{{ route('members.edit', ['member' => $member->id ]) }}">
                  <tr>
                    <td class="px-4 py-3">
                        <button class="ml-4 text-blue-500">{{ $member->member_name }}</button>
                    </td>
                  </tr>
                      </form>
                  　@endforeach
                </tbody>
                </table>
            </div>
          @endif
  </div>
</section>
            </div>
        </div>
    </div>
</x-app-layout>