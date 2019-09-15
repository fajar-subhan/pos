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
            <li class="nav-item active">
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
                                    <i class="fas fa-user-cog"></i> User
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <i class="fas fa-users"></i> Data User
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
                                        <i class='fa fa-users'></i> Data User
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-2 offset-lg-4">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-success btn-sm fa-pull-right font-weight-bold mb-1" id="tomboltambahuser" data-toggle="modal" data-target="#formuser">
                                            <i class='fa fa-user-plus'></i> Tambah User
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive" id="view">
                                    <table class="table table-bordered table-hover" id="data" style="width:100%;">
                                        <thead class="small">
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">Username</th>
                                                <th class="text-center">Email</th>
                                                <th class="text-center">Jabatan</th>
                                                <th class="text-center">Tipe User</th>
                                                <th class="text-center">
                                                    <i class="fas fa-cogs"></i>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="small">
                                            <?php $no = 0;
                                            foreach ($data["data"] as $data) : $no++; ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $no ?></td>
                                                    <td><?php echo $data["nama_user"] ?></td>
                                                    <td><?php echo $data["username"] ?></td>
                                                    <td><?php echo $data["email_user"] ?></td>
                                                    <td><?php echo $data["jabatan_user"] ?></td>
                                                    <td class="text-center"><?php if ($data["tipe_user"] === "1") {
                                                                                    echo "Admin";
                                                                                } else {
                                                                                    echo "User";
                                                                                } ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <!-- Ubah Pass -->
                                                        <button id="ubahpass" title="ubah password" data-id="<?php echo $data["id_user"] ?>" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#formpassword">
                                                            <i class="fas fa-unlock-alt"></i>
                                                        </button>
                                                        <!-- Ubah User -->
                                                        <button id="ubahuser" title="ubah user" data-id="<?php echo $data["id_user"] ?>" class="btn btn-info btn-sm" data-toggle="modal" data-target="#formuser">
                                                            <i class="fas fa-user-cog"></i>
                                                        </button>
                                                        <!-- Hapus User -->
                                                        <button id="hapususer" title="hapus user" data-id="<?php echo $data["id_user"] ?>" class="btn btn-danger btn-sm">
                                                            <i class="fas fa-user-alt-slash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->


            <!-- Form modal user -->
            <!-- Modal USER -->
            <div class="modal fade" id="formuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="judul_modal">Modal title</h5>
                            <button type="button" id="closeuser" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="formdatauser">
                                <input type="hidden" name="id" id="id">
                                <div class="form-row">
                                    <!-- Nama User-->
                                    <div class="form-group col-md-6">
                                        <label for="nama_user" class="font-weight-bold">Nama <span class='text-danger'>*</span></label>
                                        <input type="text" class="form-control" name="nama_user" id="nama_user" placeholder="masukan nama lengkap" required>
                                        <div id="nama_userError"></div>
                                    </div>

                                    <!-- Email User -->
                                    <div class="form-group col-md-6">
                                        <label for="email_user" class="font-weight-bold">Email <span class='text-danger'>*</span></label>
                                        <input type="text" class="form-control" name="email_user" id="email_user" placeholder="example@domain.com" required>
                                        <div id="email_userError"></div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <!-- Jabatan User-->
                                    <div class="form-group col-md-6">
                                        <label for="jabatan_user" class="font-weight-bold">Jabatan <span class='text-danger'>*</span></label>
                                        <input type="text" class="form-control" name="jabatan_user" id="jabatan_user" placeholder="masukan posisi jabatan" required>
                                        <div id="jabatan_userError"></div>
                                    </div>

                                    <!-- Username -->
                                    <div class="form-group col-md-6">
                                        <label for="username" class="font-weight-bold">Username <span class='text-danger'>*</span></label>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="masukan username" required>
                                        <div id="username_Error"></div>
                                    </div>
                                </div>


                                <div class="form-row" id="pass">
                                    <!-- Password User-->
                                    <div class="form-group col-md-6">
                                        <label for="password" class="font-weight-bold">Password <span class='text-danger'>*</span></label>
                                        <div class="input-group mb-1">
                                            <input type="password" name="password" id="password" class="form-control" autocomplete="off" placeholder="password">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-primary" type="button" id="lihatpass">
                                                    <i class="fas fa-eye-slash"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div id="pass_Error"></div>
                                    </div>

                                    <!-- Ulang Password User-->
                                    <div class="form-group col-md-6" id="ulang">
                                        <label for="ulangpass" class="font-weight-bold">Ulangi Password <span class='text-danger'>*</span></label>
                                        <div class="input-group mb-1">
                                            <input type="password" name="ulangpass" id="ulangpass" class="form-control" autocomplete="off" placeholder="ulangi password">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-primary" type="button" id="lihatulangpass">
                                                    <i class="fas fa-eye-slash"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div id="ulangpassError"></div>

                                    </div>
                                </div>

                                <!-- tipe user -->
                                <div class="form-group">
                                    <label for="tipe_user" class="font-weight-bold">Tipe User <span class='text-danger'>*</span></label>
                                    <select name="tipe_user" id="tipe_user" class="form-control">
                                        <option value="">-- Pilih Tipe User --</option>
                                        <option value="1">Admin</option>
                                        <option value="2">User</option>
                                    </select>
                                    <div id="tipe_userError"></div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <!-- loading  -->
                            <div id="loading">
                                Sedang Proses.........
                                <img src="<?php echo BASEURL ?>assets/img/loading.gif">
                            </div>

                            <button type="button" id="tutupuser" class="btn btn-secondary" data-dismiss="modal">Close</button>

                            <!-- Ubah User -->
                            <button type="button" id="ubahdatauser" class="btn btn-info">Ubah</button>
                            <!-- Tambah User -->
                            <button type="button" id="tambah" class="btn btn-success">Tambah</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Form Password -->
            <div class="modal fade" id="formpassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="judul_modalpass">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closepass">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="formpass">
                                <input type="hidden" name="id" id="idpass">
                                <div class="form-row">
                                    <!-- Username -->
                                    <div class="form-group col-lg-12">
                                        <label for="username" class="font-weight-bold">Username </label>
                                        <input type="text" class="form-control" name="usernamefix" id="usernamelamafix" readonly>
                                        <div id="username_Error"></div>
                                    </div>

                                </div>

                                <div class="form-row">
                                    <!-- Password User baru-->
                                    <div class="form-group col-md-6">
                                        <label for="password" class="font-weight-bold">Password Baru <span class='text-danger'>*</span></label>
                                        <div class="input-group mb-1">
                                            <input type="password" name="passwordbaru" id="passwordbaru" class="form-control" autocomplete="off" placeholder="password">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-primary" type="button" id="lihatpassbaru">
                                                    <i class="fas fa-eye-slash"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div id="pass_ErrorBaru"></div>
                                    </div>

                                    <!-- Ulangi Password User Baru-->
                                    <div class="form-group col-md-6">
                                        <label for="password" class="font-weight-bold">Ulangi Password Baru <span class='text-danger'>*</span></label>
                                        <div class="input-group mb-1">
                                            <input type="password" name="ulangpassword" id="ulangpasswordbaru" class="form-control" autocomplete="off" placeholder="password">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-primary" type="button" id="lihatulangpassbaru">
                                                    <i class="fas fa-eye-slash"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div id="ulangpass_ErrorBaru"></div>
                                    </div>
                                </div>


                            </form>
                        </div>
                        <div class="modal-footer">
                            <!-- loading  -->
                            <div id="loadingpass">
                                Sedang Proses.........
                                <img src="<?php echo BASEURL ?>assets/img/loading.gif">
                            </div>
                            <button type="button" class="btn btn-secondary" id="tutuppassword" data-dismiss="modal">Tutup</button>
                            <button type="button" class="btn btn-primary" id="ubahpassword">Ubah</button>
                        </div>
                    </div>
                </div>
            </div>