<?php

namespace App\Http\Controllers;
use App\models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function addpost(){
        return view("admin.addpost");
    }
   public function createpost(Request $request)
{
    $post = new Post();
    $post->title = $request->title;
    $post->description = $request->description;

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imagename = time() . '.' . $image->getClientOriginalExtension();

        // Move file to public/img
        $image->move(public_path('img'), $imagename);

        $post->image = $imagename;
    } else {
        $post->image = null; // optional: handle case when no image uploaded
    }

    $post->user_name = Auth::user()->name;
    $post->user_id = Auth::id();

    if ($post->save()) {
        return redirect()->route('admin.addpost')->with('status', 'Added success');
    } else {
        return redirect()->back()->with('error', 'Something went wrong!');
    }
}
public function allpost(){
    $post = Post::all();
    return view('admin.allpost',compact('post'));
}
public function updatepost($id){
    $post =Post::findOrFail($id);
    return view('admin.updatepost',compact('post'));
}
public function postupdate(Request $request, $id)
{
    // Find the post to update
    $post = Post::findOrFail($id);

    $post->title = $request->title;
    $post->description = $request->description;

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imagename = time() . '.' . $image->getClientOriginalExtension();

        // Move file to public/img
        $image->move(public_path('img'), $imagename);

        // Save filename in DB
        $post->image = $imagename;
    }

    $post->user_name = Auth::user()->name;
    $post->user_id = Auth::id();

    if ($post->save()) {
        return redirect()->route('admin.allpost')->with('status', 'Post updated successfully!');
    } else {
        return redirect()->back()->with('error', 'Something went wrong!');
    }
}
public function deletepost($id){

    $post =Post::findOrFail($id);
    return view('admin.postdelete',compact('post'));
}
public function postdelete(Request $request,$id){
    $post =Post::findOrFail($id);
  if($request->id==$post->id){
    $post->delete();
    return redirect()->route('admin.allpost')->with('danger', 'Post deleted successfully!');
}
else{
    return redirect()->route('admin.allpost');

}
}
}
