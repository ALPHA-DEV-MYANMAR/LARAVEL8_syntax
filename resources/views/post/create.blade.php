@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            Post Created
                            <a href="{{ route('post.index') }}" class="btn btn-primary">All Post</a>
                        </div>
                    </div>
                    <div class="card-body">
                       <form action="{{ route('post.store') }}" class="w-50 mx-auto" id="postForm" method='post' enctype="multipart/form-data">
                           @csrf
                           <div class="m-2">
                               <label for="">Post Title</label>
                               <input type="text" class='form-control  @error('title') is-invalid @enderror' name="title" value={{ old('title') }} >
                           </div>
                           @error('title')
                                <p class='text-danger'>{{ $message }}</p>
                           @enderror

                           <div class="m-2 ">
                               <label for="">Post Images</label>
                               <input type="file" name='photo[]' value="{{ old('photo') }}" class="form-control @error('photo') is-invalid @enderror" multiple>
                           </div>
                           @error('photo')
                           <p class='text-danger'>{{ $message }}</p>
                           @enderror

                           <div class="m-2">
                               @foreach(\App\Models\Tags::all() as $tag)
                                   <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}" id="tag{{ $tag->id }}" {{ in_array($tag->id,old('tags',[])) ? 'checked' : '' }}>
                                       <label class="form-check-label" for="{{ $tag->id }}">
                                           {{ $tag->name }}
                                       </label>
                                   </div>
                               @endforeach

                               @error('tags')
                                    <p class="text-danger small">{{ $message }}</p>
                               @enderror
                               @error('tags.*')
                                    <p class="text-danger small">{{ $message }}</p>
                               @enderror
                           </div>

                           <div class="m-2">
                               <label for="">Post Description</label>
                                <textarea  id="" cols="30" rows="5" name='description' class='form-control @error('description') is-invalid  @enderror' placeholder='enter description'>{{ old('description') }}</textarea>
                           </div>
                           @error('description')
                           <p class='text-danger'>{{ $message }}</p>
                            @enderror

                           <div class="m-2">
                                <select class="form-select" aria-label="Default select example" name='category_id'>
                                    @foreach (\App\Models\category::all() as $category)
                                        <option value="{{ $category->id }}"
                                        {{ $category->id == old('category_id') ? 'selected' : '' }}
                                        >{{ $category->name }}</option>
                                    @endforeach
                                </select>
                           </div>
                           @error('category_id')
                           <p class='text-danger'>{{ $message }}</p>
                           @enderror

                       </form>
                    </div>
                    <div class="card-footer">
                        <div class="">
                            <div class='d-flex justify-content-between align-items-center'>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" required>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Confirm</label>
                                </div>
                                <div>
                                    <Button class='btn btn-primary' form="postForm">Post</Button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


@endsection
