@extends('frontend.layouts.layout')
@section('title', 'লিখুন')
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
                <h3 class="page__title mt-20">Lyrics</h3>
            </div>
        </div>
        </div>
    </div>
</section>
<!-- slider-area-end -->
<!-- All Song Area Start -->
<section class="song-content-area pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="music-lyrics">
                    <!-- Search with button inline form -->
                    <div class="search-song mb-20">
                        <form action="" methods="">
                            <div class="input-group">
                                <input type="text" class="form-control rounded-0" placeholder="Search Song">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary rounded-0" type="button">
                                        <i class="fa fa-search"></i> Search
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <ul class="likhun-box row list-unstyled">
                        @foreach($songs as $key => $value)
                        <li class="likhun-inner-box text-center col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="music-box-inside border">
                                <div class="music-box-inside__left">
                                    <img src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="artist">
                                </div>
                                <div class="music-box-inside__right">
                                    <a href="{{ route('frontend.songs.show', $value->slug) }}" class="d-block">
                                        <strong class="artist-name d-lg-block">Song : {{ $value->title }}</strong>
                                        <span class="artist-name d-lg-block">Artist : {{ $value->artist->name }}</span>
                                        <span class="artist-name d-lg-block">Brand : {{ $value->category->name }}</span>
                                    </a>                                 
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    <!-- Pagination -->
                    <div class="song-pagination mt-20">
                        <div class="row">
                            <div class="col-6">
                                <a href="#" class="tp-btn btn-primary btn-sm btn-block w-100 float-left">Previous</a>
                            </div>
                            <div class="col-6">
                                <a href="#" class="tp-btn btn-primary btn-sm btn-block w-100 float-right">Next</a>
                            </div>
                        </div>
                    </div>
                </div>
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
<!-- All Song Area End -->
@endsection