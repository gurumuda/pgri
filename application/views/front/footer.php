<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright © 2021 SEO Dream Co., Ltd. All Rights Reserved.

                    <br>Web Designed by <a rel="nofollow" href="https://templatemo.com" title="free CSS templates">TemplateMo</a>
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="<?= base_url('assets/template/front'); ?>/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/template/front'); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/template/front'); ?>/assets/js/owl-carousel.js"></script>
<script src="<?= base_url('assets/template/front'); ?>/assets/js/animation.js"></script>
<script src="<?= base_url('assets/template/front'); ?>/assets/js/imagesloaded.js"></script>
<script src="<?= base_url('assets/template/front'); ?>/assets/js/custom.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php if ($this->session->flashdata('pesan')) : ?>
    <script>
        $(document).ready(function() {
            Swal.fire({
                text: '<?= $this->session->flashdata('pesan'); ?>',
                icon: '<?= $this->session->flashdata('tipe'); ?>',
                confirmButtonText: 'Ok'
            })
        });
    </script>
<?php endif; ?>
</body>

</html>