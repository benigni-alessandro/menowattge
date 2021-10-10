<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-post|crear-post|editar-post|borrar-post', ['only'=>['index']]);
        $this->middleware('permission:crear-post', ['only'=>['create', 'store']]);
        $this->middleware('permission:editar-post', ['only'=>['editar', 'update']]);
        $this->middleware('permission:borrar-post', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));

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
        $request->validate([
        'title'=>'required|string|max:255|unique:posts',
        'content'=>'nullable',
        'thumb'=>'image|max:6000|required',
        'users_id' => 'exists:users,id|nullable',
        ]);
        $data = $request->all();        
        $url = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
        if ($request['photo']) {
            $file = $request['photo'];
            $name = time() . $file->getClientOriginalName();
            $filePath = 'images/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
        }
        
        $data['user_id'] = Auth::user()->id;
        $post = new Post();
        $post->fill($data);
        $post->thumb = $file;
        $post->user_id = $data['user_id'];
        $post->slug = $this->generateSlug($post->title);
        $post->save();
        return redirect()->route('posts.index', compact('post'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('posts.edit', compact('post'));
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
        $request->validate([
            'title'=>'required',
            'content'=>'nullable',
            'thumb'=>'nullable',
            ]);
        $data = $request->all();
        $data['slug'] = $this->generateSlug($data['title'], $post->title != $data['title'], $post->slug);

        

        if (array_key_exists('thumb', $data)) {
            $thumb = Storage::put('uploads', $data['thumb']);
            $data['thumb'] = $thumb;
        }
        $post->update($data);
        return redirect()->route('posts.index', compact('post'));
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

        if ($post)  {
            if ($post->delete()){
                 DB::statement('ALTER TABLE posts AUTO_INCREMENT = '.(count(Post::all())+1).';');
                    }   
            }
        return redirect()->route('posts.index');
    }

    private function generateSlug(string $title, bool $change = true, string $old_slug = '') {
        if (!$change) {
          return $old_slug;
        }
        $slug = Str::slug($title,'-');
        $slug_base = $slug;
        $contatore = 1;
        $post_with_slug = Post::where('slug','=',$slug)->first();
        while($post_with_slug) {
          $slug = $slug_base . '-' . $contatore;
          $contatore++;
          $post_with_slug = Post::where('slug','=',$slug)->first();
      }
        return $slug;
  }
}
