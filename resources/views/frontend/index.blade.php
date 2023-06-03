@extends('frontend.layouts.layout')
@section('title', 'লিখুন')
@section('content')
      <!-- slider-area-start  -->
      <section class="slider-area fix">
         <div class="main-slider">
            <div class="swiper-wrapper p-relative">
               <div class="item-slider sliderm-height p-relative swiper-slide">
                  <div class="slide-bg" data-background="{{ asset('assets/frontend/img/slider/hero-bg.png') }}"></div>
                  <div class="container">
                     <div class="row ">
                        <div class="col-lg-12">
                           <div class="slider-contant mt-25">
                               <!-- <span data-animation="fadeInUp" data-delay=".3s">Industrial</span> -->
                               <h2 class="slider-title" data-animation="fadeInUp" data-delay=".3s">৫০২১+ গানের লিরিক্স ক্রয়ের জন্য প্রস্তুত</h2> 
                               <h4 class="slider-sub-title" data-animation="fadeInUp" data-delay=".3s">সকল বাংলা, হিন্দি ইংরেজি গানের কথা বা লিরিক্স পেতে আমাদের সাথে থাকুন। আমরা সকল ধরনের গানের লিরিক্স লেখার জন্য অর্ডার গ্রহন করে থাকি।</h4>
                               <div class="subscribe-form subscribe-form-2 p-relative mb-30 col-8 m-auto">
                                 <form action="#">
                                     <input type="email" placeholder="আপনার পছন্দের গানের নাম লিখুন...">
                                     <button type="submit" class="bg-dark">সার্চ করুন <i class="fal fa-long-arrow-right"></i></button>
                                 </form>
                             </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- slider-area-end -->

      <!-- Popular Artist Area -->
      <section class="popular-artist pt-100 pb-120">
         <div class="container">
            <div class="row">
               <div class="col-xl-12 col-lg-12">
                  <div class="popular-artist-wrapper">
                     <div class="section__wrapper mb-30 text-center">                           
                        <h5 class="section__title">জনপ্রিয় আর্টিস্ট সমূহ</h5>
                        <p class="section__desc">সকল বাংলা, হিন্দি ইংরেজি গানের কথা বা লিরিক্স পেতে আমাদের সাথে থাকুন।
                           আমরা সকল ধরনের গানের লিরিক্স লেখার জন্য অর্ডার গ্রহন করে থাকি।</p>
                     </div>
                     <div class="popular-list">
                        <ul class="likhun-box row list-unstyled">
                           <li class="likhun-inner-box col-lg-1 col-md-2 col-sm-3 col-6">
                              <a href="#">
                                 <image src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                                 <span class="artist-name">আশিক</span>
                              </a>
                           </li>
                           <li class="likhun-inner-box col-lg-1 col-md-2 col-sm-3 col-6">
                              <a href="#">
                                 <image src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                                 <span class="artist-name">আশিক</span>
                              </a>
                           </li>
                           <li class="likhun-inner-box col-lg-1 col-md-2 col-sm-3 col-6">
                              <a href="#">
                                 <image src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                                 <span class="artist-name">আশিক</span>
                              </a>
                           </li>
                           <li class="likhun-inner-box col-lg-1 col-md-2 col-sm-3 col-6">
                              <a href="#">
                                 <image src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                                 <span class="artist-name">আশিক</span>
                              </a>
                           </li>
                           <li class="likhun-inner-box col-lg-1 col-md-2 col-sm-3 col-6">
                              <a href="#">
                                 <image src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                                 <span class="artist-name">আশিক</span>
                              </a>
                           </li>
                           <li class="likhun-inner-box col-lg-1 col-md-2 col-sm-3 col-6">
                              <a href="#">
                                 <image src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                                 <span class="artist-name">আশিক</span>
                              </a>
                           </li>
                           <li class="likhun-inner-box col-lg-1 col-md-2 col-sm-3 col-6">
                              <a href="#">
                                 <image src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                                 <span class="artist-name">আশিক</span>
                              </a>
                           </li>
                           <li class="likhun-inner-box col-lg-1 col-md-2 col-sm-3 col-6">
                              <a href="#">
                                 <image src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                                 <span class="artist-name">আশিক</span>
                              </a>
                           </li>
                           <li class="likhun-inner-box col-lg-1 col-md-2 col-sm-3 col-6">
                              <a href="#">
                                 <image src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                                 <span class="artist-name">আশিক</span>
                              </a>
                           </li>
                           <li class="likhun-inner-box col-lg-1 col-md-2 col-sm-3 col-6">
                              <a href="#">
                                 <image src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                                 <span class="artist-name">আশিক</span>
                              </a>
                           </li>
                           <li class="likhun-inner-box col-lg-1 col-md-2 col-sm-3 col-6">
                              <a href="#">
                                 <image src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                                 <span class="artist-name">আশিক</span>
                              </a>
                           </li>
                           <li class="likhun-inner-box col-lg-1 col-md-2 col-sm-3 col-6">
                              <a href="#">
                                 <image src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                                 <span class="artist-name">আশিক</span>
                              </a>
                           </li>
                           <li class="likhun-inner-box col-lg-1 col-md-2 col-sm-3 col-6">
                              <a href="#">
                                 <image src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                                 <span class="artist-name">আশিক</span>
                              </a>
                           </li>
                           <li class="likhun-inner-box col-lg-1 col-md-2 col-sm-3 col-6">
                              <a href="#">
                                 <image src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                                 <span class="artist-name">আশিক</span>
                              </a>
                           </li>
                           <li class="likhun-inner-box col-lg-1 col-md-2 col-sm-3 col-6">
                              <a href="#">
                                 <image src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                                 <span class="artist-name">আশিক</span>
                              </a>
                           </li>
                           <li class="likhun-inner-box col-lg-1 col-md-2 col-sm-3 col-6">
                              <a href="#">
                                 <image src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                                 <span class="artist-name">আশিক</span>
                              </a>
                           </li>
                           <li class="likhun-inner-box col-lg-1 col-md-2 col-sm-3 col-6">
                              <a href="#">
                                 <image src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                                 <span class="artist-name">আশিক</span>
                              </a>
                           </li>
                           <li class="likhun-inner-box col-lg-1 col-md-2 col-sm-3 col-6">
                              <a href="#">
                                 <image src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                                 <span class="artist-name">আশিক</span>
                              </a>
                           </li>
                           <li class="likhun-inner-box col-lg-1 col-md-2 col-sm-3 col-6">
                              <a href="#">
                                 <image src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                                 <span class="artist-name">আশিক</span>
                              </a>
                           </li>
                           <li class="likhun-inner-box col-lg-1 col-md-2 col-sm-3 col-6">
                              <a href="#">
                                 <image src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                                 <span class="artist-name">আশিক</span>
                              </a>
                           </li>
                        </ul>
                     </div>
                     <div class="show-more-list text-center mt-15">
                        <a href="pricing.html" class="tp-btn btn-sm">আরো দেখুন <i class="fal fa-long-arrow-right"></i></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- Popular Artist Area End -->

      <!-- Popular Category Area Start -->
      <section class="popular-category pt-120 pb-120">
         <div class="container">
            <div class="row g-1">
               <div class="col-lg-5 offset-lg-1">
                  <div class="popular-category-box">
                     <div class="popular-category-title">
                        <h4>সবচেয়ে জনপ্রিয় ক্যাটাগরি</h4>
                        <p>বয়স, উপজেলা, পেশা, শিক্ষাগত যোগ্যতা সহ অনেক ফিল্টার ব্যবহার করে সহজেই বায়োডাটা খুঁজতে পারবেন</p>
                        <a href="#" class="tp-btn btn-sm">সবগুলো দেখুন <i class="fal fa-long-arrow-right"></i></a>
                     </div>
                  </div>
               </div>
               <div class="col-lg-5 offset-lg-1">
                  <div class="popular-category-list">
                     <ul class="likhun-box row list-unstyled">
                        <li class="likhun-inner-box text-center col-lg-6 col-md-6 col-sm-12 col-6">
                           <a href="#" class="border d-block">
                              <img src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                              <span class="artist-name d-lg-block">আশিক</span>
                           </a>
                        </li>
                        <li class="likhun-inner-box text-center col-lg-6 col-md-6 col-sm-12 col-6">
                           <a href="#" class="border d-block">
                              <img src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                              <span class="artist-name d-lg-block">আশিক</span>
                           </a>
                        </li>
                        <li class="likhun-inner-box text-center col-lg-6 col-md-6 col-sm-12 col-6">
                           <a href="#" class="border d-block">
                              <img src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                              <span class="artist-name d-lg-block">আশিক</span>
                           </a>
                        </li>
                        <li class="likhun-inner-box text-center col-lg-6 col-md-6 col-sm-12 col-6">
                           <a href="#" class="border d-block">
                              <img src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                              <span class="artist-name d-lg-block">আশিক</span>
                           </a>
                        </li>
                        <li class="likhun-inner-box text-center col-lg-6 col-md-6 col-sm-12 col-6">
                           <a href="#" class="border d-block">
                              <img src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                              <span class="artist-name d-lg-block">আশিক</span>
                           </a>
                        </li>
                        <li class="likhun-inner-box text-center col-lg-6 col-md-6 col-sm-12 col-6">
                           <a href="#" class="border d-block">
                              <img src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                              <span class="artist-name d-lg-block">আশিক</span>
                           </a>
                        </li>
                        
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </section>      
      <!-- Popular Category Area End -->

      <!-- Popular Lyrics Area Start -->
      <section class="pupolar-lyrics pt-100 pb-100">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="section__wrapper mb-30 text-center">                           
                     <h5 class="section__title">সবচেয়ে জনপ্রিয় লিরিক্স</h5>
                     <p class="section__desc">সকল বাংলা, হিন্দি ইংরেজি গানের কথা বা লিরিক্স পেতে আমাদের সাথে থাকুন।
                        আমরা সকল ধরনের গানের লিরিক্স লেখার জন্য অর্ডার গ্রহন করে থাকি।</p>
                  </div>
               </div>
               <div class="col-lg-12">
                  <div class="music-lyrics">
                     <ul class="likhun-box row list-unstyled">

                        <li class="likhun-inner-box text-center col-lg-6 col-md-6 col-sm-12 col-6">
                           <div class="music-box-inside border">
                              <div class="music-box-inside__left">
                                 <img src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                              </div>
                              <div class="music-box-inside__right">
                                 <a href="#" class="d-block">
                                    <strong class="artist-name d-lg-block">Song : Murir Tin (মুড়ির টিন)</strong>
                                    <span class="artist-name d-lg-block">Artist : আশিক</span>
                                    <span class="artist-name d-lg-block">Singer : আশিক</span>
                                 </a>                                 
                              </div>
                           </div>
                        </li>
                        <li class="likhun-inner-box text-center col-lg-6 col-md-6 col-sm-12 col-6">
                           <div class="music-box-inside border">
                              <div class="music-box-inside__left">
                                 <img src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                              </div>
                              <div class="music-box-inside__right">
                                 <a href="#" class="d-block">
                                    <strong class="artist-name d-lg-block">Song : Murir Tin (মুড়ির টিন)</strong>
                                    <span class="artist-name d-lg-block">Artist : আশিক</span>
                                    <span class="artist-name d-lg-block">Singer : আশিক</span>
                                 </a>                                 
                              </div>
                           </div>
                        </li>
                        <li class="likhun-inner-box text-center col-lg-6 col-md-6 col-sm-12 col-6">
                           <div class="music-box-inside border">
                              <div class="music-box-inside__left">
                                 <img src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                              </div>
                              <div class="music-box-inside__right">
                                 <a href="#" class="d-block">
                                    <strong class="artist-name d-lg-block">Song : Murir Tin (মুড়ির টিন)</strong>
                                    <span class="artist-name d-lg-block">Artist : আশিক</span>
                                    <span class="artist-name d-lg-block">Singer : আশিক</span>
                                 </a>                                 
                              </div>
                           </div>
                        </li>
                        <li class="likhun-inner-box text-center col-lg-6 col-md-6 col-sm-12 col-6">
                           <div class="music-box-inside border">
                              <div class="music-box-inside__left">
                                 <img src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                              </div>
                              <div class="music-box-inside__right">
                                 <a href="#" class="d-block">
                                    <strong class="artist-name d-lg-block">Song : Murir Tin (মুড়ির টিন)</strong>
                                    <span class="artist-name d-lg-block">Artist : আশিক</span>
                                    <span class="artist-name d-lg-block">Singer : আশিক</span>
                                 </a>                                 
                              </div>
                           </div>
                        </li>
                        <li class="likhun-inner-box text-center col-lg-6 col-md-6 col-sm-12 col-6">
                           <div class="music-box-inside border">
                              <div class="music-box-inside__left">
                                 <img src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                              </div>
                              <div class="music-box-inside__right">
                                 <a href="#" class="d-block">
                                    <strong class="artist-name d-lg-block">Song : Murir Tin (মুড়ির টিন)</strong>
                                    <span class="artist-name d-lg-block">Artist : আশিক</span>
                                    <span class="artist-name d-lg-block">Singer : আশিক</span>
                                 </a>                                 
                              </div>
                           </div>
                        </li>
                        <li class="likhun-inner-box text-center col-lg-6 col-md-6 col-sm-12 col-6">
                           <div class="music-box-inside border">
                              <div class="music-box-inside__left">
                                 <img src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                              </div>
                              <div class="music-box-inside__right">
                                 <a href="#" class="d-block">
                                    <strong class="artist-name d-lg-block">Song : Murir Tin (মুড়ির টিন)</strong>
                                    <span class="artist-name d-lg-block">Artist : আশিক</span>
                                    <span class="artist-name d-lg-block">Singer : আশিক</span>
                                 </a>                                 
                              </div>
                           </div>
                        </li>
                        <li class="likhun-inner-box text-center col-lg-6 col-md-6 col-sm-12 col-6">
                           <div class="music-box-inside border">
                              <div class="music-box-inside__left">
                                 <img src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                              </div>
                              <div class="music-box-inside__right">
                                 <a href="#" class="d-block">
                                    <strong class="artist-name d-lg-block">Song : Murir Tin (মুড়ির টিন)</strong>
                                    <span class="artist-name d-lg-block">Artist : আশিক</span>
                                    <span class="artist-name d-lg-block">Singer : আশিক</span>
                                 </a>                                 
                              </div>
                           </div>
                        </li>
                        <li class="likhun-inner-box text-center col-lg-6 col-md-6 col-sm-12 col-6">
                           <div class="music-box-inside border">
                              <div class="music-box-inside__left">
                                 <img src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                              </div>
                              <div class="music-box-inside__right">
                                 <a href="#" class="d-block">
                                    <strong class="artist-name d-lg-block">Song : Murir Tin (মুড়ির টিন)</strong>
                                    <span class="artist-name d-lg-block">Artist : আশিক</span>
                                    <span class="artist-name d-lg-block">Singer : আশিক</span>
                                 </a>                                 
                              </div>
                           </div>
                        </li>
                     </ul>
                     <!-- Show more -->
                     <div class="show-more-btn text-center mt-15">
                        <a href="#" class="tp-btn btn-sm">সবগুলো দেখুন <i class="fal fa-long-arrow-right"></i></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
@endsection