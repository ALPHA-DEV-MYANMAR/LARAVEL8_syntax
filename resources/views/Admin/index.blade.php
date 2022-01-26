@extends('layouts.app')
@section('content')


    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            User Lists
                            <a href="{{ route('post.index') }}" class="btn btn-primary">All Post</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Permission</th>
                                <th scope="col">Handle</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <th scope="row">{{ $user->id }}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @forelse($user->roles as $role)
                                                <span class="badge bg-primary">{{ $role->name }}</span>
                                            @empty
                                                No Permissions
                                            @endforelse
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button class='btn btn-outline-primary btn-sm'>
                                                        <a href="{{ route('user.edit',$user->id) }}" >
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </button>
                                                    <button class='btn btn-outline-primary btn-sm' form='deleteForm' >
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                                <form action="{{ route('user.destroy',$user) }}" id='deleteForm' method="post">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">There is no user</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{ $users->links() }}

                    </div>
                    <div class="card-footer">
                        {{ \App\Models\User::all()->count() }} found for users
                    </div>

                </div>

            </div>
        </div>
    </div>


@endsection
