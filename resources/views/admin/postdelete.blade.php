<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        @if(Auth::check() && Auth::User()->usertype=='admin')   
        {{ __('Admin Dashboard') }}
        @else
        {{ __('User Dashboard') }}
        @endif
        </h2>
    </x-slot>
    @section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1>Post id :</h1>{{$post->id}}
                <!-- display this single post -->
                   <form action ="{{ route('admin.postdelete', $post->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="id" placeholder ="Enter post id here" required><br><br><br>
                        
                        <input style="border: 1px solid blue; text-align:centre; padding:10px" type="submit" name="submit" value="delete post">
                    </form>
 
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>
