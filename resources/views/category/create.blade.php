@extends('layouts.app')
@section('content')

    <div class="container">

        <div class="row">
            <div class="col-4 mx-auto">
                <form action="{{ route('category.store') }}" method="post">
                    @csrf

                    <div class="d-flex">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        <button class="btn btn-primary">add</button>
                    </div>
                </form>
                @error('name')
                <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>
        </div>


        <div class="row">

            <div class="col-8 mx-auto">
                <table class="table table-hover table-bordered align-middle">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>control</th>
                        <th>time</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse( $categories as $category )

                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>

                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="{{ route('category.edit',$category->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('category.destroy',$category->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
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

@endsection
