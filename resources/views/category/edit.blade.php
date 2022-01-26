@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            Edit Category
                            <a href="{{ route('category.index') }}" class="btn btn-primary">
                                All Categories
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('category.update',$category->id) }}" class="w-50 mx-auto" method="post">
                            @csrf
                            @method('put')
                            <div class="d-flex">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',$category->name) }}">
                                <button class="btn btn-primary">Update</button>
                            </div>
                        </form>
                        @error('name')
                        <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
    </div>

@endsection
