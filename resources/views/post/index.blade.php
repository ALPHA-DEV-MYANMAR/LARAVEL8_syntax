@extends('layouts.app')
@section('content')

    <div class="container">
        <div class='row'>
            <div class="col-12">
                @isset(request()->search)

                search by :: {{ request()->search }}

                <a href="{{ route('post.index') }}" class='btn btn-outline-primary'>show all</a>

                @endisset
            </div>
        </div>
        <div class="row">
            <div class="col-12 mx-auto">

                <div class="d-flex justify-content-between">
                    <h3>Post lists</h3>
                    <a href="{{ route('post.create') }}" class="btn btn-outline-primary">create</a>
                </div>


                <div class="input-group mb-3 mt-2">

                    <form  method='get' class='d-flex'>

                        <input type="text" class="form-control" name='search' value="{{ request('search') }}" placeholder="search something..." >
                        <button class="btn btn-primary" type="submit">
                            <i class='fas fa-search'></i>
                        </button>

                    </form>

                </div>

                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>title</th>
                            <th>photos</th>
                            <th>description</th>
                            <th>owner</th>
                            <th>category</th>
                            <th>control</th>
                            <th>publish</th>
                            <th>time</th>
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
                                <td>{{ $post->user->name }}</td>
                                <td>{{ $post->category->name }}</td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">


                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <Button class="btn btn-outline-info btn-sm">
                                                <a href="{{ route('post.show',$post->id) }}" >
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
                                            </Button>

                                            <button class='btn btn-outline-primary btn-sm'>
                                                <a href="{{ route('post.edit',$post->id) }}" >
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </button>

                                            <button class='btn btn-outline-primary btn-sm' form='deleteForm' >
                                                <i class="fas fa-trash"></i>
                                            </button>

                                        </div>

                                        <form action="{{ route('post.destroy',$post) }}" id='deleteForm' method="post">
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
                                <td colspan="9" class="text-center">There is no data!</td>
                            </tr>

                        @endforelse

                    </tbody>
                </table>

                {{ $posts->links() }}

            </div>
        </div>
    </div>

@endsection
