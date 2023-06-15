@extends('frontend.layouts.layout')
@section('title', $song->title)
@section('content')
<!-- slider-area-start  -->
<section class="page__title-area page__title-height page__title-overlay d-flex align-items-center" data-background="{{ asset('assets/frontend/img/slider/hero-bg.png') }}">
    <div class="container">
        <div class="row">
        <div class="col-xxl-12">
            <div class="page__title-wrapper mt-100">                  
                <div class="breadcrumb-menu">
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><span>Lyrics</span></li>
                    </ul>
                </div>
                <h3 class="page__title mt-20">Lyrics - {{ $song->title }}</h3>
            </div>
        </div>
        </div>
    </div>
</section>
<!-- slider-area-end -->
<!-- Content Area Start -->
<section class="song-content-area pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="song-content">
                    <div class="card">
                        <div class="card-header align-item-center">
                            <div class="song-content__header d-flex flex-row justify-content-between">
                                <div class="song-content__header-left">
                                    <div class="song-content__header-content">
                                        <span class="song-content__desc"> <i class="fal fa-music"></i> লিরিক্স</span>
                                        <h6 class="song-content__title">{{ $song->title }}</h6>
                                    </div>
                                </div>
                                <div class="song-content__header-right">
                                    <div class="song-content__header-btn">
                                        <a href="javascript:void(0)" class="theme-btn"> <i class="fal fa-download"></i> ডাউনলোড</a>
                                        <a href="javascript:void(0)" class="theme-btn"> <i class="fal fa-copy"></i> কপি</a>
                                        <a href="javascript:void(0)" class="theme-btn"> <i class="fal fa-print"></i> প্রিন্ট</a>
                                        <!-- <div class="dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fal fa-share-alt"></i> শেয়ার
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item" href="#"><i class="fab fa-facebook-f"></i> ফেসবুক</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fab fa-twitter"></i> টুইটার</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fab fa-instagram"></i> ইন্সটাগ্রাম</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fab fa-youtube"></i> ইউটিউব</a></li>
                                            </ul>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body bg-light">
                            <div class="song-content__body">
                                <div class="song-content__body-top">
                                    <div class="song-content__body-left">
                                        <div class="song-content__body-content">
                                            {!! $song->short_description !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="song-content__body-btn text-center pt-15 pb-15">
                                <p class="text-muted">এই গানটি কিনতে আপনার ১টি কানেকশন খরচ হবে।</p>
                                @auth->check()
                                <a href="#" class="btn btn--primary tp-btn btn--lg btn--round mb-15">
                                    <span class="mr-10"><i class="fal fa-shopping-cart"></i></span> সম্পূর্ণ লিরিক্স ক্রয় করুন
                                </a>
                                @else
                                <a href="{{ route('login') }}" class="btn btn--primary tp-btn btn--lg btn--round mb-15">
                                    <span class="mr-10"><i class="fal fa-shopping-cart"></i></span> সম্পূর্ণ লিরিক্স ক্রয় করুন
                                </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                    <div class="song-content__footer d-flex justify-content-between pt-20 pb-20 border-bottom-1">
                            <div class="song-content__footer-left">
                                <div class="song-content__footer-views">
                                    <span class="mr-10"><i class="fal fa-eye"></i></span> {{ bn2enNumber($song->hits) }} বার দেখা হয়েছে
                                </div>
                            </div>
                            <div class="song-content__footer-right">
                                <div class="song-content__footer-share">
                                    <span class="mr-5"><i class="fal fa-share-alt"></i></span> শেয়ার করুন
                                    <a href="#" class="ml-10">
                                        <span class="mr-10"><i class="fab fa-facebook-f"></i></span>
                                    </a>
                                    <a href="#">
                                        <span><i class="fab fa-twitter"></i></span>
                                    </a>
                                </div>
                            </div>
                        </hr>
                    </div>
                </div>
                <!-- Related song lyrics -->
                <div class="related-song">
                    <div class="related-song__title pt-15 pb-15">
                        <h5>সম্পর্কিত গানসমূহ</h5>
                    </div>
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="music-lyrics">
                            <ul class="likhun-box row list-unstyled">
                            @foreach( related_lyrics($song) as $related )
                                <li class="likhun-inner-box text-center col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="music-box-inside border">
                                        <div class="music-box-inside__left">
                                            <img src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                                        </div>
                                        <div class="music-box-inside__right">
                                            <a href="{{ route('frontend.songs.show', $related->slug) }}" class="d-block">
                                                <strong class="artist-name d-lg-block">Song : {{ $related->title }}</strong>
                                                <span class="artist-name d-lg-block">Artist : {{ $related->artist->name }}</span>
                                                <span class="artist-name d-lg-block">Singer : {{ $related->category->name }}</span>
                                            </a>                                 
                                        </div>
                                    </div>
                                </li>
                            @endforeach   
                            </ul>
                        </div>
                    </div>
                    </div>
                </div>
                <!-- Related song lyrics -->
            </div>
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <!-- Show three ads -->
                <div class="sidebar">
                    <div class="sidebar__ads mb-20">
                    <img src="https://via.placeholder.com/500x300" alt="ads" class="img-fluid">
                    </div>
                    <div class="sidebar__ads mb-20">
                    <img src="https://via.placeholder.com/500x400" alt="ads" class="img-fluid">
                    </div>
                    <div class="sidebar__ads mb-20">
                    <img src="https://via.placeholder.com/500x600" alt="ads" class="img-fluid">
                    </div>
            </div>
        </div>
    </div>
</section>
<!-- Content Area End -->
@endsection