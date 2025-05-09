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
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="w-75 p-2"><?= $title ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-block table-border-style">
                        <form id="form-consultation" action="<?= admin_url() ?>konsultasi/process" method="POST">
                            <input type="hidden" id="<?= $this->security->get_csrf_token_name() ?>" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />

                            <?php foreach ($kriteria as $key => $row) { ?>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"><?= $row->nama ?> *</label>
                                    <div class="col-sm-9">
                                        <input type="hidden" name="id_kriteria[]" id="id_kriteria" value="<?= $row->id_kriteria ?>" />
                                        <input type="text" class="form-control" name="value[]" id="value" placeholder="Masukkan <?= $row->nama ?>" />
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="row">
                                <div class="col-sm-3">
                                </div>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary btn-sm waves-effect" id="btn-process"><i class="fa fa-spinner"></i>&nbsp;Proses</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end:: content -->