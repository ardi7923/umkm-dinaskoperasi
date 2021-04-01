 <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <img src="{{ asset('logo.png') }}" width="50px" alt="">
        <div class="sidebar-brand-text mx-3">UMKM </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item" id="home">
        <a class="nav-link" href="{{ url('dashboard') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <div class="sidebar-heading">
        Data Master
      </div>

      <li class="nav-item" id="organization-committee">
        <a class="nav-link" href="{{ url('admin/category') }}">
          <i class="fas fa-fw fa-list"></i>
          <span>Kategori</span></a>
      </li>

      <li class="nav-item" id="organization-committee" style="margin-top: -20px">
        <a class="nav-link" href="{{ url('admin/bank') }}">
          <i class="fas fa-fw fa-credit-card"></i>
          <span>Bank</span></a>
      </li>

       <hr class="sidebar-divider">
      
      <div class="sidebar-heading">
        UMKM
      </div>

      <li class="nav-item" id="organization-committee">
        <a class="nav-link" href="{{ url('admin/verify-umkm') }}">
          <i class="fas fa-fw fa-check"></i>
          <span>Verifikasi Umkm</span></a>
      </li>

      <li class="nav-item" id="organization-committee" style="margin-top: -20px">
        <a class="nav-link" href="{{ url('admin/data-umkm') }}">
          <i class="fas fa-fw fa-store"></i>
          <span>Data Umkm</span></a>
      </li>

      <li class="nav-item" id="organization-committee" style="margin-top: -20px">
        <a class="nav-link" href="{{ url('admin/user-umkm') }}">
          <i class="fas fa-fw fa-users"></i>
          <span>User Umkm</span></a>
      </li>

      <hr class="sidebar-divider">
      
      <div class="sidebar-heading">
        Produk
      </div>

      <li class="nav-item" id="organization-committee">
        <a class="nav-link" href="{{ url('admin/verify-product') }}">
          <i class="fas fa-fw fa-check"></i>
          <span>Verifikasi Produk</span></a>
      </li>

      <li class="nav-item" id="organization-committee" style="margin-top: -20px">
        <a class="nav-link" href="{{ url('admin/data-product') }}">
          <i class="fas fa-fw fa-archive"></i>
          <span>Data Produk</span></a>
      </li>

      <div class="sidebar-heading">
        Pemesanan
      </div>

      <li class="nav-item" id="organization-committee">
        <a class="nav-link" href="{{ url('admin/payment-confirm') }}">
          <i class="fas fa-fw fa-check"></i>
          <span>Konfirmasi Pembayaran</span></a>
      </li>



      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->