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
            <input type="text" class="form-control" id="fullname" placeholder="Nome Completo" name="fullname">
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
            <input type="email" class="form-control" id="email" placeholder="E-mail" name="email">
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
            <input type="password" class="form-control" id="password" placeholder="Senha" name="password">
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
            <input type="password" class="form-control" id="retryPassword" placeholder="Confirmar Senha" name="retryPassword">
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

        <!-- <div class="social-auth-links text-center">
          <a href="#" class="btn btn-block btn-primary">
            <i class="fab fa-facebook mr-2"></i>
            Sign up using Facebook
          </a>
          <a href="#" class="btn btn-block btn-danger">
            <i class="fab fa-google-plus mr-2"></i>
            Sign up using Google+
          </a>
        </div> -->

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

  <!-- <script>
    $(document).ready(function() {
      // Desabilita o botão de cadastro inicialmente
      $('#btnCadastro').prop('disabled', true).addClass('btn-secondary');

      // Função para verificar se o formulário está válido
      function validarFormulario() {
        var fullname = $('#fullname').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var retryPassword = $('#retryPassword').val();

        // Verifica as condições para habilitar o botão de cadastro
        if (
          fullname.length > 1 &&
          validarEmail(email) &&
          validarSenha(password) &&
          retryPassword === password
        ) {
          $('#btnCadastro').prop('disabled', false).removeClass('btn-secondary');
        } else {
          $('#btnCadastro').prop('disabled', true).addClass('btn-secondary');
        }
      }

      // Função para validar o formato do e-mail
      function validarEmail(email) {
        var regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regexEmail.test(email);
      }

      // Função para validar a password
      function validarSenha(password) {
        // Pelo menos uma letra maiúscula, uma minúsculas, um número,
        // um caracter especial e mais de 6 caracteres
        var regexSenha = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{6,}$/;
        return regexSenha.test(password);
      }

      // Adiciona eventos de input nos campos para chamar a função de validação
      $('#fullname, #email, #password, #retryPassword').on('input', function() {
        validarFormulario();
      });
    });
  </script> -->
</body>
</html>
