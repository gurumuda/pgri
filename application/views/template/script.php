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
<script src="<?= base_url('assets/template'); ?>/assets/libs/jquery-steps/build/jquery.steps.min.js"></script>
<script src="<?= base_url('assets/template'); ?>/assets/libs/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?= base_url('assets/template'); ?>/assets/libs/toastr/build/toastr.min.js"></script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
<script src="<?= base_url('assets/signature'); ?>/numeric-1.2.6.min.js"></script>
<script src="<?= base_url('assets/signature'); ?>/bezier.js"></script>
<script src="<?= base_url('assets/signature'); ?>/jquery.signaturepad.js"></script>

<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/signatur-pad/js/signature-pad.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>


<?php if ($this->uri->segment(2) == 'profile') : ?>
    <script>
        const canvas = document.getElementById("the_canvas");
        const saveButton = document.getElementById("save2");
        const clearButton = document.getElementById("myclear");

        signaturePad = new SignaturePad(canvas);

        signaturePad.fromDataURL('<?= $member->ttd_json; ?>')

        clearButton.addEventListener("click", function(event) {
            signaturePad.clear();
        });
        saveButton.addEventListener("click", function(event) {

            if (signaturePad.isEmpty()) {
                // $('#myModal').modal('show');

            } else {

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/dashboard/tandatangan",
                    dataType: 'json',
                    data: {
                        'image': signaturePad.toDataURL(),
                        'rowno': $('#rowno').val()
                    },
                    success: function(datas1) {
                        // signaturePad.clear();
                        location.reload();
                    }
                });
            }
        });
    </script>
<?php endif; ?>

<script>
    $(document).ready(function() {
        $('.sigPad').signaturePad({
            drawOnly: true,
            drawBezierCurves: true,
            variableStrokeWidth: true,
            lineTop: 200,
            bgColour: '#f2f2f2'
        });
    });
</script>

<?php if ($this->uri->segment(2) == 'profile') : ?>
    <script>
        var sig = <?= $member->ttd_json ?>

        $(document).ready(function() {
            $('.sigPad').signaturePad({
                displayOnly: true
            }).regenerate(sig);
        });
    </script>
<?php endif; ?>


<?php if ($this->uri->segment(2) == 'register') : ?>
    <script>
        // Basic Example with form
        var form = $("#example-form");
        form.validate({
            errorPlacement: function errorPlacement(error, element) {
                element.before(error);
            },
            rules: {
                password: {
                    minlength: 6
                },
                confirm: {
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true
                },
                address: {
                    required: true
                }
            },
            messages: {
                email: {
                    required: 'Email tidak boleh kosong',
                    email: 'Email harus diisi email yang valid',
                },
                password: {
                    required: 'Password tidak boleh kosong',
                    minlength: 'Password minimal 6 karakter'
                },
                confirm: {
                    required: 'Konfirmasi password tidak boleh kosong',
                    equalTo: 'Konfirmasi tidak cocok dengan text password'
                },
                name: {
                    required: 'Nama lengkap tidak boleh kosong'
                },
                noHP: {
                    required: 'Nomor HP tidak boleh kosong'
                },
                address: {
                    required: 'Alamat tidak boleh kosong'
                }
            }
        });
        form.children("div").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slideLeft",
            onStepChanging: function(event, currentIndex, newIndex) {
                // Allways allow previous action even if the current form is not valid!
                if (currentIndex > newIndex) {
                    return true;
                }
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            onFinishing: function(event, currentIndex) {
                form.validate().settings.ignore = ":disabled";
                return form.valid();
            },
            onFinished: function(event, currentIndex) {
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;
                const name = document.getElementById('name').value;
                const gelar = document.getElementById('gelar').value;
                const noHP = document.getElementById('noHP').value;
                const address = document.getElementById('address').value;
                const instansi = document.getElementById('instansi').value;

                $.ajax({
                    url: '<?= base_url("index.php/auth/process_register") ?>',
                    type: 'post',
                    data: {
                        email,
                        password,
                        name,
                        gelar,
                        noHP,
                        address,
                        instansi
                    },
                    success: function(data) {
                        toastr.options.closeButton = true;

                        if (data == 1) {
                            toastr.success('Registrasi berhasil', 'Data berhasil disimpan', {
                                timeOut: 5000
                            });
                            window.location.href = "<?= base_url('index.php/dashboard/profile'); ?>"
                        }
                        if (data == 2) {
                            toastr.warning('Registrasi gagal', 'Email sudah terdaftar !', {
                                timeOut: 10000
                            });
                        }
                        if (data == 0) {
                            toastr.error('Registrasi gagal', 'Terjadi kesalahan sistem !', {
                                timeOut: 10000
                            });
                        }

                    },
                    error: function(error) {
                        console.log(error)
                    }
                })
            }
        });
    </script>
<?php endif; ?>
<?php if ($this->session->flashdata('pesan')) : ?>
    <script>
        toastr.<?= $this->session->flashdata('tipe') ?>('', '<?= $this->session->flashdata("pesan"); ?>', {
            timeOut: 5000
        });
    </script>
<?php endif; ?>
</body>

</html>