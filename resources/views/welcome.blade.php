<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <link rel="shortcut icon" href="{{ asset('/images/logo.png') }}">

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 100%;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            #links{
                font-size: 100%;
                color: #38c172 !important;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <!-- <a href="{{ route('register') }}">Register</a> -->
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    <img src="/images/logo.png" width="20%">
                   
                </div>

                <div class="title m-b-md">
                    
                 <strong>  {{ config('app.name') }} | {{date('Y')}} ELECTIONS </strong>
                </div>


                <div id="links">
                    <span></span>
                </div>

                <br>
                <div id="more_links">

                     @guest
                           
                        <a class="btn btn-primary" href="{{ route('login') }}">{{ __('Login to vote') }}</a>                                                   
                        @else

                        <a class="btn btn-primary" href="/home">{{ __('Vote now') }}</a>

                    @endguest


                     
                </div>

                <center>
                    <p>Developed by <a href="https://schooltool.lesson.co.ug/">Mpabaisi Technologies</a></p>
                </center>


            </div>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>

        <script type="text/javascript">
        function myFunction () {

             $.ajax({
                    type: "GET",
                    url: "/vote_time",
                data: {
                    
                },
                success: function(result){

                    $("#links").text(result);

                }

              })
            
        }

        setInterval(function () { myFunction(); }, 4000);
        </script>
    </body>
</html>
