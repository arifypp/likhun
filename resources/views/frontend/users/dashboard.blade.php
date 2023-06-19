@extends('frontend.layouts.layout')
@section('title', 'Dashboard')
@push('styles')
<style>
    .header-area {
        background: #4285F4 !important;
    }
</style>
@endpush
@section('content')

<!-- Start of user dashboard area -->
<section class="user-dashboard pt-100">
    <div class="container">
        <div class="row overflow-hidden">
            <div class="col-md-3">
            @include('frontend.layouts.user-sidebar')
            </div>
            <div class="col-md-9">
                <div class="profile-dashboard">
                    <div class="show-menu d-none">
                        <button type="button" id="sidebarOpen" class="btn btn-primary">
                            <i class="fa fa-bars"></i>
                            <span class="sr-only">Toggle Menu</span>
                        </button>
                    </div>
                    <!-- title -->
                    <div class="profile-dashboard-title">
                        <h4>আমার ড্যাশবোর্ড</h4>
                    </div>
                    <!-- end title -->

                    <!-- Create three box one with primary background -->
                    <div class="summary-dashboard mt-30">
                        <div class="row">
                            <div class="col-4 mb-25">
                                <div class="summary-dashboard-box">
                                    <div class="card bg-primary text-center text-light">
                                        <div class="card-body">
                                            <h3 class="text-light">0</h3>
                                            <h6 class="text-light">কানেক রয়েছে</h6>
                                            <p class="text-light">আরো কানেক ক্রয় করতে নিচের ক্রয় বাটনে ক্লিক করুন</p>
                                            <a href="{{ route('frontend.package') }}" class="btn btn-light">ক্রয় করুন</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 mb-25">
                                <div class="summary-dashboard-box">
                                    <div class="card bg-light text-center">
                                        <div class="card-body">
                                            <h3>0</h3>
                                            <h6>গানের ভিজিট সংখ্যা</h6>
                                            <p>আরো গান ভিজিট করতে নিচের গান বাটনে ক্লিক করুন</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 mb-25">
                                <div class="summary-dashboard-box">
                                    <div class="card bg-light text-center">
                                        <div class="card-body">
                                            <h3>0</h3>
                                            <h6>এ পর্যন্ত আপনি যত গুলো গান ডাউনলোড করেছেন</h6>
                                            <p>আপনি যেসব গান ডাউনলোড করেছেন, বাংলা, হিন্দি, তামিল, উর্দূ ইত্যাদি।</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 mb-25">
                                <div class="summary-dashboard-box">
                                    <div class="card bg-light text-end">
                                        <div class="card-body">
                                            <h3 class="mb-0">0</h3>
                                            <span>
                                                <img src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="icon">
                                            </span>
                                            <h6 class="mb-0">পছন্দের গান</h6>
                                            <p class="mb-0">আপনার পছন্দের তালিকাভুক্ত গান সমূহ।</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 mb-25">
                                <div class="summary-dashboard-box">
                                    <div class="card bg-light text-end">
                                        <div class="card-body">
                                            <h3 class="mb-0">0</h3>
                                            <span>
                                                <img src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="icon">
                                            </span>
                                            <h6 class="mb-0">অপছন্দের গান</h6>
                                            <p class="mb-0">আপনার অপছন্দের তালিকাভুক্ত গান সমূহ।</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 mb-25">
                                <div class="summary-dashboard-box">
                                    <div class="card bg-light text-end">
                                        <div class="card-body">
                                            <h3 class="mb-0">0</h3>
                                            <span>
                                                <img src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="icon">
                                            </span>
                                            <h6 class="mb-0">ক্রয় করা গান</h6>
                                            <p class="mb-0">আপনার ক্রয় সংক্রান্ত সমস্ত তথ্য।</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- title -->
                    <div class="profile-dashboard-title">
                        <h4>ট্রেন্ডিং গানের লিস্ট সমূহ</h4>
                    </div>
                    <!-- end title -->
                    <div class="music-lyrics mt-20">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.logout').click(function(e) {
                e.preventDefault();
                $('#logout-form').submit();
            })
        });
    </script>
@endpush