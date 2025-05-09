<!-- begin:: breadcumb -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h4 class="m-b-10"><?= $title ?></h4>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html">
                            <i class="feather icon-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#!">Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- end:: breadcumb -->

<!-- begin:: content -->
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- begin:: tab header -->
                        <div class="tab-header card">
                            <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist" id="mytab">
                                <li class="nav-item">
                                    <a class="nav-link active show" data-toggle="tab" href="#foto" role="tab" aria-selected="true">Foto</a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#akun" role="tab" aria-selected="false">Akun</a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#keamanan" role="tab" aria-selected="false">Keamanan</a>
                                    <div class="slide"></div>
                                </li>
                            </ul>
                        </div>
                        <!-- end:: tab header -->
                        <!-- begin:: tab content -->
                        <div class="tab-content">
                            <!-- begin:: foto -->
                            <div class="tab-pane active show" id="foto" role="tabpanel">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-header-text">Foto</h5>
                                    </div>
                                    <div class="card-block">
                                        <form id="form-foto" action="<?= admin_url() ?>profil/upd_foto" method="POST">
                                            <input type="hidden" id="<?= $this->security->get_csrf_token_name() ?>_foto" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />

                                            <div class="row">
                                                <div class="col-lg-6 align-self-center">
                                                    <input type="file" name="inpfotoprofil" id="inpfotoprofil">
                                                </div>
                                                <div class="col-lg-6">
                                                    <img src="<?= ($data->foto !== null) ? upload_url('gambar') . '' . $data->foto : "//placehold.co/150" ?>" class="img-fluid mx-auto d-block" id="lihat-gambar" alt="Profil" width="200" />
                                                    <br>
                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light" id="save-foto"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end:: foto -->
                            <!-- begin:: akun -->
                            <div class="tab-pane" id="akun" role="tabpanel">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-header-text">Akun</h5>
                                    </div>
                                    <div class="card-block">
                                        <form id="form-akun" action="<?= admin_url() ?>profil/upd_akun" method="POST">
                                            <input type="hidden" id="<?= $this->security->get_csrf_token_name() ?>_foto" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Nama *</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="inpnama" id="inpnama" value="<?= $data->nama ?>" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">E-mail *</label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" name="inpemail" id="inpemail" value="<?= $data->email ?>" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Username *</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="inpusername" id="inpusername" value="<?= $data->username ?>" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label"></label>
                                                <div class="col-sm-10">
                                                    <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light" id="save-akun"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end:: akun -->
                            <!-- begin:: keamanan -->
                            <div class="tab-pane" id="keamanan" role="tabpanel">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-header-text">Keamanan</h5>
                                    </div>
                                    <div class="card-block">
                                        <form id="form-keamanan" action="<?= admin_url() ?>profil/upd_keamanan" method="POST">
                                            <input type="hidden" id="<?= $this->security->get_csrf_token_name() ?>_foto" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Password Lama *</label>
                                                <div class="col-sm-10">
                                                    <input type="password" class="form-control" name="inppasswordlama" id="inppasswordlama" placeholder="Masukkan password lama" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Password Baru *</label>
                                                <div class="col-sm-10">
                                                    <input type="password" class="form-control" name="inppasswordbaru" id="inppasswordbaru" placeholder="Masukkan password baru" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Ulangi Password Baru *</label>
                                                <div class="col-sm-10">
                                                    <input type="password" class="form-control" name="inpkonfirmasipassword" id="inpkonfirmasipassword" placeholder="Konfirmasi password baru" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label"></label>
                                                <div class="col-sm-10">
                                                    <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light" id="save-keamanan"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end:: keamanan -->
                        </div>
                        <!-- end:: tab content -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end:: content -->