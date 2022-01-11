@extends('layouts.app')

@section('content')

    <div class="contaier">
        <div class="row">
            <div class="col-12 col-lg-8 mx-auto">

                <div class="card">

                    <div class="card-header justify-content-between d-flex align-items-center">
                        <div class='h5 mb-0'>
                            Post Created
                        </div>
                    </div>

                    <div class="card-body">
                       <form action="{{ route('post.store') }}" method='post' enctype="multipart/form-data">
                           @csrf
                           <div class="m-2 w-50">
                               <input type="text" class='form-control  @error('title') is-invalid  @enderror' name="title" placeholder='enter title' value={{ old('title') }} >
                           </div>

                           @error('title')

                            <p class='text-danger'>{{ $message }}</p>

                           @enderror

                           <div class="m-2 w-50">
                               <input type="file" name='photo[]' value="{{ old('photo') }}" class="form-control @error('photo') is-invalid @enderror" multiple>
                           </div>

                           @error('photo')

                           <p class='text-danger'>{{ $message }}</p>

                           @enderror

                           <div class="m-2 w-50">
                                <textarea  id="" cols="30" rows="5" name='description' class='form-control @error('description') is-invalid  @enderror' placeholder='enter description'>{{ old('description') }}</textarea>
                           </div>

                           @error('description')

                           <p class='text-danger'>{{ $message }}</p>

                          @enderror

                           <div class="m-2 w-50">
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


                           <div class="class m-2 w-50">

                                <div class='d-flex justify-content-between align-items-center'>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" required>
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Confirm</label>
                                    </div>
                                    <div class="div">
                                        <Button class='btn btn-primary'>Post</Button>
                                    </div>
                                </div>

                           </div>

                       </form>
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
