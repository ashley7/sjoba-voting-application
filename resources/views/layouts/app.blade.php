<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>    

    <link rel="shortcut icon" href="{{ asset('/images/logo.png') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

    @yield('styles')
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                        @if(!Auth::guest())

                           

                          @if(Auth::user()->user_type == "admin")

                           <li class="nav-item dropdown">

                                <a id="navbarDropdown" class="nav-link" href="/home">
                                   Home
                                </a>

                            </li>

                           <li class="nav-item dropdown">

                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   Voters
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    
                                 
                                    <a class="dropdown-item" href="{{ route('voters.create') }}">
                                        {{ __('Create a voter') }}
                                    </a>
                                   

                                    <a class="dropdown-item" href="{{ route('voters.index') }}">
                                        {{ __('View voters register') }}
                                    </a>

                                    <a class="dropdown-item" href="/voters_that_voted">
                                        {{ __('Voters that voted') }}
                                    </a>

                                    
                                </div>
                            </li>

                            @endif

                            @if(Auth::user()->user_type == "admin")

                            <li class="nav-item dropdown">

                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   Candidates
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    
                                  
                                    <a class="dropdown-item" href="{{ route('candidate_category.create') }}">
                                        {{ __('Create a Position') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('candidate.create') }}">
                                        {{ __('Create a candidate') }}
                                    </a>
                                    <hr>

                                    <a class="dropdown-item" href="{{ route('candidate_category.index') }}">
                                        {{ __('View position') }}
                                    </a>                                  

                                    <a class="dropdown-item" href="{{ route('candidate.index') }}">
                                        {{ __('View Candidates') }}
                                    </a>                                  
                                    
                                </div>
                            </li>

                            @endif


                            <li class="nav-item dropdown">

                                <a id="navbarDropdown" class="nav-link" href="/bullot_paper">
                                   Bullot paper
                                </a>

                            </li>

                            @if(Auth::user()->user_type == "admin")

                            <li class="nav-item dropdown">

                                <a id="navbarDropdown" class="nav-link" href="{{  route('vote_control.index') }}">
                                   Voting time
                                </a>

                            </li>

                            @endif


                        @endif

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <!-- <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li> -->
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} ({{ Auth::user()->user_type }})
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

            @if (session('bad'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
               {{ session('bad') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
               
            @endif

            @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
               {{ session('status') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
               
            @endif

            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
                 
            @endif
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>

    <script type="text/javascript" src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );

        
    </script>

    @stack('scripts')
</body>
</html>
