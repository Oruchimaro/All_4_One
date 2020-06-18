<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        html {
            scroll-behavior: smooth;
        }

        .blog-main {
            background-color: #faf8f8 !important;
            width: 100%;
            height: 100%;
            margin-top: 8vh;
            display: flex;
        }

        .blog-nav {
            width: 100%;
            height: 8vh;
            background-color: #333;
            border-bottom: 4px #6b92ce solid;
            position: fixed;
            z-index: 2;
            display: flex;
            justify-content: space-between;
        }

        .blog-navigator {
            display: flex;
        }

        .blog-nav-item {
            list-style: none;
            margin: auto 30px;
        }

        .blog-nav-item a {
            text-decoration: none;
            color: #f3f3f3 !important;
            font-size: 1.2rem;
        }

        .blog-nav-item a:hover {
            text-decoration: underline;
            text-decoration-color: white;
            color: #6b92ce !important;
            font-size: 1.3rem;
        }

        .rtl {
            direction: rtl !important;
        }

        .blog-panel {
            width: 70%;
            height: 100%;
        }

        .blog-side {
            width: 30%;
            height: 100%;
            background: #f3f3f3;
        }

        .blog-card {
            width: 85%;
            height: 30.8vh;
            background-color: #f0f0f0c0;
            margin: 3px 30px 7px 30px;
            display: flex;
            cursor: pointer;
        }

        .blog-card img {
            height: 90%;
            width: 350px;
            margin: 8px 3px;
        }

        .blog-card-content {
            margin: 30px 15px;
        }

        .blog-card-content a {
            text-decoration: none;
        }

        .blog-card-title {
            color: #333;
            font-size: 2rem;
        }

        .blog-logo {
            color: #f7f7f8;
            font-size: 3rem;
        }

        .blog-auth {
            margin: 10px 30px;
            display: flex;
        }

        .blog-auth-item {
            color: white;
            margin: 0 10px;
            list-style: none;
        }

        .blog-auth-link {
            text-decoration: none !important;
            color: white !important;
            font-size: 1.1em;
        }

        .blog-post-show {
            display: flex;
            flex-direction: column;
        }

        .blog-post-show img {
            margin: 0 auto;
        }

        .blog-post-info {
            border: 2px solid #7e7d7d;
            padding: 5px;
            margin: 3px;
            border-radius: 5px;
            color: white;
            background: #333;
            margin-top: 10px;
        }

        .blog-post-show-content h3 {
            font-size: 3rem;
            margin: 20px auto;
        }

        .blog-post-show-content p {
            font-size: 1.3rem;
            margin: 20px auto;
            width: 80%;
            word-spacing: 7px;
        }

        .blog-post-show-content {
            margin: 20px auto;
            display: flex;
            flex-direction: column;
        }
    </style>
</head>

<body>
    <div id="app">
        <v-app>
            <div>
                <nav class="blog-nav">
                    <div class="blog-nav rtl">
                        <ul class="blog-navigator">
                            <li class="blog-nav-item"><a href="{{ route('blog.index') }}"> <i class="fa fa-home fa-2x"></i> </a></li>
                            <div class="dropdown">
                                <button class="btn text-white dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-2x fa-pencil-square-o"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <a href="{{ route('blog.create') }}" class="dropdown-item" type="button"> جدید </a>
                                    <a href="{{ route('blog.mine') }}" class="dropdown-item" type="button"> مقاله های من </a>
                                </div>
                            </div>

                            <div class="dropdown">
                                <button class="btn text-white dropdown-toggle" type="button" id="notifSel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bell-o fa-2x"></i></button>
                                <div class="dropdown-menu" aria-labelledby="notif">
                                    @auth
                                    @forelse (auth()->user()->getNotif('blog') as $notification )

                                    <a href="{{ $notification->data['path'] }}" class="dropdown-item" type="button">{{ $notification->data['message']}}</a> <a href="{{route('blog.notifs.read', $notification->id)}}" class="btn btn-sm btn-danger">read</a>
                                    @empty
                                    <h5>No Notifications for now !!!</h5>
                                    @endforelse
                                    <a href="{{route('blog.notifs.readAll', ['app'=> 'blog'])}}">Clear All</a>
                                    @endauth
                                </div>
                            </div>

                            <div class="dropdown">
                                <button class="btn text-white dropdown-toggle" type="button" id="catSel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-table fa-2x"></i> </button>
                                <div class="dropdown-menu" aria-labelledby="catSel">
                                    @foreach ($categories as $category)
                                    <a href="{{ route('blog.category.posts', $category) }}" class="dropdown-item" type="button">{{$category->name}}</a>
                                    @endforeach
                                </div>
                            </div>
                        </ul>

                        <h2 class="blog-logo"> بلاگ </h2>

                        <ul class="blog-auth">
                            @guest
                            <li class="blog-auth-item"><a href="{{ route('login') }}" class="blog-auth-link"> ورود </a></li>
                            @if (Route::has('register'))
                            <li class="blog-auth-item"><a href="{{ route('register') }}" class="blog-auth-link"> عضویت </a></li>
                            @endif
                            @else

                            <div class="dropdown">
                                <button class="btn text-white dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <a href="{{ route('home') }}" class="dropdown-item" type="button"> داشبورد </a>
                                    <div class="dropdown-divider"></div>
                                    <form action="{{ route('logout') }}" method="POST">
                                        <li class="blog-auth-item"><button class="dropdown-item" type="submit"> خروج </button></li>
                                        @csrf
                                    </form>
                                </div>
                            </div>

                            <li class="blog-auth-item"><a class="blog-auth-link"></a></li>


                            @endguest
                        </ul>
                    </div>
                </nav>

                <main class="py-4 blog-main">
                    @yield('content')
                </main>
            </div>
        </v-app>
    </div>
</body>

</html>
