@extends('layouts.app')
@section('content')


    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="card">

                    <div class="card-header">
                        {{ $post->title }}
                    </div>
                    <div class="card-body">

                        <div class="">
                            User Name is - {{ $post->user->name }} <br>
                            Email is - {{ $post->user->email }}
                        </div>

                        <div>
                            Category is - {{ $post->category->name }}
                        </div>

                        <p>
                            {{ $post->description }}
                        </p>

                        @foreach($post->photos as $photo)
                            <img src="{{ asset('storage/thumbnail/'.$photo->name) }}" alt="">
                        @endforeach



                        <hr>

                        <div class="">
                            <a href="{{ route('post.create') }}" class="btn btn-primary">
                                Create Post
                            </a>
                            <a href="{{ route('post.index') }}" class="btn btn-outline-primary">
                                All Post
                            </a>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>


@endsection
