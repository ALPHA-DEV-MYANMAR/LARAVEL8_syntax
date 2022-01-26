@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            Create Category
                            <a href="{{ route('category.index') }}" class="btn btn-primary">
                                All Categories
                            </a>
                        </div>
                    </div>
                    <div class="card-body">

                        <div>
                            <form action="{{ route('category.store') }}" method="post" class="w-50 mx-auto">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                    <button class="btn btn-primary">Add</button>
                                </div>
                            </form>
                            @error('name')
                            <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <table class="table align-middle">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
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
                                    <tr class="text-center">
                                        <td colspan="5">There is no data!</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
