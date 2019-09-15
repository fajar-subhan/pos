    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion sideactive" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo BASEURL ?>">
            <div class="sidebar-brand-icon rotate-n-0">
                <img src="<?php echo BASEURL ?>assets/img/poslogo.png" width="60">
            </div>
            <div class="sidebar-brand-text mx-3"><strong>POS</strong></div>
        </a>

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="<?php echo BASEURL ?>">
                <i class="fas fa-tachometer-alt fa-fw"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Nav Item - Stok Barang -->
        <li class="nav-item">
            <a class="nav-link" href="<?php echo BASEURL ?>stok">
                <i class="fas  fa-clipboard-list fa-fw"></i>
                <span> Stok Barang</span>
            </a>
        </li>

        <!-- Pembelian -->
        <li class="beli nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pembelian" aria-controls="collapseUtilities">
                <i class="fas fa-money-bill-alt fa-fw"></i>
                <span>Pembelian</span>
            </a>
            <div id="pembelian" class="collapse" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item link-beli" href="<?php echo BASEURL ?>pembelian">
                        <i class="fas fa-table"></i> Data Pembelian
                    </a>
                </div>
            </div>
        </li>

        <!-- Penjualan -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#penjualan" aria-controls="collapseUtilities">
                <i class="fas fa-shopping-cart fa-fw"></i>
                <span>Penjualan</span>
            </a>
            <div id="penjualan" class="collapse" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?php echo BASEURL ?>penjualan">
                        <i class="fas fa-table"></i> Data Penjualan
                    </a>
                </div>
            </div>
        </li>

        <!-- Laporan -->
        <li class="nav-item active">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#laporan" aria-controls="collapseUtilities">
                <i class="fas fa-folder-open fa-fw"></i>
                <span>Laporan</span>
            </a>
            <div id="laporan" class="collapse" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <!-- Laporan Pembelian -->
                    <a class="collapse-item" href="<?php echo BASEURL ?>laporan_beli">
                        <i class="fas fa-file-excel"></i> Laporan Pembelian
                    </a>
                    <!-- Laporan Penjualan -->
                    <a class="collapse-item" href="<?php echo BASEURL ?>laporan_jual">
                        <i class="fas fa-file-excel"></i> Laporan Penjualan
                    </a>
                </div>

            </div>
        </li>

        <!-- Pengaturan -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pengaturan" aria-controls="collapseUtilities">
                <i class="fas fa-cogs fa-fw"></i>
                <span>Pengaturan</span>
            </a>
            <div id="pengaturan" class="collapse" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?php echo BASEURL ?>pengaturan_nama">
                        <i class="fas fa-building"></i> Nama Perusahaan
                    </a>
                    <a class="collapse-item" href="<?php echo BASEURL ?>pengaturan_alamat">
                        <i class="fas fa-map-marked-alt"></i> Alamat Perusahaan
                    </a>
                </div>
            </div>
        </li>

        <?php if ($_SESSION["data"]["tipe"] === "1") : ?>
            <!-- User -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#user" aria-controls="collapseUtilities">
                    <i class="fas fa-user-cog fa-fw"></i>
                    <span>User</span>
                </a>
                <div id="user" class="collapse" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?php echo BASEURL ?>user">
                            <i class="fas fa-users"></i> Data User
                        </a>
                    </div>
                </div>
            </li>
        <?php endif; ?>

        <!-- Keluar -->
        <li class="nav-item">
            <a class="nav-link" href="index.html" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-fw"></i>
                <span>Keluar</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->


    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-2 static-top shadow">
                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">

                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>


                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">Hai, <?php echo $_SESSION["data"]["nama"] ?></span>
                            <img class="img-profile rounded-circle" src="<?php echo BASEURL ?>assets/img/profile/icon.png">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Keluar
                            </a>
                        </div>
                    </li>

                </ul>
            </nav>
            <!-- End of Topbar -->


            <!-- Begin Page Content -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 mt-1">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb small">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo BASEURL ?>">
                                        <i class="fas fa-tachometer-alt"></i> Dashboard
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <i class="fas fa-folder-open"></i> Laporan
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <i class="fas fa-file-excel"></i> Laporan Penjualan
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-2  border-primary">
                            <div class="card-header bg-primary text-white font-weight-bold text-uppercase">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 col-lg-6 mt-1">
                                        <i class='fa fa-file-excel'></i> Laporan Penjualan
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h4 class="font-weight-bold">Keseluruhan</h4>
                                        <hr>
                                        <a href="<?php echo BASEURL ?>laporan_jual/laporan_penjualan_all" class="btn btn-success btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-download"></i>
                                            </span>
                                            <span class="text">Unduh</span>
                                        </a>
                                        <h4 class="font-weight-bold mt-5">Periode</h4>
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">

                                        <form id="form" action="<?php echo BASEURL ?>laporan_jual/laporan_penjualan_periode" method='post'>

                                            <div class="form-row">
                                                <!-- tamggal awal -->
                                                <div class="form-group col-md-6">
                                                    <div class="input-group mb-1" id="tanggal_awal">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-calendar-alt"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control" name="tgl_awal" id="tgl_awal" placeholder="tanggal awal" autocomplete="off">
                                                    </div>
                                                    <div id="tanggal_awalError"></div>
                                                </div>

                                                <!-- tanggal akhir -->
                                                <div class="form-group col-md-6">
                                                    <div class="input-group mb-1" id="tanggal_akhir">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-calendar-alt"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control" name="tgl_akhir" id="tgl_akhir" placeholder="tanggal akhir" autocomplete="off">
                                                    </div>
                                                    <div id="tanggal_akhirError"></div>

                                                </div>
                                            </div>
                                            <div class="col-lg-12 text-center">
                                                <button type="submit" id="unduhperiode" class="btn btn-success btn-icon-split mt-3">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-download"></i>
                                                    </span>
                                                    <span class="text">Unduh</span>
                                                </button>

                                                <button type="reset" id="reset" class="btn btn-danger btn-icon-split mt-3">
                                                    <span class=" icon text-white-50">
                                                        <i class="fas fa-eraser"></i>
                                                    </span>
                                                    <span class="text">Hapus</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->