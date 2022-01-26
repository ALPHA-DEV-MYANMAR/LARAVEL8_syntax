@extends('layouts.app')
@section('content')


    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                       My Photos
                    </div>
                    <div class="card-body">
                        @forelse($photos as $photo)
                            <img src="{{ asset('storage/thumbnail/'.$photo->name) }}" class="my-photo " width="200" alt="">
                        @empty
                            <p>There was no photo</p>
                        @endforelse
                    </div>

                </div>

            </div>
        </div>
    </div>


@endsection
