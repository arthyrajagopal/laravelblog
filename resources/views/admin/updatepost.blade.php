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
                <!-- display this single post -->
                   <form action ="{{ route('admin.postupdate', $post->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="title" value="{{$post->title}}"><br><br><br>
                        <textarea style ="width:400px ;height: 400px;"name="description" id="">Write post here!
                        </textarea><br><br><br>
                        <label style="background-color: lightgreen;">upload new</label>
                        <img src="{{asset('img/'.$post->image)}}"style="width:100px; height: 100px; margin-left: 450px; margin-bottom:10px;"alt="{{$post->image}}">
                        <input type="file" name="image"><br><br><br>
                        <input style="border: 1px solid blue; text-align:centre; padding:10px" type="submit" name="submit" value="update post">
                    </form>
 
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>
