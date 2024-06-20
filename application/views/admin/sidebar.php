<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-dark accordion z-1" id="accordionSidebar" style="background-color: #0a2647">
        <!-- Sidebar - Brand -->
        <li class="sidebar-brand d-flex align-items-center justify-content-center gap-3">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                <div class="sidebar-brand-icon">
                    <img src="<?= base_url('') ?>/assets/img/polmanLogo.png" alt="" width="30px">
                </div>
                <div class="sidebar-brand-text mx-3">AECSERVER</div>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider my-0" />

        <!-- Nav Item - Dashboard -->
        <li class="nav-item <?= ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == '') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('admin') ?>">
                <i class="fas fa-fw fa-chart-line"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Nav Item - Device -->
        <li class="nav-item <?= ($this->uri->segment(1) == 'device') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('device') ?>">
                <i class="fas fa-fw fas fa-server"></i>
                <span>Device</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider my-0" />

        <!-- Nav Item - Profile -->
        <li class="nav-item <?= ($this->uri->segment(2) == 'profile' || $this->uri->segment(2) == 'edit') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('admin/profile') ?>">
                <i class="fas fa-fw fa-user"></i>
                <span>Profile</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider my-0" />

        <!-- Nav Item - Logout -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('auth/logout') ?>">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span></a>
        </li>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <h1 class="fs-4"></h1>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto align-items-center">
                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow small">
                        Halo, <span class=" mr-2 d-none d-lg-inline text-gray-600"><?= $user['name'] ?></span>
                        <img class="img-profile rounded-circle" src="<?= base_url('assets/img/') . $user['image'] ?>" alt="" width="40px">
                    </li>
                </ul>
            </nav>
            <!-- End of Topbar -->