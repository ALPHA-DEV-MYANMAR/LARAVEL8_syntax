@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-4 mx-auto">
                <form action="{{ route('category.update',$category->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="d-flex">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',$category->name) }}">
                        <button class="btn btn-primary">update</button>
                    </div>
                </form>
                @error('name')
                <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

@endsection
