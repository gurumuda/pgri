<style>
    .det {
        background-color: aliceblue !important;
    }
</style>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Cetak Kartu Anggota</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cetak Kartu</li>
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
        <div class="col-md-12">
            <form action="<?= base_url('index.php/admin/cetakKartuTerpilih'); ?>" method="post">
                <div class="card">
                    <div class="card-body">
                        <button type="submit" target="_blank" class="btn btn-primary">Cetak Kartu Terpilih</button>
                        <a href="" target="_blank" class="btn btn-success">Cetak Semua Kartu</a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Data Anggota PGRI Kecamatan Jorong</h5>

                        <div class="table-responsive mt-4">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th># <input type="checkbox" name="mastercheck" id="mastercheck"></th>
                                        <th>Nama</th>
                                        <th>Instansi</th>
                                        <th>Status Data</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($members as $member) : ?>
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="check" name="krt<?= $member->id; ?>" id="krt<?= $member->id; ?>" value="<?= $member->id; ?>">
                                            </td>
                                            <td><?= $member->name; ?></td>
                                            <td><?= $member->instansi; ?></td>
                                            <td nowrap>
                                                <span <?= ($member->bidang != '' ? 'class="badge badge-success"' : 'class="badge badge-danger"'); ?>>Profile</span>
                                                <span <?= ($member->photo != '' ? 'class="badge badge-success"' : 'class="badge badge-danger"'); ?>>Foto</span>
                                                <span <?= ($member->ttd_json != '' ? 'class="badge badge-success"' : 'class="badge badge-danger"'); ?>>Td Tangan</span>
                                            </td>
                                            <td nowrap>
                                                <button type="button" id="tombol-hapus-member" data-id="<?= $member->id; ?>" class="btn badge badge-danger" data-toggle="modal" data-target="#Modal2">Hapus</button>
                                                <a id="tombol-ubah-member" data-id="<?= $member->id; ?>" class="btn badge badge-warning" href="<?= base_url('index.php/admin/edit_member/') . urlencode($this->encrypt->encode($member->id)); ?>">Ubah</a>
                                                <a id="tombol-reset-password" class="btn badge badge-primary" href="<?= base_url('index.php/admin/reset_password/') . urlencode($this->encrypt->encode($member->id)); ?>" onclick="return confirm ('Password akan direset?')">Reset</a>
                                                <button type="button" id="tombol-detail-member" data-id="<?= $member->id; ?>" class="btn badge badge-info" data-toggle="modal" data-target="#Modal1">Detail</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </form>

        </div>
        <!-- row -->

        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->

    <div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Anggota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="row mb-1">
                                <label class="col-md-4">Email</label>
                                <div class="col-md-8">
                                    <input type="text" id="tampil_email" class="form-control det" readonly>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label class="col-md-4">No. Pokok Anggota</label>
                                <div class="col-md-8">
                                    <input type="text" id="tampil_npa" class="form-control det" readonly>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label class="col-md-4">Nama Lengkap</label>
                                <div class="col-md-8">
                                    <input type="text" id="tampil_nama" class="form-control det" readonly>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label class="col-md-4">Jenis Kelamin</label>
                                <div class="col-md-8">
                                    <input type="text" id="tampil_jk" class="form-control det" readonly>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label class="col-md-4">Tempat / Tanggal Lahir</label>
                                <div class="col-md-8">
                                    <input type="text" id="tampil_lahir" class="form-control det" readonly>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label class="col-md-4">Nomor KTP</label>
                                <div class="col-md-8">
                                    <input type="text" id="tampil_noKtp" class="form-control det" readonly>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label class="col-md-4">Agama</label>
                                <div class="col-md-8">
                                    <input type="text" id="tampil_agama" class="form-control det" readonly>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label class="col-md-4">Alamat</label>
                                <div class="col-md-8">
                                    <textarea id="tampil_address" rows="2" class="form-control det" readonly></textarea>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label class="col-md-4">Kode POS</label>
                                <div class="col-md-8">
                                    <input type="text" id="tampil_kodePos" class="form-control det" readonly>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label class="col-md-4">Nomor HP</label>
                                <div class="col-md-8">
                                    <input type="text" id="tampil_noHP" class="form-control det" readonly>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label class="col-md-4">Jjazah Terakhir</label>
                                <div class="col-md-8">
                                    <input type="text" id="tampil_ijazah" class="form-control det" readonly>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label class="col-md-4">Nama Instansi</label>
                                <div class="col-md-8">
                                    <input type="text" id="tampil_instansi" class="form-control det" readonly>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label class="col-md-4">Jabatan</label>
                                <div class="col-md-8">
                                    <input type="text" id="tampil_jabatan" class="form-control det" readonly>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label class="col-md-4">Status Pegawai</label>
                                <div class="col-md-8">
                                    <input type="text" id="tampil_status" class="form-control det" readonly>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label class="col-md-4">Golongan</label>
                                <div class="col-md-8">
                                    <input type="text" id="tampil_golongan" class="form-control det" readonly>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label class="col-md-4">Tingkat Instansi</label>
                                <div class="col-md-8">
                                    <input type="text" id="tampil_tingkat_instansi" class="form-control det" readonly>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label class="col-md-4">Status Instansi</label>
                                <div class="col-md-8">
                                    <input type="text" id="tampil_status_instansi" class="form-control det" readonly>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label class="col-md-4">Bidang Studi</label>
                                <div class="col-md-8">
                                    <input type="text" id="tampil_bidang" class="form-control det" readonly>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    Pas Foto
                                </div>
                                <div class="card-body">
                                    <img src="" alt="Foto Anggota" id="tampil_photo" width="100%">
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    Tanda Tangan
                                </div>
                                <div class="card-body">
                                    <img src="" alt="Tanda tangan" id="tampil_ttd" width="100%">
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <a class="btn btn-info" href="" id="waMe" target="_blank"> Kirim WA</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-warning">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('index.php/admin/hapus_member'); ?>" method="post" id="form-konfirm-hapus-member">
                    <input type="hidden" name="id-hapus-member">
                    <div class="modal-body">
                        <input type="text" name="key" class="form-control" placeholder="" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>