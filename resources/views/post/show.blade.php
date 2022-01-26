@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        My Account
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <div class="h5 fw-bolder mt-2">
                                Name ~ {{ $post->user->name }}
                            </div>
                            <div class="h5 fw-bolder mt-2">
                                Email ~ {{ $post->user->email }}
                            </div>
                            <div class="h5 fw-bolder mt-2">
                                Permission ~ {{ $post->user->role }}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection
