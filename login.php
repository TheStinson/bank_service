<?PHP require_once("./include/membersite_config.php");
  if(isset($_POST['submitted'])) {
    if($fgmembersite->Login()) {
        $fgmembersite->RedirectToURL("index.php");
    }
  }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Barclays Bank | NetBanking Portal</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css" >
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/plugins/iCheck/square/blue.css">
    <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/dist/css/skins/_all-skins.min.css">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="index.html"><b>Barclays </b>NetBanking</a>
      </div>
      <!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to your netbanking account</p>
          <?php if(null != $fgmembersite->GetErrorMessage()){ ?>
            <div class="alert alert-danger alert-dismissible fade in">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Error!</strong> <?php echo $fgmembersite->GetErrorMessage(); ?>
            </div>
          <?php } ?>
  
          <?php if(isset($_GET['logout']) && $_GET['logout']=="true" && $fgmembersite->CheckLogin()){ $fgmembersite->LogOut(); ?>
            <div class="alert alert-success alert-dismissible fade in">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Logged out!</strong> You've logged out succesfully!
            </div>
          <?php } ?>
    
          <form id='login' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
              <input type='hidden' name='submitted' id='submitted' value='1'/>
              <div class="form-group has-feedback">
                  <input class="form-control" placeholder="Username" type='text' name='username' id='username' value='<?php echo $fgmembersite->SafeDisplay('username') ?>' maxlength="50" required="required">
              </div>
              <div class="form-group has-feedback">
                  <input type="password" class="form-control" placeholder="Password" name='password' id='password' maxlength="50" required="required">
              </div>
              <div class="row">
                <div class="col-xs-8">
                  <div class="checkbox icheck">
                    <label>
                      <input type="checkbox"> Remember Me
                    </label>
                  </div>
                </div>
                <div class="col-xs-4">
                  <button type="submit" class="btn btn-primary btn-block btn-flat" name='Submit' value='Submit'>Sign In</button>
                </div>
              </div>
          </form>
          <a href="register.php" class="text-center">Create a new account</a>
        </div>
      </div>

      <!-- jQuery 3 -->
      <script src="https://adminlte.io/themes/AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
      <!-- Bootstrap 3.3.7 -->
      <script src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
      <!-- iCheck -->
      <script src="https://adminlte.io/themes/AdminLTE/plugins/iCheck/icheck.min.js"></script>
      <script>
        $(function () {
          $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
          });
        });
      </script>
  </body>
</html>