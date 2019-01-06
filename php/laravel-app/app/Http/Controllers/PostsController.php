<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// aduce modelul
use App\Post;
// Pentru a folosi sql query
use DB;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // exceptii de la autentificare
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // fech all data
        // $posts = Post::all();
        //  $posts = Post::orderBy('title', 'desc')->get();
        // limitari
        // $posts = Post::orderBy('title', 'desc')->take(1)->get();
        // daca am adus baza de date mai sus use DB;
        // $posts = DB::select('SELECT * FROM posts');
        // resource/asset
        // Paginare paginate(1) pagineaza 1 pe pagina
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
        // valdiate ($request, array de reguli)
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image |nullable|max:1999'
        ]);

        // Handle file upload
        if($request->hasFile('cover_image')){
            // Get filename with the etension
            $fileNameExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($fileNameExt, PATHINFO_FILENAME);
            // Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }else {
            $fileNameToStore = 'noimg.jpg';
        }

        // Create post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        // pune posturile legate la id din tabela user
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
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
        // sau
        // $post = Post::where($id);
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
        // Check for corect user
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorize Page');
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
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);
// Handle file upload
    if($request->hasFile('cover_image')){
        // Get filename with the etension
        $fileNameExt = $request->file('cover_image')->getClientOriginalName();
        // Get just filename
        $filename = pathinfo($fileNameExt, PATHINFO_FILENAME);
        // Get just extension
        $extension = $request->file('cover_image')->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore = $filename . '_' . time() . '.' . $extension;
        // Upload Image
        $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
    }
        // Create post
        $post = Post::find($id);
        // Check for corect user
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorize Page');
        }
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        }
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
        $post = Post::find($id);
        // Check for corect user
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorize Page');
        }
        if($post->cover_image != 'noimg.jpg') {
            // Delete imag
            Storage::delete('public/cover_images'.$post->cover_image);
        }
        $post->delete();
        return redirect('/posts')->with('success', 'Post Delete');
    }
}
