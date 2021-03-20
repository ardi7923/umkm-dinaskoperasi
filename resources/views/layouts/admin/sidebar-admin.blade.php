 <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <img src="{{ asset('logo.png') }}" width="50px" alt="">
        <div class="sidebar-brand-text mx-3">Smansa</div>
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

      <li class="nav-item" id="organization-committee">
        <a class="nav-link" href="{{ url('organization-committe') }}">
          <i class="fas fa-fw fa-users"></i>
          <span>Pengurus</span></a>
      </li>

      <li class="nav-item" id="post">
        <a class="nav-link" href="{{ url('post') }}">
          <i class="fas fa-fw fa-image"></i>
          <span>Postingan</span></a>
      </li>

      <li class="nav-item" id="organization-committee">
        <a class="nav-link" href="{{ url('student') }}">
          <i class="fas fa-fw fa-user"></i>
          <span>Siswa</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <li class="nav-item" id="organization-committee">
        <a class="nav-link" href="{{ url('data-training') }}">
          <i class="fas fa-fw fa-list"></i>
          <span>Data Training</span></a>
      </li>

      <li class="nav-item" id="organization-committee">
        <a class="nav-link" href="{{ url('result-navybayes') }}">
          <i class="fas fa-fw fa-calculator"></i>
          <span>Hitung Naive bayes</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->