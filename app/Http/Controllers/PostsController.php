<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//  Use Model functions in the controller. 
// It is easier to run DB query without having to wirte SQL .
// This is possible because it is using Elequint (Object Relational Mapper) Library.
use App\Post; 
use DB;

use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all();
        // $posts = Post::orderBy('title', 'asc')->get();
        // $posts = Post::orderBy('title', 'desc')->get();
        // $posts = Post::where('title','Post One')->get();
        // $posts = DB::select('SELECT * FROM posts');
        // $posts = Post::orderBy('title', 'desc')->take(1)->get();

        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('posts.index')->with('posts', $posts);
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
        $this -> validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        // Hanlde file upload
        if($request->hasFile('cover_image')){
            //Get filename with the extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just file name
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        //Create Post
        $post = new Post;
        $post -> title = $request -> input('title');
        $post -> body = $request -> input('body');
        $post -> user_id = auth()->user()->id;
        $post -> cover_image  = $fileNameToStore;
        $post -> save();

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
        $post =  Post::find($id);
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        //Check for correct user
        if(auth()->user()->id !== $post->user_id){
            return redirect('./posts')->with('error', 'Unauthorized Page');
        }

        return view('posts.edit')->with('post',$post);
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

        if($request->hasFile('cover_image')){
            //Get filename with the extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just the filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just the extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }

        //Update Post
        $post = Post::find($id);
        $post -> title = $request -> input('title');
        $post -> body = $request -> input('body');

        if($request->hasFile('cover_image')){
            $post-> cover_image = $fileNameToStore;
        }

        $post -> save();

        return redirect('/posts')->with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete Post
        $post= Post::find($id);

        //Check for the correct user
        if(auth()->user()->id !== $post->user_id){
            return redirect('./posts')->with('error','Unauthorized Page');
        }

        //Check if the post has an image before delete the cover image column.
        if($post->cover_image !== 'noimage.jpg'){
            //Delete Image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post->delete();
        return redirect('/posts')->with('success','Post Removed');
    }
}
