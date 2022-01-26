@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            Tag Lists
                            <a href="{{ route('tag.index') }}" class="btn btn-primary">All Tags</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tag.store') }}" method="POST">
                            @csrf

                            <div class="input-group mb-3  w-50 mx-auto">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                                <button class="btn btn-primary" type="submit">Add Tag</button>
                            </div>

                            <div>
                                @error('title')
                                <p class="text-danger small">{{ $message }}</p>
                                @enderror
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

                        </form>
                        <div>
                            <table class="table table-hover table-bordered align-middle">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Owner</th>
                                    <th scope="col">Handle</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($tags as $tag)
                                    <tr>
                                        <th scope="col">{{ $tag->id }}</th>
                                        <td>{{ $tag->name }}</td>
                                        <td>{{ $tag->user->name }}</td>
                                        <td>
                                            <form action="{{ route('tag.destroy',$tag->id) }}" class="d-inline-block" method="Post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-outline-primary btn-sm" type="submit">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @empty

                                    <tr>
                                        <td colspan="4" class="text-center">There is now tags</td>
                                    </tr>

                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer ">

                        <div class="text-center">
                            <a href="{{ route('tag.index') }}" class="btn btn-primary">
                                Show all tags
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
