<!doctype html>
<html class="no-js" lang="{{ app()->getLocale() }}">
   <head>
        <link rel="apple-touch-icon" sizes="76x76" href="{{asset('img/favicon.png')}}">
        <link rel="icon" type="image/png" href="{{asset('img/favicon.png')}}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>@yield('title') | {{ config('app.name') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="{{ setting('meta_description') }}">
        <meta name="keyword" content="{{ setting('meta_keyword') }}">

        @include('frontend.includes.meta')

        <!-- Shortcut Icon -->
        <link rel="shortcut icon" href="{{asset('img/favicon.png')}}">
        <link rel="icon" type="image/ico" href="{{asset('img/favicon.png')}}" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- CSS here -->
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/meanmenu.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/owl-carousel.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/swiper-bundle.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/backtotop.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/nice-select.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/flaticon.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/notosans.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/font-awesome-pro.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/spacing.css') }}">
        <link href="{{ asset('assets/backend/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">

        <!-- @vite(['resources/css/app-frontend.css'])
        @vite(['resources/js/app-frontend.js']) -->

        @stack('styles')

        <x-google-analytics />
   </head>
   <body>
      <!--[if lte IE 9]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
      <![endif]-->


      <!-- Preloader -->
      <div class="preloader"></div>
      <!-- pre loader area end -->

      <!-- back to top start -->
      <div class="progress-wrap">
         <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
         </svg>
      </div>
      <!-- back to top end -->
      
      <!-- header-area-start -->
      <header id="header-sticky" class="header-area">
         <div class="container">
               <div class="row align-items-center">
                  <div class="col-xl-2 col-lg-2 col-md-6 col-6">
                     <div class="logo-area">
                           <div class="logo">
                                <a href="{{ route('frontend.index') }}">
                                    <img src="{{ asset('assets/frontend/img/logo/logo-white.png') }}" alt="Likhun" width="120">
                                </a>
                           </div>
                     </div>
                  </div>
                  <div class="col-xl-7 col-lg-6 col-md-6 col-6">
                     <div class="menu-area menu-padding text-center">
                           <div class="main-menu">
                              <nav id="mobile-menu">
                                 <ul>
                                    <li><a href="{{ route('frontend.home') }}">হোম</a></li>
                                    <li><a href="services.html">আমাদের সম্পর্কে</a></li>
                                    <li><a href="about.html">জিজ্ঞাসা</a></li>
                                    <li><a href="blog.html">নির্দেশনা</a></li>
                                    <li><a href="contact.html">যোগাযোগ</a></li>
                                 </ul>
                              </nav>
                           </div>
                     </div>
                     <div class="side-menu-icon d-lg-none text-end">
                        <a href="javascript:void(0)" class="info-toggle-btn f-right sidebar-toggle-btn"><i class="fal fa-bars"></i></a>
                     </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 d-none d-lg-block">
                     <div class="header-info f-right">
                        <div class="header__top-right">
                           <div class="header__lang">
                              <select>
                                 <option>English</option>
                                 <option>বাংলা</option>
                              </select><div class="nice-select" tabindex="0"><span class="current">বাংলা</span><ul class="list"><li data-value="English" class="option">English</li><li data-value="Bangla" class="option selected focus">বাংলা</li></ul></div>
                           </div>
                           <div class="header__sm-links">
                           @guest
                              <a href="{{ route('login') }}" class="login-btn-sm">লগইন</a>
                           @endguest
                           @auth
                           <div class="login-btn-sm">
                              <a href="{{ route('dashboard') }}" title="Notification">
                                 <i class="fal fa-bell"></i>
                              </a>
                              <a href="{{ route('dashboard') }}" title="Dashboard">
                                 <i class="fal fa-user"></i>
                              </a>
                           </div>
                           @endauth
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
         </div>
      </header>
      <!-- header-area-end -->

 
      <main>
        <!-- Main Content Start -->
         @yield('content')
        <!-- Main Content End -->
     </main>

      <!-- footer start -->
      <footer>
         <div class="footer">
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-lg-6 col-md-6 col-sm-12">
                     <div class="footer-logo">
                        <a href="index.html"><img src="{{ asset('assets/frontend/img/logo/logo-white.png') }}" alt="Likhun" width="120"></a>
                     </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12">
                     <div class="footer-link">
                        <div class="footer-social">
                           <ul class="list-unstyled">
                              <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                              <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                              <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                              <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="footer-bottom col-lg-12">
                     <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                           <div class="footer-bottom-left">
                              <p>© 2021 <a href="#">লিখুন</a> সম্পূর্ণ সম্পদের সংরক্ষণ সহিত সর্বস্বত্ব সংরক্ষিত।</p>
                           </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                           <div class="footer-bottom-right">
                              <ul class="list-unstyled">
                                 <li><a href="#">প্রাইভেসি পলিসি</a></li>
                                 <li><a href="#">শর্তাবলী</a></li>
                                 <li><a href="#">সাইটম্যাপ</a></li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <!-- footer end -->

      <!-- JS here -->
      <script src="{{ asset('assets/frontend/js/vendor/jquery.js') }}"></script>
      <script src="{{ asset('assets/frontend/js/vendor/waypoints.js') }}"></script>
      <script src="{{ asset('assets/frontend/js/bootstrap-bundle.js') }}"></script>
      <script src="{{ asset('assets/frontend/js/meanmenu.js') }}"></script>
      <script src="{{ asset('assets/frontend/js/swiper-bundle.js') }}"></script>
      <script src="{{ asset('assets/frontend/js/owl-carousel.js') }}"></script>
      <script src="{{ asset('assets/frontend/js/magnific-popup.js') }}"></script>
      <script src="{{ asset('assets/frontend/js/parallax.js') }}"></script>
      <script src="{{ asset('assets/frontend/js/backtotop.js') }}"></script>
      <script src="{{ asset('assets/frontend/js/nice-select.js') }}"></script>
      <script src="{{ asset('assets/frontend/js/counterup.js') }}"></script>
      <script src="{{ asset('assets/frontend/js/wow.js') }}"></script>
      <script src="{{ asset('assets/frontend/js/isotope-pkgd.js') }}"></script>
      <script src="{{ asset('assets/frontend/js/imagesloaded-pkgd.js') }}"></script>
      <script src="{{ asset('assets/frontend/js/ajax-form.js') }}"></script>
      <script src="{{ asset('assets/frontend/js/jquery.appear.js') }}"></script>
      <script src="{{ asset('assets/frontend/js/jquery.knob.js') }}"></script>
      <script src="{{ asset('assets/backend/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
      <script src="{{ asset('assets/frontend/js/main.js') }}"></script>
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
      @stack('scripts')
   </body>
</html>