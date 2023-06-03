<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ language_direction() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="{{asset('img/favicon.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('img/favicon.png')}}">
    <meta name="keyword" content="{{ setting('meta_keyword') }}">
    <meta name="description" content="{{ setting('meta_description') }}">  
    <!-- Shortcut Icon -->
    <link rel="shortcut icon" href="{{asset('img/favicon.png')}}">
    <link rel="icon" type="image/ico" href="{{asset('img/favicon.png')}}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name') }}</title>

    <!-- plugin css -->
    <link href="{{ asset('assets/backend/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/plugins/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/plugins/prismjs/prism.css') }}" rel="stylesheet" />
    <!-- end plugin css -->

  @stack('plugin-styles')
  <link href="{{ asset('assets/backend/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/backend/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
  <!-- common css -->
  <link href="{{ asset('assets/backend/app.css') }}" rel="stylesheet" />
  <!-- end common css -->

  @stack('style')
</head>
<body data-base-url="{{url('/')}}">

  <script src="{{ asset('assets/backend/js/spinner.js') }}"></script>

  <div class="main-wrapper" id="app">
    @include('backend.layouts.sidebar')
    <div class="page-wrapper">
      @include('backend.layouts.header')
      <div class="page-content">
        <div class="container-fluid">
            
          @include('flash::message')

          @include('backend.includes.errors')

          <!-- Main content block -->
          @yield('content')
          <!-- / Main content block -->
        </div>
      </div>
      @include('backend.layouts.footer')
    </div>
  </div>

    <!-- base js -->
    <script src="{{ asset('assets/backend/app.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- end base js -->

    <!-- plugin js -->
    @stack('plugin-scripts')
    <!-- end plugin js -->
    <script src="{{ asset('assets/backend/plugins/prismjs/prism.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/chartjs/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/progressbar-js/progressbar.min.js') }}"></script>
    <!-- common js -->
    <script src="{{ asset('assets/backend/js/template.js') }}"></script>
    <!-- end common js -->
    @stack('custom-scripts')
    <script src="{{ asset('assets/backend/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datepicker.js') }}"></script>
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