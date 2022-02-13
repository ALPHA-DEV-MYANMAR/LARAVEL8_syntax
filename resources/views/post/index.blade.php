@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                            Post Lists
                            @isset(request()->search)
{{--                             show search name--}}
{{--                            {{ request()->search }}--}}
                            <a href="{{ route('post.index') }}" class='btn btn-primary btn-sm rounded-circle'>all</a>
                            @endisset
                            </div>
                            <div>
                                <form  method='get' class='d-flex'>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name='search' value="{{ request('search') }}" placeholder="search">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div>
                                @can('create',\App\Models\Post::class)
                                <a href="{{ route('post.create') }}" class="btn btn-primary ">Create Post</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table align-middle">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Photos</th>
                                <th>Description</th>
                                <th>Tags</th>
                                <th>Owner</th>
                                <th>Category</th>
                                <th>Control</th>
                                <th>Publish</th>
                                <th>Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse( $posts as $post )
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ Str::limit($post->title,20)  }}</td>
                                    <td>
                                        @forelse($post->photos()->latest('id')->limit(3)->get() as $photo)
                                            <a class="venobox" data-gall="img{{ $post->id }}" href="{{ asset('storage/photos/'.$photo->name) }}">
                                                <img src="{{ asset('storage/thumbnail/'.$photo->name) }}" class="rounded-circle thumbnail-img border border-2 border-white shadow-sm list-thumbnail" height="40" alt="image alt"/>
                                            </a>
                                        @empty
                                            <p class="text-muted">No Photo</p>
                                        @endforelse
                                    </td>
                                    <td>{{ Str::limit($post->excerpt,20) }}</td>
                                    <td>
                                        @forelse($post->tags as $tag)
                                            <span class="badge bg-primary small">
                                                <i class="fas fa-hashtag"></i>
                                                {{ $tag->name }}
                                        </span>
                                        @empty
                                            There is no tags
                                        @endforelse
                                    </td>
                                    <td>{{ $post->user->name }}</td>
                                    <td>{{ $post->category->name ?? 'No Category' }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center">

                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <Button class="btn btn-outline-primary btn-sm">
                                                    <a href="{{ route('post.show',$post->id) }}" >
                                                        <i class="fas fa-info-circle"></i>
                                                    </a>
                                                </Button>

                                                @can('update',$post)
                                                    <button class='btn btn-outline-primary btn-sm'>
                                                        <a href="{{ route('post.edit',$post->id) }}" >
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </button>
                                                @endcan

                                                @can('delete',$post)
                                                    <button class='btn btn-outline-primary btn-sm' form='deleteForm{{ $post->id }}' >
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                @endcan

                                            </div>
                                            <form action="{{ route('post.destroy',$post) }}" id='deleteForm{{  $post->id  }}' method="post">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch"  {{ $post->is_publish ? 'checked' : 'disabled' }} >
                                        </div>
                                    </td>
                                    <td>
                                        <i class="fas fa-calendar"></i>
                                        {{ $post->created_at->format('Y-m-d') }}
                                        <br>
                                        <i class="fas fa-clock"></i>
                                        {{ $post->created_at->diffForHumans() }}
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">There is no data!</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                        {{ $posts->links() }}
                    </div>
                    <div class="card-footer">
                        {{ \App\Models\Post::all()->count()}} found for posts
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
