    <nav class="navbar header-navbar pcoded-header">
        <div class="navbar-wrapper">
            <div class="navbar-logo">
                <a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
                    <i class="feather icon-toggle-right"></i>
                </a>
                <a href="<?= admin_url() ?>">
                    <?= $this->session->userdata('role') ?>
                </a>
                <a class="mobile-options waves-effect waves-light">
                    <i class="feather icon-more-horizontal"></i>
                </a>
            </div>
            <div class="navbar-container container-fluid">
                <ul class="nav-left">
                    <li>
                        <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                            <i class="full-screen feather icon-maximize"></i>
                        </a>
                    </li>
                </ul>
                <ul class="nav-right">
                    <!-- begin:: profil navbar -->
                    <li class="user-profile header-notification">
                        <div class="dropdown-primary dropdown">
                            <div class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?= (get_users_detail($this->session->userdata('id'))->foto !== null ? upload_url('gambar') . '' . get_users_detail($this->session->userdata('id'))->foto : "//placehold.co/150") ?>" class="img-radius" alt="User-Profile-Image">
                                <span><?= get_users_detail($this->session->userdata('id'))->nama ?></span>
                                <i class="feather icon-chevron-down"></i>
                            </div>
                            <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                <li>
                                    <a href="<?= admin_url() ?>profil">
                                        <i class="feather icon-user"></i> Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= logout_url() ?>">
                                        <i class="feather icon-log-out"></i> Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- end:: profil navbar -->
                </ul>
            </div>
        </div>
    </nav>