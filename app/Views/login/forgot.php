<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Project CI4 | Forgot Password</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('theme/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('theme/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('theme/dist/css/adminlte.min.css') ?>">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url('theme/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?>">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url('theme/plugins/toastr/toastr.min.css') ?>">
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="../../index2.html" class="h1"><b>Code</b>Igniter</a>
            </div>
            <div class="card-body">
                <?php if (session()->has('error')) : ?>
                    <p class="login-box-msg text-danger"><?php echo session()->getFlashdata('error'); ?></p>
                <?php else : ?>
                    <p class="login-box-msg">Esqueceu sua senha? Digite seu e-mail e enviaremos as instruções de como reseta sua senha!</p>
                <?php endif; ?>

                <form action="<?php echo url_to('forgot.store') ?>" method="post">
                    <?php echo csrf_field() ?>
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Solicitar Nova Senha</button>
                        </div>
                    </div>
                </form>
                <div class="d-flex justify-content-between mt-4">
                    <a href="/login">Login</a>
                    <a href="/register">Register</a>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?= base_url('theme/plugins/jquery/jquery.min.js') ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('theme/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('theme/dist/js/adminlte.min.js') ?>"></script>
    <!-- SweetAlert2 -->
    <script src="<?= base_url('theme/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
    <!-- Toastr -->
    <script src="<?= base_url('theme/plugins/toastr/toastr.min.js') ?>"></script>

    <?php if (session()->has('forgot_not_sent')) : ?>
        <script>
            $(function() {
                toastr.error('<?php echo session()->getFlashdata('forgot_not_sent'); ?>');
            });
        </script>
    <?php endif; ?>

    <?php if (session()->has('forgot_sent')) : ?>
        <script>
            $(function() {
                toastr.success('<?php echo session()->getFlashdata('forgot_sent'); ?>');
            });
        </script>
    <?php endif; ?>

    <?php if (session()->has('token_not_found')) : ?>
        <script>
            $(function() {
                toastr.error('<?php echo session()->getFlashdata('token_not_found'); ?>');
            });
        </script>
    <?php endif; ?>

    <?php if (session()->has('updated')) : ?>
        <script>
            $(function() {
                toastr.success('<?php echo session()->getFlashdata('updated'); ?>');
            });
        </script>
    <?php endif; ?>

    <?php if (session()->has('not_updated')) : ?>
        <script>
            $(function() {
                toastr.error('<?php echo session()->getFlashdata('not_updated'); ?>');
            });
        </script>
    <?php endif; ?>

    <?php if (session()->has('messageThrottle')) : ?>
        <script>
            $(function() {
                toastr.error('<?php echo session()->getFlashdata('messageThrottle'); ?>');
            });
        </script>
    <?php endif; ?>

</body>
</html>
