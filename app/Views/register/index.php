<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Project CI4 | Register Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('theme/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('theme/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('theme/dist/css/adminlte.min.css') ?>">
</head>
<body class="hold-transition register-page">
  <!-- /.alert-box-error-register -->
  <?php if(session()->has('errorEmailExists') || session()->has('errorFieldsEmpty')):  ?>
    <div class="row">
        <div class="col-12">
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php if (session()->has('errorEmailExists')) : ?>
                  <h5><i class="icon fas fa-info"></i> Erro ao cadastrar!</h5>
                  Já existe um usuário cadastrado com o e-mail fornecido!
                <?php elseif (session()->has('errorFieldsEmpty')) : ?>
                  <h5><i class="icon fas fa-info"></i> Erro ao cadastrar!</h5>
                  Por favor preencha todos os campos!
                <?php endif; ?>
            </div>
        </div>
    </div>
  <?php  endif; ?>
  <!-- /.alert-box-error-register -->
  <div class="register-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><b>Code</b>Igniter</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Cadastro de Novo Usuário</p>

        <form action="/register/autenticar" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="fullname" placeholder="Nome Completo" name="fullname" value="<?= old('fullname') ?>">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <span class="text text-danger mb-3"><?php echo session()->getFlashdata('errors')['fullname'] ?? '' ?></span>
          </div>
          <div class="input-group mb-3">
            <input type="email" class="form-control" id="email" placeholder="E-mail" name="email" value="<?= old('email') ?>">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <span class="text text-danger mb-3"><?php echo session()->getFlashdata('errors')['email'] ?? '' ?></span>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" id="password" placeholder="Senha" name="password" value="<?= old('password') ?>">
            <div class="input-group-append">
              <button class="input-group-text" type="button" id="togglePassword">
                <i class="fa fa-eye"></i>
              </button>
            </div>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <span class="text text-danger mb-3"><?php echo session()->getFlashdata('errors')['password'] ?? '' ?></span>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" id="retryPassword" placeholder="Confirmar Senha" name="retryPassword" value="<?= old('retryPassword') ?>">
            <div class="input-group-append">
              <button class="input-group-text" type="button" id="toggleRetryPassword">
                <i class="fa fa-eye"></i>
              </button>
            </div>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <span class="text text-danger mb-3"><?php echo session()->getFlashdata('errors')['retryPassword'] ?? '' ?></span>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-12 mb-4">
              <button type="submit" class="btn btn-primary btn-block" id="btnCadastro">Register</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <div class="card mb-3" id="passwordRequirements">
          <div class="card card-outline p-2">
            <ul class="">
              <li class="">
                <div class="">
                  <span class="">Sua senha deve conter:</span>
                  <ul class="">
                      <li class="mb-1 mt-1" data-error-code="password-policy-length-at-least">
                        <span class="">Pelo menos 12 caracteres de extensão</span>
                      </li>
                      <li class="mb-1" data-error-code="password-policy-length-at-least">
                        <span class="">Pelo menos um número</span>
                      </li>
                      <li class="" data-error-code="password-policy-length-at-least">
                        <span class="">Pelo menos um caracter especial</span>
                      </li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
        </div>

        <a href="/login" class="text-center">Já possuo uma conta</a>
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
  <!-- /.register-box -->

  <!-- jQuery -->
  <script src="<?= base_url('theme/plugins/jquery/jquery.min.js') ?>"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('theme/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('theme/dist/js/adminlte.min.js') ?>"></script>

  <script>
    $(document).ready(function () {
      // Esconder inicialmente a div de requisitos de senha
      $('#passwordRequirements').hide();

      // Monitorar eventos de clique no botão de olho
      $('#togglePassword').on('click', function () {
        var passwordInput = $('#password');

        // Alternar a visibilidade da senha
        if (passwordInput.attr('type') === 'password') {
          passwordInput.attr('type', 'text');
        } else {
          passwordInput.attr('type', 'password');
        }
      });

      $('#toggleRetryPassword').on('click', function () {
        var retryPasswordInput = $('#retryPassword');

        // Alternar a visibilidade da senha
        if (retryPasswordInput.attr('type') === 'password') {
          retryPasswordInput.attr('type', 'text');
        } else {
          retryPasswordInput.attr('type', 'password');
        }
      });

      // Monitorar eventos de digitação no campo de senha
      $('#password').on('input', function () {
        var password = $(this).val();

        // Verificar se os requisitos são atendidos
        var lengthRequirement = password.length >= 12;
        var numberRequirement = /\d/.test(password);
        var specialCharRequirement = /[!@#$%^&*(),.?":{}|<>]/.test(password);

        // Atualizar a visibilidade da div de requisitos de senha
        if (lengthRequirement && numberRequirement && specialCharRequirement) {
          $('#passwordRequirements').hide();
        } else {
          $('#passwordRequirements').show();
        }
      });
    });
  </script>

</body>
</html>
