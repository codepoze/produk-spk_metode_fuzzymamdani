<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Sistem Pendukung Keputusan" />
    <meta name="keywords" content="Sistem Pendukung Keputusan" />
    <meta name="author" content="Sistem Pendukung Keputusan" />

    <title>Sistem Pendukung Keputusan< - <?= $title ?> | <?= ucfirst($this->session->userdata('role')) ?></title>

            <!-- begin:: icon -->
            <link rel="apple-touch-icon" href="<?= assets_url() ?>admin/images/icon/apple-touch-icon.png" sizes="180x180" />
            <link rel="icon" href="<?= assets_url() ?>admin/images/icon/favicon-32x32.png" type="image/x-icon" sizes="32x32" />
            <link rel="icon" href="<?= assets_url() ?>admin/images/icon/favicon-16x16.png" type="image/x-icon" sizes="16x16" />
            <link rel="icon" href="<?= assets_url() ?>admin/images/icon/favicon.ico" type="image/x-icon" />
            <link rel="shortcut icon" href="<?= assets_url() ?>admin/images/icon/favicon.ico" type="image/x-icon">
            <!-- end:: icon -->

            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" />
            <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>admin/css/font-awesome.min.css">
            <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>admin/icon/icofont/css/icofont.css">
            <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>admin/bootstrap/css/bootstrap.min.css" />
            <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>admin/pages/waves/css/waves.min.css" media="all" />
            <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>admin/icon/feather/css/feather.css" />
            <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>admin/css/style.css" />
            <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>admin/css/widget.css" />

            <!-- begin:: css local -->
            <?php empty($css) ? '' : $this->load->view($css); ?>
            <!-- end:: css local -->

            <script type="text/javascript" src="<?= assets_url() ?>admin/jquery/js/jquery.min.js"></script>
</head>

<body>
    <div class="loader-bg">
        <div class="loader-bar"></div>
    </div>

    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <!-- begin:: navbar -->
            <?php $this->load->view('admin/layouts/navbar'); ?>
            <!-- end:: navbar -->

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <!-- begin:: sidebar -->
                    <?php $this->load->view('admin/layouts/sidebar'); ?>
                    <!-- end:: sidebar -->

                    <!-- begin:: content -->
                    <div class="pcoded-content">
                        <?php $this->load->view($content); ?>
                    </div>
                    <!-- end:: content -->
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="<?= assets_url() ?>admin/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/popper.js/js/popper.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/pages/waves/js/waves.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/jquery-slimscroll/js/jquery.slimscroll.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/js/pcoded.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/js/vertical/vertical-layout.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/js/script.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/sweetalert/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/js/custom.js"></script>

    <script>
        let csrf = $('#<?= $this->security->get_csrf_token_name() ?>');
    </script>

    <!-- begin:: js local -->
    <?php empty($js) ? '' : $this->load->view($js); ?>
    <!-- end:: js local -->
</body>

</html>