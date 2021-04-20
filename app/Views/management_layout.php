<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MMO Manager - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url('css/my-styles.css')?>" rel="stylesheet" type="text/css">

    <link href="<?php echo base_url('admin-theme/vendor/fontawesome-free/css/all.min.css')?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('admin-theme/css/sb-admin-2.css')?>" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?= $this->include('layout\sidebar') ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?= $this->include('layout\topbar') ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                <?php if (isset($_SESSION['errors'])): ?>
                    <?php foreach($_SESSION['errors'] as $error): ?>
                        <div class="alert alert-danger" role="alert"><?=$error?></div>
                    <?php endforeach; ?>
                <?php endif;?>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?= esc($pageName) ?></h1>
                        
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Export CSV to</a> -->
                    </div>

                    <?= $this->renderSection('content') ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?= $this->include('layout\footer') ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?= $this->include('layout\logout_modal') ?>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url('admin-theme/vendor/jquery/jquery.min.js')?>"></script>
    <script src="<?php echo base_url('admin-theme/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url('admin-theme/vendor/jquery-easing/jquery.easing.min.js')?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url('admin-theme/js/sb-admin-2.min.js')?>"></script>

    <!-- Page level plugins -->
    <script src="<?php echo base_url('admin-theme/vendor/chart.js/Chart.min.js')?>"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo base_url('admin-theme/js/demo/chart-area-demo.js')?>"></script>
    <!-- <script src="<?php //echo base_url('admin-theme/js/demo/chart-pie-demo.js')?>"></script> -->

    <script src="<?php echo base_url('js/ajax.js')?>"></script>

    <?php if (isset($jsList) && !empty($jsList)):?>
        <?php foreach ($jsList as $js): ?>
            <script src="<?php echo base_url($js)?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>

</body>

</html>