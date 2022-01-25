@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">

                <x-alert type="primary" message="Aung Paing Soe lay"/>

{{--                {{ dd(config('my.gf')) }}--}}

                {{ $cat }}

                <br>

                @aps

            </div>
        </div>
    </div>
@endsection
