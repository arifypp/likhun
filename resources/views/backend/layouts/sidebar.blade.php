<nav class="sidebar">
  <div class="sidebar-header">
    <a href="{{ route('backend.dashboard') }}" class="sidebar-brand">
      <img src="{{ asset('logo.png') }}" alt="logo" class="img-fluid logo" width="80px">
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div class="sidebar-body">
  {!! $admin_sidebar->asUl( ['class' => 'nav'], ['class' => 'nav sub-menu'] ) !!}
  </div>
</nav>