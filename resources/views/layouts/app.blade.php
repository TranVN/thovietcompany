<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>

        @yield('title')
    </title>
    <link rel="icon" href="{{ URL::asset('siteico.png') }}" type="image/x-icon"/>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ url('css/styles.css') }}">
    <link rel="stylesheet" href="{{ url('css/main.css') }}">
    <link rel="stylesheet" href="{{ url('css/chat.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.10.0.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>
    <!-- datatable-->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" type="text/javascript"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ asset('js/menu.js') }}"></script>
    <!-- firebase integration started -->

    <script src="https://www.gstatic.com/firebasejs/8.1.0/firebase.js"></script>
    <!-- Firebase App is always required and must be first -->
    <script src="https://www.gstatic.com/firebasejs/8.1.0/firebase-app.js"></script>

    <!-- Add additional services that you want to use -->
    <script src="https://www.gstatic.com/firebasejs/8.1.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.1.0/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.1.0/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.1.0/firebase-messaging.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.1.0/firebase-functions.js"></script>


    <!-- firebase integration end -->
    {{-- Chat Axios --}}
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
</head>

<body class="font-sans antialiased" id="site-body">
    <x-jet-banner />

    <div class="min-h-screen bg-gray-100">
        <div class="main-body">
            @include('layouts.navigation-menu')


            <!-- Page Content -->
            <main>
                {{ $slot }}
                @yield('content')
            </main>
           
            @include('layouts.footer')

        </div>
    </div>

    @stack('modals')
    
    <script>
        $('h6.alert').not('.alert-important').delay(3000).slideUp(300);
      function myFunction() {
      var x = document.getElementById("myDIV");
      if (x.style.display === "none") {
          x.style.display = "block";
      } else {
          x.style.display = "none";
      }
      }
    </script>
    <script type="text/javascript" src="{{ asset('js/noti_count.js') }}"></script>
    <script type="text/javascript" src="{{asset('js/firebase_tv.js')}}"></script>
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>
    @yield('scripts')

</body>



</html>
