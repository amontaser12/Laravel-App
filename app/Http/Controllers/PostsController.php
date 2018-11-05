<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;
use App\user;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::orderBy('created_at', 'desc')->get();
        return view('posts.index')->with('post' , $post);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request , ['title' => 'required' , 'body' =>"required" , 'cover_image' => 'image|nullable|max:1999']);
        if($request->hasFile('cover_image')){
            $fullName = $request->file('cover_image')->getClientOriginalName();
            $imgName = pathinfo($fullName , PATHINFO_FILENAME);
            $ext = $request->file('cover_image')->getClientOriginalExtension();
            $nameToStore = $fullName.'_'.time().'.'.$ext;
            $path = $request->file('cover_image')->storeAs('public/cover_image', $nameToStore);
        }else{
            $nameToStore = 'noImage.jpg';
        }
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->title;
        $post->cover_image = $nameToStore;
        $post->user_id = Auth::user()->id;
        $post->save();
        return redirect('/posts')->with('success', 'Post Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $user_id= Auth::user()->id;
        $user = User::find($user_id);
        $posts = $user->post;
        $data = array(
            'user' => $user,
            'post' => $post,
            'user_id' => $user_id,
            'posts' => $posts
        );
        return view('posts.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post= Post::find($id);
        return view('posts.edit')->with('post' ,$post);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request , ['title' => 'required' , 'body' =>"required"]);
        $post = Post::find($id);
        $post->title = $request->title;
        $post->body = $request->title;
        $post->save();
        return redirect('/posts')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post= Post::find($id);
        $post->delete();
        return redirect('/posts')->with('success', 'Post Deleted');

    }
}
