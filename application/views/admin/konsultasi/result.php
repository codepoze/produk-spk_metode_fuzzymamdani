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
                <!-- begin:: konsultasi -->
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="w-75">Konsultasi</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <ol>
                            <?php foreach ($konsultasi as $key => $value) { ?>
                                <li>
                                    <?= $value['nama'] ?> => <?= $value['nilai'] ?>
                                </li>
                            <?php } ?>
                        </ol>
                    </div>
                </div>
                <!-- end:: konsultasi -->
                <!-- begin:: fuzzifikasi -->
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="w-75">Hasil Fuzzifikasi</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <?php foreach ($fuzzifikasi as $key => $value) { ?>
                            <h6>Nilai Fuzzi <?= $kriteria[$key] ?></h6>

                            <ol>
                                <?php foreach ($value as $k => $v) { ?>
                                    <li><?= $k ?>&nbsp;=>&nbsp;<?= $v ?></li>
                                <?php } ?>
                            </ol>
                        <?php } ?>
                    </div>
                </div>
                <!-- end:: fuzzifikasi -->
                <!-- begin:: rules -->
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="w-75">Rules</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <ol>
                            <?php foreach ($rules as $key => $value) { ?>
                                <li>
                                    <?= $value ?>
                                </li>
                            <?php } ?>
                        </ol>
                    </div>
                </div>
                <!-- end:: rules -->
                <!-- begin:: inferensi -->
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="w-75">Inferensi</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <ol>
                            <?php foreach ($hasil_inferensi as $key => $value) { ?>
                                <li>
                                    <?= $value['hasil'] ?>
                                </li>
                            <?php } ?>
                        </ol>
                    </div>
                </div>
                <!-- end:: inferensi -->
                <!-- begin:: nilai_z -->
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="w-75">Nilai Z</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <ol>
                            <?php
                            $t = 1;
                            foreach ($nilai_z as $key => $value) { ?>
                                <li>
                                    t<?= $t++ ?> => <?= $value ?>
                                </li>
                            <?php } ?>
                        </ol>
                    </div>
                </div>
                <!-- end:: nilai_z -->
                <!-- begin:: momen & luas -->
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="w-75">Momen & Luas</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <ol>
                            <?php
                            $m = 1;
                            foreach ($momen as $key => $value) { ?>
                                <li>
                                    m<?= $m++ ?> => <?= $value ?>
                                </li>
                            <?php } ?>
                        </ol>
                        <hr>
                        <ol>
                            <?php
                            $a = 1;
                            foreach ($luas as $key => $value) { ?>
                                <li>
                                    a<?= $a++ ?> => <?= $value ?>
                                </li>
                            <?php } ?>
                        </ol>
                    </div>
                </div>
                <!-- end:: momen & luas -->
                <!-- begin:: defuzzikasi -->
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="w-75">Defuzzifikasi</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <p>Hasil Defuzzifikasi</p>
                        <p><b><?= $defuzzifikasi ?></b></p>
                        <hr>
                        <p>Kesimpulan</p>
                        <p><?= $kesimpulan ?></p>
                    </div>
                </div>
                <!-- end:: defuzzikasi -->
            </div>
        </div>
    </div>
</div>
<!-- end:: content -->