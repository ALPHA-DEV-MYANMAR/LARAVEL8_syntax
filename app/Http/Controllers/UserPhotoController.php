<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserPhotoRequest;
use App\Http\Requests\UpdateUserPhotoRequest;
use App\Models\UserPhoto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserPhotoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserPhotoRequest $request)
    {
        if(!Storage::exists('public/userphoto')){
            Storage::makeDirectory('public/userphoto');
        }

        if($request->hasFile('photo')){

            $newName = uniqid().'_photo.'.$request->photo->extension();
//                $photo->storeAs('public/photos',$newName);
            $img = Image::make($request->photo);
            $img->fit('200','200');
            $img->save('storage/userphoto/'.$newName);
            //save on db
            $photo = new UserPhoto();
            $photo->photo = $newName;
            $photo->user_id = Auth::user()->id;
            $photo->save();
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserPhoto  $userPhoto
     * @return \Illuminate\Http\Response
     */
    public function show(UserPhoto $userPhoto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserPhoto  $userPhoto
     * @return \Illuminate\Http\Response
     */
    public function edit(UserPhoto $userPhoto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserPhotoRequest  $request
     * @param  \App\Models\UserPhoto  $userPhoto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserPhotoRequest $request, UserPhoto $userPhoto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserPhoto  $userPhoto
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserPhoto $userPhoto)
    {
        //
    }
}
