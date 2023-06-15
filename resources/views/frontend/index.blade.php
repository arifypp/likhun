@extends('frontend.layouts.layout')
@section('title', 'লিখুন')
@push('styles')
<style>
   div#lyrics_search_result {
      position: absolute;
      height: 400px;
      left: 0;
      right: 0;
      background: #fff;
      display: none;
      overflow: auto;
      z-index: 999;
   }
</style>
@endpush
@section('content')
      <!-- slider-area-start  -->
      <section class="slider-area fix">
         <div class="main-slider">
            <div class="swiper-wrapper p-relative">
               <div class="item-slider sliderm-height p-relative swiper-slide">
                  <div class="slide-bg" data-background="{{ asset('assets/frontend/img/slider/hero-bg.png') }}"></div>
                  <div class="container">
                     <div class="row ">
                        <div class="col-lg-12 col-sm-12 col-12">
                           <div class="slider-contant mt-25">
                               <!-- <span data-animation="fadeInUp" data-delay=".3s">Industrial</span> -->
                               <h2 class="slider-title" data-animation="fadeInUp" data-delay=".3s">৫০২১+ গানের লিরিক্স ক্রয়ের জন্য প্রস্তুত</h2> 
                               <h4 class="slider-sub-title" data-animation="fadeInUp" data-delay=".3s">সকল বাংলা, হিন্দি ইংরেজি গানের কথা বা লিরিক্স পেতে আমাদের সাথে থাকুন। আমরা সকল ধরনের গানের লিরিক্স লেখার জন্য অর্ডার গ্রহন করে থাকি।</h4>
                               <div class="subscribe-form subscribe-form-2 p-relative mb-30 col-sm-12 col-xs-12 col-lg-8 m-auto">
                                 <form action="{{ route('frontend.song.search') }}" method="GET" id="lyrics_search">
                                     <input type="text" name="lyrics_search" placeholder="আপনার পছন্দের গানের নাম লিখুন..." max="100">
                                     <button type="submit" class="bg-dark">সার্চ করুন <i class="fal fa-long-arrow-right"></i></button>
                                 </form>
                                 <div id="lyrics_search_result"></div>
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

                           @foreach(popular_artists() as $artist)
                           <li class="likhun-inner-box col-lg-1 col-md-2 col-sm-6 col-6">
                              <a href="#">
                                 <image src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                                 <span class="artist-name">{{ \Illuminate\Support\Str::limit($artist->name, 6) }}</span>
                              </a>
                           </li>
                           @endforeach   

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
                        @foreach(popular_lyrics() as $lyrics)
                        <li class="likhun-inner-box text-center col-lg-6 col-md-6 col-sm-12">
                           <div class="music-box-inside border">
                              <div class="music-box-inside__left">
                                 <img src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                              </div>
                              <div class="music-box-inside__right">
                                 <a href="{{ route('frontend.songs.show', $lyrics->slug) }}" class="d-block">
                                    <strong class="artist-name d-lg-block">Song : {{ $lyrics->title }}</strong>
                                    <span class="artist-name d-lg-block">Artist : {{ $lyrics->artist->name }}</span>
                                    <span class="artist-name d-lg-block">Singer : {{ $lyrics->category->name }}</span>
                                 </a>                                 
                              </div>
                           </div>
                        </li>
                        @endforeach
                     </ul>
                     <!-- Show more -->
                     <div class="show-more-btn text-center mt-15">
                        <a href="{{ route('frontend.all-songs') }}" class="tp-btn btn-sm">সবগুলো দেখুন <i class="fal fa-long-arrow-right"></i></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
@endsection

@push('scripts')
<script>
   $(document).ready(function(){
      // #lyrics_search search
      $('#lyrics_search').on('keyup',function(){
         var value = $('input[name=lyrics_search]').val();
         $.ajax({
            type : 'get',
            url : '{{ route('frontend.song.search') }}',
            data:{'lyrics_search':value},
            beforeSend:function(){
               // replace button and show loading spinner
               $('#lyrics_search button').html('<i class="fa fa-spinner fa-spin"></i>');
            },
            success:function(data){
               // replace loading spinner and show button
               $('#lyrics_search button').html('সার্চ করুন <i class="fal fa-long-arrow-right"></i>');
               $('#lyrics_search_result').css('display','block');
               // #lyrics_search create ul and li and show data title and image and artist
               var html = '';
               html += '<ul class="row">';
               $.each(data.data,function(key,value){
                  html += '<li class="likhun-inner-box text-center col-lg-12 col-md-12 col-sm-12 col-12">';
                  html += '<div class="music-box-inside border">';
                  html += '<div class="music-box-inside__left p-0">';
                  html += '<img src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist" width="20px">';
                  html += '</div>';
                  html += '<div class="music-box-inside__right">';
                  html += '<a href="#" class="d-block">';
                  html += '<strong class="artist-name d-lg-block">Song : '+value.title+'</strong>';
                  html += '</a>';
                  html += '</div>';
                  html += '</div>';
                  html += '</li>';
               });
               html += '</ul>';
               $('#lyrics_search_result').html(html);
            }
         });
      });
   });
</script>
@endpush
