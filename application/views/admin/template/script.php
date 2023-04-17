<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->
<footer class="footer text-center">
    All Rights Reserved by Matrix-admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
</footer>
<!-- ============================================================== -->
<!-- End footer -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="<?= base_url('assets/template'); ?>/assets/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="<?= base_url('assets/template'); ?>/assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="<?= base_url('assets/template'); ?>/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="<?= base_url('assets/template'); ?>/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="<?= base_url('assets/template'); ?>/assets/extra-libs/sparkline/sparkline.js"></script>
<!--Wave Effects -->
<script src="<?= base_url('assets/template'); ?>/dist/js/waves.js"></script>
<!--Menu sidebar -->
<script src="<?= base_url('assets/template'); ?>/dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="<?= base_url('assets/template'); ?>/dist/js/custom.min.js"></script>
<!-- this page js -->

<script src="<?= base_url('assets/template'); ?>/assets/libs/toastr/build/toastr.min.js"></script>

<script src="<?= base_url('assets/template'); ?>/assets/extra-libs/DataTables/datatables.min.js"></script>

<script>
    $('#zero_config').DataTable({
        stateSave: true,
    });
</script>

<script>
    var table = $('#zero_config').DataTable();

    $('.dataTables_filter input').unbind().bind('keyup', function() {
        var searchTerm = this.value.toLowerCase(),
            regex = '\\b' + searchTerm + '\\b';
        table.rows().search(regex, true, false).draw();
    })
</script>

<script>
    $(document).ready(function() {
        $("#zero_config").on("click", "#tombol-hapus-member", function() {
            const id = $(this).data("id");
            $("#form-konfirm-hapus-member [name='id-hapus-member']").val(id);
        })
    });
</script>

<script>
    $(document).ready(function() {
        $("#zero_config").on("click", "#tombol-detail-member", function() {
            const id = $(this).data("id");
            $.ajax({
                url: '<?= base_url(); ?>index.php/admin/get_detail_member',
                type: 'post',
                dataType: 'json',
                data: {
                    id
                },
                success: function(data) {
                    console.log(data);
                    if (data['tmp_lahir'] != '') {
                        lahir = data['tmp_lahir'] + ' / ' + data['tgl'] + ' - ' + data['bln'] + ' - ' + data['thn'];
                    } else {
                        lahir = '';
                    }
                    photo = '<?= base_url(); ?>assets/images/photo/thumb/' + data['photo'];
                    ttd = '<?= base_url(); ?>assets/sign/' + data['ttd'];
                    $('#tampil_nama').val(data['nama']);
                    $('#tampil_npa').val(data['npa']);
                    $('#tampil_email').val(data['email']);
                    $('#tampil_jk').val(data['jk']);
                    $('#tampil_lahir').val(lahir);
                    $('#tampil_noKtp').val(data['noKtp']);
                    $('#tampil_agama').val(data['agama']);
                    $('#tampil_address').val(data['address']);
                    $('#tampil_kodePos').val(data['kodePos']);
                    $('#tampil_noHP').val(data['noHP']);
                    $('#tampil_ijazah').val(data['ijazah']);
                    $('#tampil_instansi').val(data['instansi']);
                    $('#tampil_jabatan').val(data['jabatan']);
                    $('#tampil_status').val(data['status']);
                    $('#tampil_golongan').val(data['golongan']);
                    $('#tampil_tingkat_instansi').val(data['tingkat_instansi']);
                    $('#tampil_status_instansi').val(data['status_instansi']);
                    $('#tampil_bidang').val(data['bidang']);
                    $('#tampil_photo').attr("src", photo);
                    $('#tampil_ttd').attr("src", ttd);
                    $('#waMe').attr("href", 'https://wa.me/62' + data['noHP']);


                },
                error: function(e) {
                    console.log(e)
                }
            })
        })
    });
</script>

<?php if ($this->session->flashdata('pesan')) : ?>
    <script>
        toastr.<?= $this->session->flashdata('tipe') ?>('', '<?= $this->session->flashdata("pesan"); ?>', {
            timeOut: 5000
        });
    </script>
<?php endif; ?>

<script>
    $("#mastercheck").click(function() {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>
</body>

</html>