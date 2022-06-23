<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>
            @yield('title')
        </title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ url('css/styles.css') }}">
        {{-- <link rel="stylesheet" href="{{ url('css/main.css') }}"> --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.10.0.min.js"></script>
        <script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>
        <!-- datatable-->
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" type="text/javascript"></script>

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        {{-- <script src="{{asset('js/menu.js')}}"></script> --}}
    </head>
    <body class="font-sans antialiased">

        <div class="min-h-screen bg-gray-100">


            <!-- Page Heading -->


            <!-- Page Content -->
            <main>
                
                <nav class="navbar navbar-expand-lg navbar-light bg-light p-1">
                    <a class="navbar-brand" href="{{asset('/')}}"><img src="{{asset('siteico.png')}}" alt="" width="50%"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item mr-2 active">
                        <a class="nav-link" href="{{asset('/')}}">Trang chủ<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{asset('workers ')}}">Danh Sách THỢ <span class="sr-only">(current)</span></a>
                            
                        </li>
                    </ul>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="nav-item" style="color: green" href="{{ route('logout') }}" onclick="event.preventDefault();
                            this.closest('form').submit();">
                            <img src="{{url('icon/box-arrow-right.svg')}}" alt="" srcset="" width="30px">
                        </a>
                    </form>
                </nav>
{{-- end menu --}}

                @yield('content')

            </main>
        </div>
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js" ></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
        <script>
            $('h6.alert').not('.alert-important').delay(3000).slideUp(300);
        </script>
    </body>
</html>
