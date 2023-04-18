<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Dashboard</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Informasi Jumlah Anggota Terdaftar</h3>

                    <div class="row mt-5">
                        <div class="col-12">
                            <table class="table table-hover" id="zero_config">
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama Instansi</th>
                                        <th>Jumlah Anggota</th>
                                        <th>Jumlah Warga Keseluruhan</th>
                                        <th>Persentase</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($members as $member) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $member->instansi; ?></td>
                                            <td><?= $member->jumlah; ?> orang</td>
                                            <td>#</td>
                                            <td>#</td>
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->