@extends('layouts.app')
@section('content')


    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Edit Users
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.update',$user->id) }}" id="UserUpdateForm" method="post" class="w-50 mx-auto">
                            @csrf
                            @method('put')

                            <div class="mt-3">
                                <label for="">Edit Name</label>
                                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username',$user->name) }}">
                                @error('username')
                                <p class='text-danger'>{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mt-3">
                                <label for="">Edit Email</label>
                                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email',$user->email) }}">
                                @error('email')
                                <p class='text-danger'>{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mt-3">
                                @foreach(\App\Models\Role::all() as $role)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="name[]" value="{{ $role->id }}" id="{{ old($role->id) }}"
                                        @foreach($user->roles as $userRole)
                                            @if($userRole->name == $role->name)
                                                checked
                                            @endif
                                        @endforeach
                                        >
                                        <label class="form-check-label" for="{{ old($role->id) }}">
                                            {{ $role->name }}
                                        </label>
                                    </div>
                                @endforeach
                                    @error('name')
                                    <p class='text-danger'>{{ $message }}</p>
                                    @enderror
                            </div>

                        </form>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" form="UserUpdateForm" required>
                                <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch checkbox input</label>
                            </div>
                            <div>
                                <button class="btn btn-primary" form="UserUpdateForm">Update User</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection
