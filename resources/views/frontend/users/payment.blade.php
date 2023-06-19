@extends('layouts.auth')
@section('title',  $package->name . ' Package')
@section('content')
<!-- Login Page Start-->
<section class="auth-wrapper">
    <div class="row g-0">
        <div class="hero-static col-lg-4 d-none d-lg-flex flex-column">
            <div class="p-4 p-xl-5 flex-grow-1 d-flex align-items-center">
                <div class="w-100">
                    <a href="/" class="link-fx fw-semibold fs-2 text-white">
                        <img src="{{ asset('assets/frontend/img/logo/logo-white.png') }}" class="img-fluid" width="180" /></a>
                    <p class="me-xl-8 mt-2 text-light">Welcome to your amazing app. Feel free to login and start managing your projects and clients.</p>
                </div>
            </div>
            <div class="p-4 p-xl-5 d-xl-flex justify-content-between align-items-center fs-sm">
                <p class="fw-medium text-white-50 mb-0"></p>
                <ul class="list list-inline mb-0 py-2">
                    <li class="list-inline-item"><a class="text-light fw-medium" href="javascript:void(0)">Legal</a></li>
                    <li class="list-inline-item"><a class="text-light fw-medium" href="javascript:void(0)">Contact</a></li>
                    <li class="list-inline-item"><a class="text-light fw-medium" href="javascript:void(0)">Terms</a></li>
                </ul>
            </div>
        </div>
        <div class="hero-static col-lg-8 d-flex flex-column bg-light">
            <div class="p-3 w-100 d-lg-none text-center">
                <a href="/" class="link-fx fw-semibold fs-3 text-dark">
                    <img src="{{ asset('assets/frontend/img/logo/logo-black.png') }}" class="img-fluid" width="180" /></a>
            </div>
            <div class="p-4 w-100 flex-grow-1 d-flex align-items-center">
                <div class="w-100">
                    <div class="text-center mb-5">
                        <a href="{{ route('frontend.index') }}" class="mb-3">
                            <img src="{{ asset('logo-black.png') }}" class="img-fluid d-inline-block" width="100" />
                        </a>
                        <h2 class="fw-bold mb-2">চেক আউট করুন</h2>
                        <p class="text-muted">আপনার চেকআউট পেমেন্ট এর সকল তথ্য গোপন থাকবে। </p>
                    </div>
                    <div class="row g-0 justify-content-center">
                        <div class="col-sm-8 col-md-6 col-lg-6 col-xl-5">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success!</strong> {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            @if(request()->query('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success!</strong> {{ __('Your payment has been successfully completed.') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            @if($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session()->flash("error", $error); }}
                                        <strong>Error!</strong> {{ $error }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endforeach
                            @endif
                            <!-- Show package details in table -->
                            <div class="table-responsive mt-15">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <!-- Package Information -->
                                        <tr class="text-center">
                                            <td colspan="3" class="fw-bold"><h5>প্যাকেজের তথ্যবলি</h5></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>প্যাকেজের নাম</th>
                                            <td>{{ $package->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>প্যাকেজের মূল্য</th>
                                            <td>৳ {{ $package->price }} টাকা</td>
                                        </tr>
                                        <tr>
                                            <th>কানেকশন</th>
                                            <td>{{ $package->connection }} কানেকশন</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Create Form for check out with payment Bkash and Nagad -->
                            @if ( request()->query('success') )
                            <a href="{{ route('frontend.package') }}" class="btn btn-dark btn-block w-100"> <i class="fas fa-money"></i> ড্যাশবোর্ড ফিরে যান</a>
                            @else
                            <div class="checkout-package">
                                <form action="{{ route('frontend.package.payment.gateway', $package->slug) }}" method="post" id="paymentRequest">
                                    @csrf
                                    <button type="submit" class="btn btn-primary tp-btn btn-block w-100 mb-3"> <i class="fas fa-money"></i> পেমেন্ট করুন</button>
                                    <a href="{{ route('frontend.package') }}" class="btn btn-danger btn-block w-100"> <i class="fas fa-money"></i> পেমেন্ট বাতিল</a>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-4 py-3 w-100 d-lg-none d-flex flex-column flex-sm-row justify-content-between fs-sm text-center text-sm-start">
                <p class="fw-medium text-black-50 py-2 mb-0"></p>
                <ul class="list list-inline py-2 mb-0">
                    <li class="list-inline-item"><a class="text-muted fw-medium" href="javascript:void(0)">Legal</a></li>
                    <li class="list-inline-item"><a class="text-muted fw-medium" href="javascript:void(0)">Contact</a></li>
                    <li class="list-inline-item"><a class="text-muted fw-medium" href="javascript:void(0)">Terms</a></li>
                </ul>
            </div>
        </div>
    </div>       
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Show modal for payment
        $('#paymentRequest').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var type = form.attr('method');
            var data = form.serialize();
            $.ajax({
                url: url,
                type: type,
                data: data,
                success: function(response) {

                    $('#paymentProcess').modal('hide')
                    // this find submit button and disable it and change text
                    form.find('button[type="submit"]').attr('disabled', true).html('পেমেন্ট করুন');
                    
                    // get html data for show payment
                    var modalHtml = response;

                    // Append the modal HTML to the document body
                    $('.hero-static').append(modalHtml);

                    // Show the modal
                    $('#paymentProcess').modal('show');
                },
                error: function(xhr, status, error) {
                    console.log('AJAX error');
                    console.log(error);
                }
            });
        });
    });
</script>
@endpush