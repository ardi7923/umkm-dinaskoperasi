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
          <span>Verifikasi Umkm</span>
          <span class="badge badge-danger" style="margin-left:20px">{{ get_total_unverify_umkm() }}</span>
          </a>
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
          <span>Verifikasi Produk</span>
          <span class="badge badge-danger" style="margin-left:20px">{{get_total_unverify_product()}}</span>
          </a>
      </li>

      <li class="nav-item" id="organization-committee" style="margin-top: -20px">
        <a class="nav-link" href="{{ url('admin/umkm-product') }}">
          <i class="fas fa-fw fa-archive"></i>
          <span>Data Produk</span></a>
      </li>

      <li class="nav-item" id="organization-committee" style="margin-top: -20px">
        <a class="nav-link" href="{{ url('admin/stock') }}">
          <i class="fas fa-fw fa-archive"></i>
          <span>Stok Produk</span></a>
      </li>

      <div class="sidebar-heading">
        Pemesanan
      </div>

      <li class="nav-item" id="organization-committee">
        <a class="nav-link" href="{{ url('admin/payment-confirm') }}">
          <i class="fas fa-fw fa-check"></i>
          <span>Konfirm Pembayaran</span>
          <span class="badge badge-danger" style="margin-left:10px"> {{ get_total_unconfirm_payment() }}</span>
          </a>
      </li>


      <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
              <i class="fas fa-fw fa-chart-bar"></i>
              <span>Statistik Penjualan</span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Statistik Penjualan:</h6>
                  <a class="collapse-item" href="{{ url('admin/statistik/product') }}">Produk</a>
                  <a class="collapse-item" href="{{  url('admin/statistik/umkm') }}">Umkm</a>
              </div>
          </div>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->