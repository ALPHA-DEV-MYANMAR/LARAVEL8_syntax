@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            Tag Lists
                            <a href="{{ route('tag.create') }}" class="btn btn-primary">Tag Create</a>
                        </div>
                    </div>
                    <div class="card-body">
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
                            {{ $tags->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
