@extends('frontend.layouts.layout')
@section('title', 'Package')
@push('styles')
<style>
    .header-area {
        background: #4285F4 !important;
    }
</style>
@endpush
@section('content')
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
                        <h4>আমার কানেকশন</h4>
                    </div>
                    <!-- end title -->

                    <!-- Create three box one with primary background -->
                    <div class="summary-dashboard mt-30">
                        <div class="row">
                            <div class="col-12 mb-25">
                                <div class="summary-dashboard-box">
                                    <div class="card bg-light shadow-sm text-center text-dark">
                                        <div class="card-body">
                                            <h3 class="text-dark">0</h3>
                                            <h6 class="text-dark">কানেক রয়েছে</h6>
                                            <p class="text-dark">আরো কানেক ক্রয় করতে নিচের প্যাকেজ নির্বাচন করুন</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- title -->
                    <div class="profile-dashboard-title">
                        <h4>কানেকশন ক্রয় করুন</h4>
                    </div>
                    <!-- end title -->
                    <!-- Create three box one with primary background -->
                    <div class="summary-dashboard mt-30">
                        <div class="row">
                            @foreach($packages as $package)
                            <div class="col-md-4 col-sm-6 col-12 mb-25">
                                <div class="summary-dashboard-box">
                                    <div class="card bg-light shadow-sm text-center text-dark">
                                        <div class="card-header">
                                            <h4 class="text-dark">{{$package->name}}</h4>
                                        </div>
                                        <div class="card-body">
                                            <h6 class="text-primary">{{$package->price}} টাকা</h6>
                                            <ul class="list-unstyled py-2">
                                                @foreach($package->features as $feature)
                                                <li class="py-1">{{$feature->name}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="card-footer p-0">
                                            <a href="{{route('frontend.package.payment', $package->slug)}}" class="btn tp-btn btn-block w-100">
                                                <i class="fa fa-shopping-cart me-3"></i> ক্রয় করুন
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection