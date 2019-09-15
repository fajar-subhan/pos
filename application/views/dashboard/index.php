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
           <li class="nav-item active">
               <a class="nav-link" href="<?php echo BASEURL ?>">
                   <i class="fas fa-tachometer-alt fa-fw"></i>
                   <span>Dashboard</span>
               </a>
           </li>

           <!-- Nav Item - Stok Barang -->
           <li class="nav-item">
               <a class="nav-link" href="<?php echo BASEURL ?>stok">
                   <i class="fas  fa-clipboard-list fa-fw"></i>
                   <span>Stok Barang</span>
               </a>
           </li>

           <!-- Pembelian -->
           <li class="beli nav-item">
               <a class="nav-link collapsed" href="<?php echo BASEURL ?>pembelian" data-toggle="collapse" data-target="#pembelian" aria-controls="collapseUtilities">
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
               <a class="nav-link collapsed" href="<?php echo BASEURL ?>penjualan" data-toggle="collapse" data-target="#penjualan" aria-controls="collapseUtilities">
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
           <li class="nav-item">
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
               <nav class="navbar navbar-expand navbar-light bg-white topbar mb-2  static-top shadow">

                   <!-- Sidebar Toggle (Topbar) -->
                   <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                       <i class="fa fa-bars"></i>
                   </button>
                   <!-- Status -->
                   <?php
                    if ($_SESSION["data"]["tipe"] === "1") {
                        echo "
                 <span class='badge badge-pill  badge-primary'><strong>Anda masuk sebagai Admin</strong></span>
                      ";
                    } else {
                        echo "
                        <span class='badge badge-pill  badge-primary'><strong>Anda masuk sebagai User</strong></span>
                             ";
                    }
                    ?>
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
                   <h1 class="h3 mb-3 text-gray-800">Dashboard</h1>
                   <!-- Card -->
                   <div class="row">

                       <!-- Total Stok Barang -->
                       <div class="col-xl-3 col-md-6 mb-4">
                           <div class="card border-left-primary shadow h-100 py-2">
                               <div class="card-body">
                                   <div class="row no-gutters align-items-center">
                                       <div class="col mr-2">
                                           <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Stok Barang</div>
                                           <div class="h5 mb-0 font-weight-bold text-gray-800"><?php if ($data["total_stok"] != "") {
                                                                                                    echo $data["total_stok"];
                                                                                                } else {
                                                                                                    echo 0;
                                                                                                }  ?></div>
                                       </div>
                                       <div class="col-auto">
                                           <i class="fas fa-clipboard-list fa-2x text-gray-500"></i>
                                       </div>
                                   </div>
                               </div>

                               <div class="text-center">
                                   <a href="<?php echo BASEURL ?>stok" class="small"><i class="fas fa-search"></i> Lihat Stok Barang</a>
                               </div>
                           </div>

                       </div>

                       <!-- Pembelian Hari Ini -->
                       <div class="col-xl-3 col-md-6 mb-4">
                           <div class="card border-left-success shadow h-100 py-2">
                               <div class="card-body">
                                   <div class="row no-gutters align-items-center">
                                       <div class="col mr-2">
                                           <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pembelian Hari Ini</div>
                                           <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?php echo number_format($data["total_beli"], 0, ",", ".") ?></div>
                                       </div>
                                       <div class="col-auto">
                                           <i class="fas fa-money-bill-alt fa-2x text-gray-500"></i>
                                       </div>
                                   </div>
                               </div>
                               <div class="text-center">
                                   <a href="<?php echo BASEURL ?>pembelian" class="text-success small"><i class="fas fa-search"></i> Lihat Pembelian</a>
                               </div>
                           </div>
                       </div>

                       <!-- Penjualan Hari Ini -->
                       <div class="col-xl-3 col-md-6 mb-4">
                           <div class="card border-left-info shadow h-100 py-2">
                               <div class="card-body">
                                   <div class="row no-gutters align-items-center">
                                       <div class="col mr-2">
                                           <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Penjualan Hari Ini</div>
                                           <div class="row no-gutters align-items-center">
                                               <div class="col-auto">
                                                   <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Rp <?php echo number_format($data["total_jual"], 0, ",", "."); ?></div>
                                               </div>

                                           </div>
                                       </div>
                                       <div class="col-auto">
                                           <i class="fas fa-shopping-cart fa-2x text-gray-500"></i>
                                       </div>
                                   </div>
                               </div>
                               <div class="text-center">
                                   <a href="<?php echo BASEURL ?>penjualan" class="text-info small"><i class="fas fa-search"></i> Lihat Penjualan</a>
                               </div>
                           </div>
                       </div>

                       <?php
                        if ($_SESSION["data"]["tipe"] === "1") {
                            ?>
                           <!-- Total User -->
                           <div class="col-xl-3 col-md-6 mb-4">
                               <div class="card border-left-warning shadow h-100 py-2">
                                   <div class="card-body">
                                       <div class="row no-gutters align-items-center">
                                           <div class="col mr-2">
                                               <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total User</div>
                                               <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $data["total_user"] ?></div>
                                           </div>
                                           <div class="col-auto">
                                               <i class="fas fa-users fa-2x text-gray-500"></i>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="text-center">
                                       <a href="<?php echo BASEURL ?>user" class="text-warning small"><i class="fas fa-search"></i> Lihat User</a>
                                   </div>
                               </div>
                           </div>
                       <?php
                        } else {
                            ?>
                           <!-- Nama Perusahaan -->
                           <div class="col-xl-3 col-md-6 mb-4">
                               <div class="card border-left-secondary shadow h-100 py-2">
                                   <div class="card-body">
                                       <div class="row no-gutters align-items-center">
                                           <div class="col mr-2">
                                               <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Nama Perusahaan</div>
                                               <div class="h6 mb-0 font-weight-bold text-gray-800"><?php echo $data["perusahaan"]["nama_perusahaan"] ?></div>
                                           </div>
                                           <div class="col-auto">
                                               <i class="fas fa-building fa-2x text-gray-500"></i>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="text-center">
                                       <a href="<?php echo BASEURL ?>pengaturan_nama" class="text-secondary small"><i class="fas fa-search"></i> Lihat Nama Perusahaan</a>
                                   </div>
                               </div>

                           </div>
                       <?php } ?>
                   </div>

               </div>
               <!-- /.container-fluid -->