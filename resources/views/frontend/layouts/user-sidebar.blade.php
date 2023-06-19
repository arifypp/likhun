<aside class="user-dashboard-sidebar">
    <div class="custom-menu">
        <button type="button" id="sidebarCollapse" class="btn btn-primary">
            <i class="fa fa-bars"></i>
            <span class="sr-only">Toggle Menu</span>
        </button>
    </div>
    <div class="user-info">
        <div class="user-info__img avatar">
            <img src="{{ asset('assets/frontend/img/music-icon.png') }}" alt="user">
        </div>
        <div class="user-info__text mt-2">
            <h6 class="text-muted mb-0">ব্যবহারকারীর নাম</h6>
            <span class="d-block text-primary"><strong>{{ auth()->user()->name }}</strong></span>
            <a href="#" class="badge badge-primary bg-primary">আমার প্রোফাইল</a>
        </div>
    </div>
    <div class="user-info-menu">
    <ul class="list-unstyled">
        <li><a href="#"><span class="me-2"><i class="fas fa-home"></i> </span> আমার ড্যাশবোর্ড</a></li>
        <li><a href="#" class="active"><span class="me-2"><i class="fas fa-heart"></i> </span> পছন্দের তালিকা</a></li>
        <li><a href="#"><span class="me-2"><i class="fas fa-heart"></i> </span> অপছন্দের তালিকা</a></li>
        <li><a href="#"><span class="me-2"><i class="fas fa-shopping-cart"></i> </span> আমার ক্রয়সমূহ</a></li>
        <li><a href="#"><span class="me-2"><i class="fas fa-user"></i> </span> সাপোর্ট & রিপোর্ট</a></li>
        <li><a href="#"><span class="me-2"><i class="fas fa-shop"></i> </span> অর্ডার করুন</a></li>
        <li><a href="#"><span class="me-2"><i class="fas fa-user"></i> </span> আমার প্রোফাইল</a></li>
        <li><a href="#"> <span class="me-2"><i class="fas fa-key"></i> </span> পাসওয়ার্ড পরিবর্তন</a></li>
        <li><a href="#" class="logout"> <span class="me-2"><i class="fas fa-sign-out-alt"></i> </span> লগ আউট</a></li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </ul>
</aside>