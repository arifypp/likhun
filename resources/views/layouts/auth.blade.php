<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="{{asset('img/favicon.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('img/favicon.png')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ setting('meta_description') }}">
    <meta name="keyword" content="{{ setting('meta_keyword') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')  - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    @stack('before-styles')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/notosans.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/font-awesome-pro.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/spacing.css') }}">
    <link href="{{ asset('assets/backend/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">
    @stack('after-styles')

    <!-- Analytics -->
    <x-google-analytics config="{{ setting('google_analytics') }}" />
</head>

<body>
      <!-- Preloader -->
      <div class="preloader"></div>
      <!-- pre loader area end -->
      
      <main>
        @yield('content')
      </main>

    <!-- Scripts -->
    <script type="module" src="{{ asset('js/app.js') }}" defer></script>
    <!-- JS here -->
    <script src="{{ asset('assets/frontend/js/vendor/jquery.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/vendor/waypoints.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/bootstrap-bundle.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/parallax.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/nice-select.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/wow.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/main.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('button[type="submit"]').click(function() {
                $(this).prop('disabled', true);
                $(this).html('<i class="fa fa-spinner fa-spin"></i> Please wait');
                $(this).parents('form').submit();
            });
        });
    </script>
    <script>
         $(function(){
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            })

            //Success Message 
            @if(Session::has('success'))
            Toast.fire({
               icon: 'success',
               title: '{{ Session::get("success") }}',
            })
            @endif

            // Error Message
            @if(Session::has('error'))
            Toast.fire({
               icon: 'error',
               title: '{{ Session::get("error") }}',
            })
            @endif

         });
    </script>
</body>

</html>