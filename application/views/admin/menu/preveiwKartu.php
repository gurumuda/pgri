<style>
    * {
        box-sizing: border-box;
    }

    .row {
        margin-left: -5px;
        margin-right: -5px;
    }

    .column {
        float: left;
        width: 50%;
        padding: 5px;
    }

    /* Clearfix (clear floats) */
    .row::after {
        content: "";
        clear: both;
        display: table;
    }

    table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 1px solid #ddd;
        height: 5.6cm;

    }

    .kop1 {
        font-weight: bolder !important;
        padding: 0 !important;
        margin: 0 !important;
        height: 10pt !important;
    }

    .kop2 {
        font-weight: bold;
        padding: 0 !important;
        margin: 0 !important;
        height: 10pt;
    }

    .identitas {
        font-size: 5pt;
        height: 10px;
    }

    /* th,
    td {
        text-align: left;
        padding: 16px;
    } */

    /* tr:nth-child(even) {
        background-color: #f2f2f2;
    } */
</style>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Preview Kartu Anggota</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Preview Kartu</li>
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

            <div class="card">
                <div class="card-body">
                    <button type="submit" target="_blank" class="btn btn-primary">Cetak Kartu</button>
                </div>
                <div class="card-body">

                    <?php foreach ($members as $member) : ?>
                        <div class="column">
                            <table border="all">
                                <tr>
                                    <td rowspan="2" class="p-2">
                                        <img width="50px" src="<?= base_url('assets/images'); ?>/logo/pgri.png" alt="">
                                    </td>
                                    <td colspan="4" class="text-center kop1">
                                        PGRI
                                    </td>

                                </tr>
                                <tr>
                                    <td colspan="4" class="text-center kop2">
                                        KARTU TANDA ANGGOTA
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 50px" rowspan="6">
                                        <img width="50px" src="<?= base_url('assets/images/photo/24b01a1b8328dd3fc06a6830ee5cdd24.jpg'); ?>" alt="">
                                    </td>
                                    <td class="identitas" style="padding-left:8px; width: 130px;vertical-align: top;">Nomor Pokok Anggota</td>
                                    <td class="identitas" style="width:5px;vertical-align: top;">:</td>
                                    <td class="identitas" style="padding-left:12px;vertical-align: top;"></td>
                                </tr>
                                <tr>
                                    <td class="identitas" style="padding-left:8px; width: 130px;vertical-align: top;">Nama</td>
                                    <td class="identitas" style="width:5px;vertical-align: top;">:</td>
                                    <td class="identitas" style="padding-left:12px;vertical-align: top;"><?= $member->name; ?></td>
                                </tr>
                                <tr>
                                    <td class="identitas" style="padding-left:8px; width: 130px;vertical-align: top;">Tempat / Tanggal lahir</td>
                                    <td class="identitas" style="width:5px;vertical-align: top;">:</td>
                                    <td class="identitas" style="padding-left:12px;vertical-align: top;"><?= $member->tmp_lahir; ?> / <?= $member->tgl . ' ' . $member->bln . ' ' . $member->thn; ?></td>
                                </tr>
                                <tr>
                                    <td class="identitas" style="padding-left:8px; width: 130px;vertical-align: top;">Agama</td>
                                    <td class="identitas" style="width:5px;vertical-align: top;">:</td>
                                    <td class="identitas" style="padding-left:12px;vertical-align: top;"><?= agama($member->agama); ?></td>
                                </tr>
                                <tr>
                                    <td class="identitas" style="padding-left:8px; width: 130px;vertical-align: top;">Alamat</td>
                                    <td class="identitas" style="width:5px;vertical-align: top;">:</td>
                                    <td class="identitas" style="padding-left:12px;vertical-align: top;"><?= $member->address; ?></td>
                                </tr>
                                <tr>
                                    <td class="identitas" style="padding-left:8px; width: 130px;vertical-align: top;">Berlaku Sampai</td>
                                    <td class="identitas" style="width:5px;vertical-align: top;">:</td>
                                    <td class="identitas" style="padding-left:12px;vertical-align: top;"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="identitas">Jorong, 10 Mei 2022</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="identitas">Jorong, 10 Mei 2022</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="identitas">Jorong, 10 Mei 2022</td>
                                </tr>


                            </table>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>


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