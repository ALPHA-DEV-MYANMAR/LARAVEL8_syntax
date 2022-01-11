@extends('layouts.app')
@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">

                <div class="card">

                    <div class="card-header">
                        Edit Post
                    </div>
                    <div class="card-body">

                        <form action="{{ route('post.update',$post->id) }}" method="post" id="UpdatePostForm">
                            @csrf
                            @method('put')
                        </form>

                            <div class="mb-3">
                                <label class="form-label">Post Title</label>
                                <input type="text" form="UpdatePostForm" class="form-control @error('title') is-invalid @enderror" value="{{ old('title',$post->title) }}" name="title">
                                @error('title')
                                <p class="text-danger small">{{ $message }}</p>
                                @enderror
                            </div>

                        {{--image delete--}}
                        @foreach($post->photos as $photo)

                            <form action="{{ url('photo/'.$photo->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('delete')
                                <div class="d-inline-flex">
                                    <img src="{{ asset('storage/thumbnail/'.$photo->name) }}" class="editImg" alt="">
                                    <button class="btn btn-danger btn-sm position-absolute bottom-2" >
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </form>

                        @endforeach
                        {{--image delete--}}

                        {{--image upload--}}
{{--                            <form action="{{ route('photo.store') }}" method="POST" id="photoUploadForm" enctype="multipart/form-data">--}}
{{--                                @csrf--}}

{{--                                <button class="btn btn-primary" id="imageUploadUi">upload</button>--}}

{{--                                <input type="file" name="photo[]" value="{{ old('photo') }}" class="form-control d-none @error('photo') is-invalid @enderror" id="ImageUploadBtn" multiple >--}}

{{--                                <input type="hidden" name="post_id" value="{{ $post->id }}">--}}

{{--                            </form>--}}
                        <form action="{{ route('photo.store') }}" method="post" class="d-none" id="photoUploadForm" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <div class="mb-3">
                                <label class="form-label">Photo</label>
                                <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photoInput" value="{{ old('photo') }}" name="photo[]" multiple>
                                @error('photo')
                                <p class="text-danger small">{{ $message }}</p>
                                @enderror
                            </div>
                        </form>

                        <div class="border border-2 border-dark  rounded-3 me-1 uploader-ui d-flex justify-content-center align-items-center px-3" id="photoUploadUi">
                            <i class="fas fa-plus fa-2x"></i>
                        </div>
                        {{--image upload--}}

                            <div class="mb-3">
                                <label class="form-label">Select Category</label>
                                <select form="UpdatePostForm" class="form-select @error('category') is-invalid @enderror" name="category_id">
                                    @foreach(\App\Models\category::all() as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == old('category',$post->category_id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                <p class="text-danger small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea form="UpdatePostForm" type="text" rows="10" class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description',$post->description) }}</textarea>
                                @error('description')
                                <p class="text-danger small">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" required>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Confirm</label>
                                </div>
                                <button class="btn btn-lg btn-primary" form="UpdatePostForm">Update Post</button>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        let photoUploadForm = document.getElementById('photoUploadForm');
        let photoInput = document.getElementById('photoInput');
        let photoUploadUi = document.getElementById('photoUploadUi');

        photoUploadUi.addEventListener('click',function (){
            photoInput.click();
        })
        photoInput.addEventListener('change',function (){
            photoUploadForm.submit();
        })

    </script>


@endsection
