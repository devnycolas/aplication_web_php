<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Project CI4 | Login Page</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('theme/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('theme/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('theme/dist/css/adminlte.min.css') ?>">
</head>

<body class="hold-transition login-page">
    <!-- /.alert-box-error-login if(isset($_GET['alert']) && $_GET['alert'] == "errorLogin") -->
    <?php if(session()->has('errorUserNotFound')):  ?>
        <div class="row">
            <div class="col-12">
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-info"></i> Usuário não encontrado!</h5>
                    Ocorreu um problema ao fazer login. Verifique seu e-mail e senha ou crie uma conta.
                </div>
            </div>
        </div>
    <?php  endif; ?>
    <!-- /.alert-box-error-login -->
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="../../index2.html" class="h1"><b>Code</b> Igniter</a>
            </div>
            <div class="card-body">
                <?php if (session()->has('errors')) : ?>
                    <p class="login-box-msg text-danger">Acesso Negado! Informe os dados corretamente.</p>
                <?php else : ?>
                    <p class="login-box-msg">Acesse sua conta para continuar</p>
                <?php endif; ?>

                <form action="/login/autenticar" method="post">
                    <div class="input-group mb-2">
                        <input type="email" class="form-control" placeholder="Digite seu e-mail" name="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <span class="text text-danger mb-3"><?php echo session()->getFlashdata('errors')['email'] ?? '' ?></span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Digite sua senha" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <span class="text text-danger mb-3"><?php echo session()->getFlashdata('errors')['password'] ?? '' ?></span>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">ACESSE SUA CONTA</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <div class="row mt-2 mb-3">
                    <div class="col-12">
                        <a href="/register" class="btn btn-primary btn-block">CADASTRAR</a>
                    </div>
                    <!-- /.col -->
                </div>
                <a href="/forgot/password" class="text-center">Esqueci minha senha</a>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url('theme/plugins/jquery/jquery.min.js') ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('theme/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('theme/dist/js/adminlte.min.js') ?>"></script>
</body>

</html>