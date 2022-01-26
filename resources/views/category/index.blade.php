@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            Category Lists
                            <a href="{{ route('category.create') }}" class="btn btn-primary">
                                Create Category
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table  align-middle">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Photos</th>
                                <th>Handle</th>
                                <th>Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse( $categories as $category )
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        @forelse($category->photos()->latest("id")->limit(3)->get() as $photo)
                                            <img src="{{ asset('storage/thumbnail/'.$photo->name) }}" width='40' class='rounded-circle thumbnail-img border border-2 border-white shadow-sm list-thumbnail' alt="">
                                        @empty
                                            <p>No Photos</p>
                                        @endforelse
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button class='btn btn-outline-primary btn-sm'>
                                                    <a href="{{ route('category.edit',$category->id) }}" >
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </button>
                                                <button class='btn btn-outline-primary btn-sm' form='deleteForm' >
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                            <form action="{{ route('category.destroy',$category) }}" id='deleteForm' method="post">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </div>
                                    </td>
                                    <td>
                                        <i class="fas fa-calendar"></i>
                                        {{ $category->created_at->format('Y-m-d') }}
                                        <br>
                                        <i class="fas fa-clock"></i>
                                        {{ $category->created_at->diffForHumans() }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">There is no data!</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{ $categories->links() }}
                    </div>
                    <div class="card-footer">
                        {{ $categories->count() }} found for category
                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection
