<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Profile Anggota</h4>
            <div class="ml-auto">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
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
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Personal Info</h4>

                </div>
                <form class="form-horizontal" action="<?= base_url('index.php/dashboard/edit_profile'); ?>" method="post">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="npa" class="col-sm-3 control-label col-form-label">No. Pokok Anggota (NPA)</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="npa" id="npa" placeholder="Jika memiliki NPA" value="<?= $member->npa; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kartu" class="col-sm-3 control-label col-form-label">Kepemilikan Kartu Anggota </label>
                            <div class="col-sm-9">
                                <select name="kartu" id="kartu" class="form-control" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="01" <?= ($member->kartu == '01' ? 'selected' : ''); ?>>Belum Memiliki</option>
                                    <option value="02" <?= ($member->kartu == '02' ? 'selected' : ''); ?>>Memiliki (Masa berlaku habis)</option>
                                    <option value="03" <?= ($member->kartu == '03' ? 'selected' : ''); ?>>Memiliki Kartu Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 control-label col-form-label">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" id="name" placeholder="Nama Lengkap" value="<?= $member->name; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jk" class="col-sm-3 control-label col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-9">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="customControlValidation1" <?= ($member->jk == '01' ? 'checked' : ''); ?> value="01" name="jk" required>
                                    <label class="custom-control-label" for="customControlValidation1">Laki-laki</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="customControlValidation2" <?= ($member->jk == '02' ? 'checked' : ''); ?> value="02" name="jk" required>
                                    <label class="custom-control-label" for="customControlValidation2">Perempuan</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tmp_lahir" class="col-sm-3 control-label col-form-label">Tempat Lahir</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="tmp_lahir" id="tmp_lahir" placeholder="Tempat Lahir" value="<?= $member->tmp_lahir; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email1" class="col-sm-3 control-label col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-9">
                                <table>
                                    <tr>
                                        <td>
                                            <select name="tgl" id="tgl" class="form-control" required>
                                                <option value="">-- Tgl --</option>
                                                <?php for ($i = 1; $i < 32; $i++) : ?>
                                                    <option value="<?= $i; ?>" <?= ($member->tgl == $i) ? 'selected' : ''; ?>><?= $i; ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="bln" id="bln" class="form-control" required>
                                                <option value="">-- Bulan --</option>
                                                <option value="01" <?= ($member->bln == '01' ? 'selected' : ''); ?>>Januari</option>
                                                <option value="02" <?= ($member->bln == '02' ? 'selected' : ''); ?>>Februari</option>
                                                <option value="03" <?= ($member->bln == '03' ? 'selected' : ''); ?>>Maret</option>
                                                <option value="04" <?= ($member->bln == '04' ? 'selected' : ''); ?>>April</option>
                                                <option value="05" <?= ($member->bln == '05' ? 'selected' : ''); ?>>Mei</option>
                                                <option value="06" <?= ($member->bln == '06' ? 'selected' : ''); ?>>Juni</option>
                                                <option value="07" <?= ($member->bln == '07' ? 'selected' : ''); ?>>Juli</option>
                                                <option value="08" <?= ($member->bln == '08' ? 'selected' : ''); ?>>Agustus</option>
                                                <option value="09" <?= ($member->bln == '09' ? 'selected' : ''); ?>>September</option>
                                                <option value="10" <?= ($member->bln == '10' ? 'selected' : ''); ?>>Oktober</option>
                                                <option value="11" <?= ($member->bln == '11' ? 'selected' : ''); ?>>November</option>
                                                <option value="12" <?= ($member->bln == '12' ? 'selected' : ''); ?>>Desember</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="thn" id="thn" class="form-control" placeholder="Tahun" value="<?= $member->thn; ?>" required>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="noKtp" class="col-sm-3 control-label col-form-label">Nomor KTP</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="noKtp" id="noKtp" placeholder="Nomor KTP" value="<?= $member->noKtp; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="agama" class="col-sm-3 control-label col-form-label">Agama</label>
                            <div class="col-sm-9">
                                <select name="agama" id="agama" class="form-control" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="01" <?= ($member->agama == '01' ? 'selected' : ''); ?>>Islam</option>
                                    <option value="02" <?= ($member->agama == '02' ? 'selected' : ''); ?>>Kristen</option>
                                    <option value="03" <?= ($member->agama == '03' ? 'selected' : ''); ?>>Katholik</option>
                                    <option value="04" <?= ($member->agama == '04' ? 'selected' : ''); ?>>Hindu</option>
                                    <option value="05" <?= ($member->agama == '05' ? 'selected' : ''); ?>>S-1/D-4</option>
                                    <option value="06" <?= ($member->agama == '06' ? 'selected' : ''); ?>>Khong Huchu</option>
                                    <option value="07" <?= ($member->agama == '07' ? 'selected' : ''); ?>>Kepercayaan Tuhan YME</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-3 control-label col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <textarea name="address" id="address" class="form-control" rows="2" placeholder="Alamat lengkap sesuai KTP" required><?= $member->address; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kodePos" class="col-sm-3 control-label col-form-label">Kode Pos</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="kodePos" id="kodePos" placeholder="Kode Pos" value="<?= $member->kodePos; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="noHP" class="col-sm-3 control-label col-form-label">Nomor HP</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="noHP" id="noHP" placeholder="Nomor HP" value="<?= $member->noHP; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ijazah" class="col-sm-3 control-label col-form-label">Ijazah Terakhir</label>
                            <div class="col-sm-9">
                                <select name="ijazah" id="ijazah" class="form-control" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="01" <?= ($member->ijazah == '01' ? 'selected' : ''); ?>>SMA</option>
                                    <option value="02" <?= ($member->ijazah == '02' ? 'selected' : ''); ?>>D-1</option>
                                    <option value="03" <?= ($member->ijazah == '03' ? 'selected' : ''); ?>>D-2</option>
                                    <option value="04" <?= ($member->ijazah == '04' ? 'selected' : ''); ?>>D-3</option>
                                    <option value="05" <?= ($member->ijazah == '05' ? 'selected' : ''); ?>>S-1/D-4</option>
                                    <option value="06" <?= ($member->ijazah == '06' ? 'selected' : ''); ?>>S-2</option>
                                    <option value="07" <?= ($member->ijazah == '07' ? 'selected' : ''); ?>>S-3</option>
                                    <option value="08" <?= ($member->ijazah == '08' ? 'selected' : ''); ?>>Tidak diketahui</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="instansi" class="col-sm-3 control-label col-form-label">Nama Instansi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="instansi" id="instansi" placeholder="Instansi" value="<?= $member->instansi; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jabatan" class="col-sm-3 control-label col-form-label">Jabatan di Instansi</label>
                            <div class="col-sm-9">
                                <select name="jabatan" id="jabatan" class="form-control" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="01" <?= ($member->jabatan == '01' ? 'selected' : ''); ?>>Kepala Sekolah</option>
                                    <option value="02" <?= ($member->jabatan == '02' ? 'selected' : ''); ?>>Wakil Kelapa Sekolah</option>
                                    <option value="03" <?= ($member->jabatan == '03' ? 'selected' : ''); ?>>Kepala TU</option>
                                    <option value="04" <?= ($member->jabatan == '04' ? 'selected' : ''); ?>>Guru</option>
                                    <option value="05" <?= ($member->jabatan == '05' ? 'selected' : ''); ?>>Staf TU</option>
                                    <option value="06" <?= ($member->jabatan == '06' ? 'selected' : ''); ?>>Bendahara</option>
                                    <option value="07" <?= ($member->jabatan == '07' ? 'selected' : ''); ?>>Laboran</option>
                                    <option value="08" <?= ($member->jabatan == '08' ? 'selected' : ''); ?>>Pustakawan</option>
                                    <option value="09" <?= ($member->jabatan == '09' ? 'selected' : ''); ?>>Pengawas Sekolah</option>
                                    <option value="10" <?= ($member->jabatan == '10' ? 'selected' : ''); ?>>Pesuruh/Penjaga Sekolah</option>
                                    <option value="11" <?= ($member->jabatan == '11' ? 'selected' : ''); ?>>Juru Bengkel</option>
                                    <option value="12" <?= ($member->jabatan == '12' ? 'selected' : ''); ?>>Petugas Instalasi</option>
                                    <option value="13" <?= ($member->jabatan == '13' ? 'selected' : ''); ?>>Tutor Keaksaraan</option>
                                    <option value="14" <?= ($member->jabatan == '14' ? 'selected' : ''); ?>>Pamong Belajar</option>
                                    <option value="15" <?= ($member->jabatan == '15' ? 'selected' : ''); ?>>TLD</option>
                                    <option value="16" <?= ($member->jabatan == '16' ? 'selected' : ''); ?>>Pengelola PKBM</option>
                                    <option value="17" <?= ($member->jabatan == '17' ? 'selected' : ''); ?>>Pendidik PAUD</option>
                                    <option value="18" <?= ($member->jabatan == '18' ? 'selected' : ''); ?>>Penilik</option>
                                    <option value="19" <?= ($member->jabatan == '19' ? 'selected' : ''); ?>>Insuktur Kursus</option>
                                    <option value="20" <?= ($member->jabatan == '20' ? 'selected' : ''); ?>>Tutor Paket A</option>
                                    <option value="21" <?= ($member->jabatan == '21' ? 'selected' : ''); ?>>Tutor Paket B</option>
                                    <option value="22" <?= ($member->jabatan == '22' ? 'selected' : ''); ?>>Tutor Paket C</option>
                                    <option value="23" <?= ($member->jabatan == '23' ? 'selected' : ''); ?>>Pegewai Dinas Pendidikan</option>
                                    <option value="24" <?= ($member->jabatan == '24' ? 'selected' : ''); ?>>Dosen</option>
                                    <option value="25" <?= ($member->jabatan == '25' ? 'selected' : ''); ?>>Pensiunan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email1" class="col-sm-3 control-label col-form-label">Tanggal Mulai Tugas</label>
                            <div class="col-sm-9">
                                <table>
                                    <tr>
                                        <td>
                                            <select name="tgl_mulai" id="tgl_mulai" class="form-control">
                                                <option value="">-- Tgl --</option>
                                                <?php for ($i = 1; $i < 32; $i++) : ?>
                                                    <option value="<?= $i; ?>" <?= ($member->tgl_mulai == $i) ? 'selected' : ''; ?>><?= $i; ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="bln_mulai" id="bln_mulai" class="form-control">
                                                <option value="">-- Bulan --</option>
                                                <option value="01" <?= ($member->bln_mulai == '01' ? 'selected' : ''); ?>>Januari</option>
                                                <option value="02" <?= ($member->bln_mulai == '02' ? 'selected' : ''); ?>>Februari</option>
                                                <option value="03" <?= ($member->bln_mulai == '03' ? 'selected' : ''); ?>>Maret</option>
                                                <option value="04" <?= ($member->bln_mulai == '04' ? 'selected' : ''); ?>>April</option>
                                                <option value="05" <?= ($member->bln_mulai == '05' ? 'selected' : ''); ?>>Mei</option>
                                                <option value="06" <?= ($member->bln_mulai == '06' ? 'selected' : ''); ?>>Juni</option>
                                                <option value="07" <?= ($member->bln_mulai == '07' ? 'selected' : ''); ?>>Juli</option>
                                                <option value="08" <?= ($member->bln_mulai == '08' ? 'selected' : ''); ?>>Agustus</option>
                                                <option value="09" <?= ($member->bln_mulai == '09' ? 'selected' : ''); ?>>September</option>
                                                <option value="10" <?= ($member->bln_mulai == '10' ? 'selected' : ''); ?>>Oktober</option>
                                                <option value="11" <?= ($member->bln_mulai == '11' ? 'selected' : ''); ?>>November</option>
                                                <option value="12" <?= ($member->bln_mulai == '12' ? 'selected' : ''); ?>>Desember</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="thn_mulai" id="thn_mulai" class="form-control" placeholder="Tahun" value="<?= $member->thn_mulai; ?>" required>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-sm-3 control-label col-form-label">Status Kepegawaian</label>
                            <div class="col-sm-9">
                                <select name="status" id="status" class="form-control">
                                    <option value="">-- Pilih --</option>
                                    <option value="01" <?= ($member->status == '01' ? 'selected' : ''); ?>>Non PNS</option>
                                    <option value="02" <?= ($member->status == '02' ? 'selected' : ''); ?>>PNS</option>
                                    <option value="03" <?= ($member->status == '03' ? 'selected' : ''); ?>>CPNS</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="golongan" class="col-sm-3 control-label col-form-label">Golongan </label>
                            <div class="col-sm-9">
                                <select name="golongan" id="golongan" class="form-control">
                                    <option value="">-- Pilih --</option>
                                    <option value="01" <?= ($member->golongan == '01' ? 'selected' : ''); ?>>II/a</option>
                                    <option value="02" <?= ($member->golongan == '02' ? 'selected' : ''); ?>>II/b</option>
                                    <option value="03" <?= ($member->golongan == '03' ? 'selected' : ''); ?>>II/c</option>
                                    <option value="04" <?= ($member->golongan == '04' ? 'selected' : ''); ?>>II/d</option>
                                    <option value="05" <?= ($member->golongan == '05' ? 'selected' : ''); ?>>III/a</option>
                                    <option value="06" <?= ($member->golongan == '06' ? 'selected' : ''); ?>>III/b</option>
                                    <option value="07" <?= ($member->golongan == '07' ? 'selected' : ''); ?>>III/c</option>
                                    <option value="08" <?= ($member->golongan == '08' ? 'selected' : ''); ?>>III/d</option>
                                    <option value="09" <?= ($member->golongan == '09' ? 'selected' : ''); ?>>IV/a</option>
                                    <option value="10" <?= ($member->golongan == '10' ? 'selected' : ''); ?>>IV/b</option>
                                    <option value="11" <?= ($member->golongan == '11' ? 'selected' : ''); ?>>IV/c</option>
                                    <option value="12" <?= ($member->golongan == '12' ? 'selected' : ''); ?>>IV/d</option>
                                    <option value="13" <?= ($member->golongan == '13' ? 'selected' : ''); ?>>IV/e</option>
                                    <option value="14" <?= ($member->golongan == '14' ? 'selected' : ''); ?>>Non PNS</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tingkat_instansi" class="col-sm-3 control-label col-form-label">Tingkat Instansi </label>
                            <div class="col-sm-9">
                                <select name="tingkat_instansi" id="tingkat_instansi" class="form-control">
                                    <option value="">-- Pilih --</option>
                                    <option value="01" <?= ($member->tingkat_instansi == '01' ? 'selected' : ''); ?>>TK</option>
                                    <option value="02" <?= ($member->tingkat_instansi == '02' ? 'selected' : ''); ?>>SD</option>
                                    <option value="03" <?= ($member->tingkat_instansi == '03' ? 'selected' : ''); ?>>SMP</option>
                                    <option value="04" <?= ($member->tingkat_instansi == '04' ? 'selected' : ''); ?>>SMA/SMK</option>
                                    <option value="05" <?= ($member->tingkat_instansi == '05' ? 'selected' : ''); ?>>D-1</option>
                                    <option value="06" <?= ($member->tingkat_instansi == '06' ? 'selected' : ''); ?>>D-2</option>
                                    <option value="07" <?= ($member->tingkat_instansi == '07' ? 'selected' : ''); ?>>D-3</option>
                                    <option value="08" <?= ($member->tingkat_instansi == '08' ? 'selected' : ''); ?>>S-1/D-4</option>
                                    <option value="09" <?= ($member->tingkat_instansi == '09' ? 'selected' : ''); ?>>S-2</option>
                                    <option value="10" <?= ($member->tingkat_instansi == '10' ? 'selected' : ''); ?>>S-3</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status_instansi" class="col-sm-3 control-label col-form-label">Status Instansi</label>
                            <div class="col-sm-9">
                                <select name="status_instansi" id="status_instansi" class="form-control">
                                    <option value="">-- Pilih --</option>
                                    <option value="01" <?= ($member->status_instansi == '01' ? 'selected' : ''); ?>>Negeri</option>
                                    <option value="02" <?= ($member->status_instansi == '02' ? 'selected' : ''); ?>>Swasta</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bidang" class="col-sm-3 control-label col-form-label">Mengajar / Bidang Studi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="bidang" id="bidang" placeholder="Bidang Studi" value="<?= $member->bidang; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pas Foto</h4>
                </div>
                <?= form_open_multipart('dashboard/up_photo'); ?>
                <div class="card-body text-center">
                    <img src="<?= base_url('assets/images/photo/' . $member->photo); ?>" style="width: 3cm" alt="">
                </div>
                <div class="card-body">
                    <input type="file" name="photo" id="photo" required accept=".jpg, .jpeg, .png">
                </div>
                <div class="card-body">
                    <span class="text-info">Ukuran foto maksimal 2 MB</span>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Upload</button>
                </div>
                </form>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tanda Tangan</h4>
                </div>
                <div class="card-body">
                    <div>
                        <div>
                            <div>
                                <canvas id="the_canvas" style="width: 100%;" height="250px"></canvas>
                            </div>
                        </div>
                        <div>
                            <button type="button" id="save2" data-action="save" class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
                            <button type="button" data-action="clear" id="myclear" class="btn btn-danger"><i class="fa fa-trash-o"></i> Clear</button>

                        </div>
                    </div>
                    <input type="hidden" value="<?php echo rand(); ?>" id="rowno">
                </div>
            </div>
        </div>


    </div>
    <!-- editor -->


</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->