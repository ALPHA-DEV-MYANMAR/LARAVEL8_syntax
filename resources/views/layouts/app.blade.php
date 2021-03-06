<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Blog') }}</title>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('post.index') }}">
                    Blog
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @auth
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a href="{{ route('post.index') }}" class="nav-link {{ route('post.index') == request()->url() ? 'active' : ''}}">Posts</a>
                        </li>
                        @can('create',\App\Models\Post::class)
                            <li class="nav-item">
                                <a href="{{ route('post.create') }}" class="nav-link {{ route('post.create') == request()->url() ? 'active' : ''}}">Create Post</a>
                            </li>
                        @endcan

                        @foreach(auth()->user()->roles as $role)
                            @if($role->name === 'admin')
                                <li class="nav-item">
                                    <a href="{{ route('user.index') }}" class="nav-link {{ route('user.index') == request()->url() ? 'active' : '' }}">Users</a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('category.index') }}" class="nav-link {{ route('category.index') == request()->url() ? 'active' : '' }}">Category</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('category.create') }}" class="nav-link {{ route('category.create') == request()->url() ? 'active' : ''}}">Create Category</a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('tag.index') }}" class="nav-link {{ route('tag.index') == request()->url() ? 'active' : ''}}">Tags</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('tag.create') }}" class="nav-link {{ route('tag.create') == request()->url() ? 'active' : ''}}">Tag Create</a>
                                </li>
                            @endif
                        @endforeach

                        <li class="nav-item">
                            <a href="{{ route('photo.index') }}" class="nav-link {{ route('photo.index') == request()->url() ? 'active' : ''}}">My Photos</a>
                        </li>
                    </ul>
                    @endauth


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
{{--            @if(session('status'))--}}
{{--                <div class="alert alert-success">--}}
{{--                    {{ session('status')}}--}}
{{--                </div>--}}
{{--            @endif--}}
            @yield('content')
        </main>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @if(session('status'))
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'bottom-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                Toast.fire({
                    icon: 'success',
                    title: '{{ session('status') }}'
                })
            </script>
        @endif

        <script>
            new VenoBox({
                selector: '.venobox'
            });
        </script>
    </div>
</body>
</html>
