<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Photo;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::when(isset(request()->search),function ($query){
            $search = request()->search;
            $query->where('title',"LIKE","%$search%")
            ->orWhere('description',"LIKE","%$search%");

        })->latest('id')->paginate(5);
        return view('post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        Gate::authorize('create',Post::class);

        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {

//        Gate::authorize('create',Post::class);

//        $request->validate([
//            'title' => 'required|unique:posts,title|min:3',
//            'description' => 'required|min:20',
//            'category_id' => 'required|integer|exists:categories,id',
//            'photo' => 'required',
//            "tags" => "required",
//            "tags.*" => "integer|exists:tags,id",
//            'photo.*' => 'required|file|mimes:jpg,png',
//        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt =  Str::limit($request->description,100);
        $post->category_id = $request->category_id;
        $post->user_id = Auth::user()->id;
        $post->is_publish = true;
        $post->save();

        //save tags
        $post->tags()->attach($request->tags);

        if(!Storage::exists('public/thumbnail')){
            Storage::makeDirectory('public/thumbnail');
        }

        if($request->hasFile('photo')){

            foreach($request->file('photo') as $photo){

                $newName = uniqid().'_photo.'.$photo->extension();

                $photo->storeAs('public/photos',$newName);

                $img = Image::make($photo);
                $img->fit('50','50');
                $img->save('storage/thumbnail/'.$newName);

                //save on db
                $photo = new Photo();
                $photo->name = $newName;
                $photo->user_id = Auth::user()->id;
                $photo->post_id = $post->id;
                $photo->save();

            }
        }

        return redirect()->route('post.create')->with('status','success to created post');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {

//        if (! Gate::allows('update-post', $post)) {
//            abort(403);
//        }

        Gate::authorize('update', $post);

        return view('post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {

//        Gate::authorize('update', $post);

//        $request->validate([
//            'title' => 'required|unique:posts,title,'.$post->id.'|min:3',
//            'description' => 'required|min:20',
//            'category_id' => 'required|integer|exists:categories,id',
//            "tags" => "required",
//            "tags.*" => "integer|exists:tags,id"
//        ]);

        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt =  Str::limit($request->description,100);
        $post->category_id = $request->category_id;
        $post->user_id = Auth::user()->id;
        $post->is_publish = true;
        $post->save();

        $post->tags()->attach($request->tags);

        return redirect()->route('post.create')->with('status','successfully updated post!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        Gate::authorize('delete', $post);

        foreach ($post->photos as $photo){
            //file delete
            Storage::delete('public/photos/'.$photo->name);
            Storage::delete('public/thumbnail/'.$photo->name);
        }

        // delete all record from hasMany
        $post->photos()->delete();

        $post->delete();
        return redirect()->back()->with('status',"successfully deleted post!");
    }
}
