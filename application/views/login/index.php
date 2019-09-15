<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $data["title"] ?></title>

    <!-- Custom fontawesome 5 -->
    <link href="<?php echo BASEURL ?>assets/plugin/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="<?php echo BASEURL ?>assets/plugin/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="<?php echo BASEURL ?>assets/plugin/fontawesome/css/solid.min.css" rel="stylesheet">

    <!-- Favicon -->
    <link href="<?php echo BASEURL ?>assets/img/favicon.ico" rel="icon">

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo BASEURL ?>assets/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        body {
            background-image: url('<?php echo BASEURL ?>assets/img/login-background.jpg');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-lg-6 col-md-9 mt-5">
                <!-- Card -->
                <div class="card bg-light mb-3 my-4 o-hidden border-0 shadow-lg" style="border-radius:50px">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="card-body">
                            <h1 class="h2 text-gray-900 mb-2 text-center">Selamat Datang!</h1>
                            <!-- Pesan -->
                            <div id="pesan">
                                <?php
                                if (isset($_GET["url"])) {
                                    ?>
                                    <div class="alert bg-success text-white alert-dismissible fade show" role="alert">
                                        <i class="fa fa-check-circle"></i> <?php echo $_GET["url"] ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <noscript>
                                <div class="alert bg-gradient-info text-white font-weight-bold">
                                    Mohon maaf,<strong>JavaScript</strong> anda tidak aktif,
                                    mohon diaktifkan untuk bisa mengakses web ini.terima kasih
                                </div>
                            </noscript>
                            <p class="small text-center">masukan username dan password</p>

                            <!-- Form -->
                            <form class="user" id="formlogin">
                                <div class="form-group">
                                    <input type="text" name="username" id="username" class="form-control form-control-user" placeholder="Username" value="<?php if (isset($_COOKIE["username"])) {
                                                                                                                                                                echo $_COOKIE["username"];
                                                                                                                                                            } ?>">
                                    <div id="usernameError"></div>
                                </div>

                                <div class="form-group">
                                    <input type="password" name="password" id="password" class="form-control form-control-user" placeholder="Password" autocomplete="on" value="<?php if (isset($_COOKIE["password"])) {
                                                                                                                                                                                    echo $_COOKIE["password"];
                                                                                                                                                                                } ?>">
                                    <div id="passwordError"></div>

                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" name="remember" class="custom-control-input" id="remember"> <label class="custom-control-label" for="remember">Ingat Saya</label>
                                    </div>
                                </div>
                                <button type="button" id="masuk" class="btn btn-success btn-user btn-block">
                                    Masuk
                                </button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo BASEURL ?>assets/plugin/jquery/jquery.min.js"></script>
    <script src="<?php echo BASEURL ?>assets/plugin/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo BASEURL ?>assets/plugin/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo BASEURL ?>assets/js/sb-admin-2.min.js"></script>
    <!-- Custom JS LOGIN -->
    <script src="<?php echo BASEURL ?>assets/js/login.min.js"></script>

</body>

</html>