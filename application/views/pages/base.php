<!DOCTYPE html>
<html lang="en">

<head>
    <title>Selamat Datang | Metode Fuzzy Mamdani</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Selamat Datang di Sistem Pendukung Keputusan Fuzzy Mamdani" />
    <meta name="keywords" content="Selamat Datang di Sistem Pendukung Keputusan Fuzzy Mamdani" />
    <meta name="author" content="Selamat Datang di Sistem Pendukung Keputusan Fuzzy Mamdani" />

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">

    <!-- begin:: icon -->
    <link rel="apple-touch-icon" href="<?= assets_url() ?>admin/images/icon/apple-touch-icon.png" sizes="180x180" />
    <link rel="icon" href="<?= assets_url() ?>admin/images/icon/favicon-32x32.png" type="image/x-icon" sizes="32x32" />
    <link rel="icon" href="<?= assets_url() ?>admin/images/icon/favicon-16x16.png" type="image/x-icon" sizes="16x16" />
    <link rel="icon" href="<?= assets_url() ?>admin/images/icon/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="<?= assets_url() ?>admin/images/icon/favicon.ico" type="image/x-icon">
    <!-- end:: icon -->

    <!-- begin:: global assets -->
    <link rel="stylesheet" href="<?= assets_url() ?>page/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= assets_url() ?>page/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= assets_url() ?>page/css/style.css">
    <!-- end:: global assets -->
</head>

<body>
    <!-- begin:: navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Metode Fuzzy Mamdani</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url() ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url() ?>about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= login_url() ?>">Masuk</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- end:: navbar -->

    <!-- begin:: header -->
    <header class="intro-header">
        <div class="container">
            <div class="intro-message">
                <h1>Metode Fuzzy Mamdani</h1>
                <h3>Sistem Pendukung Keputusan</h3>
                <hr class="intro-divider">
            </div>
        </div>
    </header>
    <!-- end:: header -->

    <!-- begin:: content -->
    <?php $this->load->view($content); ?>
    <!-- end:: content -->

    <!-- begin:: footer -->
    <footer>
        <div class="container">
            <ul class="list-inline">
                <li class="list-inline-item">
                    <a href="<?= site_url() ?>">Home</a>
                </li>
                <li class="footer-menu-divider list-inline-item">&sdot;</li>
                <li class="list-inline-item">
                    <a href="<?= site_url() ?>about">About</a>
                </li>
                <li class="footer-menu-divider list-inline-item">&sdot;</li>
                <li class="list-inline-item">
                    <a href="<?= login_url() ?>">Masuk</a>
                </li>
            </ul>
            <p class="copyright text-muted small"></p>
        </div>
    </footer>
    <!-- end:: footer -->

    <script src="<?= assets_url() ?>page/vendor/jquery/jquery.min.js"></script>
    <script src="<?= assets_url() ?>page/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= assets_url() ?>admin/js/custom.js"></script>
</body>

</html>