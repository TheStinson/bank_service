<?PHP require_once("./include/membersite_config.php");
  if($fgmembersite->CheckLogin())
  {
        //API Url
        $url = 'https://barclaysbotnode-thestinson.c9users.io/account/detailsViaEmail/'.$fgmembersite->UserEmail();
         
        //Initiate cURL.
        $ch = curl_init();
         
        //Tell cURL that we want to send a POST request.
        curl_setopt($ch, CURLOPT_URL, $url);
        
        //Tell Curl to not post anything on screen 
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
         
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
         
        //Execute the request
        $result = curl_exec($ch);
        
        //Encode the array into JSON.
        $jsonResponse = json_decode($result, true);
  }
  else{
      $fgmembersite->RedirectToURL("login.php");
      exit;
  }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Barclays Bank | Customer Dashboard</title>
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
  <body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
      <header class="main-header">
        <nav class="navbar navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <img src="http://1000logos.net/wp-content/uploads/2016/10/Barclays-Premier-League-symbol-500x281.jpg" class="img-circle" alt="Barclays Logo" style="width: 61px; height: 45px;float: left;margin: 4px;">
              <a href="index.php" class="navbar-brand"><b>Barclays Bank</b> NetBanking</a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
              </button>
            </div>

            <!-- /.navbar-collapse -->
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
              <ul class="nav navbar-nav">
                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                  <!-- Menu Toggle Button -->
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <!-- The user image in the navbar-->
                    <img src="https://adminlte.io/themes/AdminLTE/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                    <span class="hidden-xs"><?= $fgmembersite->UserFullName(); ?></span>
                  </a>
                  <ul class="dropdown-menu">
                    <!-- The user image in the menu -->
                    <li class="user-header">
                      <img src="https://adminlte.io/themes/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
    
                      <p>
                        <?= $fgmembersite->UserFullName(); ?>
                      </p>
                    </li>
    
                    <!-- Menu Footer-->
                    <li class="user-footer">
                      <div class="pull-right">
                        <a href="login.php?logout=true" class="btn btn-default btn-flat">Sign out</a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
            <!-- /.navbar-custom-menu -->
          </div>
          <!-- /.container-fluid -->
        </nav>
      </header>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              Customer Summary
            </h1>
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li><a href="#">Customer</a></li>
              <li class="active">Summary</li>
            </ol>
          </section>
    
          <!-- Main content -->
          <section class="content" style="height:450px;">
            <div class="box box-default" style="height: 100%;">
              <div class="box-body" style="width:30%;float: left;">
                 <h3 class="box-title">Account Details</h3>
                 <table class="table table-condensed table-bordered" >
                   <tr>
                     <th>Account Number </th> <td id="accountId"><?php echo $jsonResponse['account_id'] ?></td>
                   </tr>
                   <tr>
                     <th>Account Balance</th>
                     <td><?php echo $jsonResponse['account_balance'] ?></td>
                  </tr>
                  <tr>
                     <th>Branch Name</th>
                     <td><?php echo $jsonResponse['branch']['name'];?></td>
                  </tr>
                  <tr>
                     <th>IFSC Code</th>
                     <td><?php echo $jsonResponse['branch']['IFSC_code'];?></td>
                  </tr>
                 </table>
              </div>
              <div class="box-body" style="width: 59%; float: right; max-height: 80%; overflow-y: auto;">
                 <h3 class="box-title">Recent Transactions</h3>
                 <table class="table table-striped table-condensed table-bordered"  >
                   <tr>
                     <th>Transaction Id</th>
                     <th>Category</th>
                     <th>Date</th>
                     <th>Amount</th>
                   </tr>
                   <?php 
                      foreach ($jsonResponse['transactions'] as $curr) {
                        echo '<tr>'.
                                '<td>'.$curr['transaction_id'].'</td>'.
                                '<td>'.$curr['category'].'</td>'.
                                '<td>'.$curr['transaction_date'].'</td>'.
                                '<td>'.$curr['transaction_amount'].'</td>'.
                              '</tr>';
                      }
                   ?>
                 </table>
              </div>
              <!-- /.box-body -->
            </div>
          </section>
          <div class="callout callout-info" style="margin:15px;">
            <h4>Social Account Linking</h4>
            <?php if($jsonResponse['ASID'] != null) { ?>
            <p>You've already linked your social account with BarclaysBot</p>
            <?php  } else { ?>
            <p>Please click Login with facebook to link your Social Account with BarclaysBot</p>
            <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
            </fb:login-button>
    
            <div id="fb-root"></div>
    
            <?php } ?>
            <div id="status"></div>
          </div>
          <!-- /.content -->
        </div>
        <!-- /.container -->
      </div>
      <!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="container">
          <div class="pull-right hidden-xs">
            <b>Version</b> 1.0.0
          </div>
          <strong>Copyright &copy; 2018 <a href="#">Team Illuminati</a>.</strong> All rights
          reserved.
        </div>
        <!-- /.container -->
      </footer>
    </div>
    <!-- ./wrapper -->
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.11&appId=1921785617833318';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    
     function statusChangeCallback(response) {
        console.log('statusChangeCallback');
        console.log(response);
        // The response object is returned with a status field that lets the
        // app know the current login status of the person.
        // Full docs on the response object can be found in the documentation
        // for FB.getLoginStatus().
        if (response.status === 'connected') {
          // Logged into your app and Facebook.
          testAPI();
        } else {
          // The person is not logged into your app or we are unable to tell.
          document.getElementById('status').innerHTML = 'Please log ' +
            'into this app.';
        }
      }
    
       FB.getLoginStatus(function(response) {
          statusChangeCallback(response);
        });
    
      // This function is called when someone finishes with the Login
      // Button.  See the onlogin handler attached to it in the sample
      // code below.
      function checkLoginState() {
        FB.getLoginStatus(function(response) {
          statusChangeCallback(response);
        });
      }
    var asid;
        function testAPI() {
          console.log('Welcome!  Fetching your information.... ');
          
          FB.api('/me', function(response) {
            console.log('Successful login for: ' + response.name);
          console.log(response);
          asid = response.id;
            document.getElementById('status').innerHTML =
              'Thanks for logging in, ' + response.name + '! Please complete your registration by setting up the pin <br><input type="password" name="secure_pin" id="secure_pin" class="form-control" /><br/><input type="submit" name="submit" value="submit" onclick="linkFacebook()" class="btn btn-success" />';
          });
        }
        
        
        function linkFacebook(){
         var spin = document.getElementById('secure_pin').value
           console.log('Secure pin entered'+ spin);
           console.log('id :'+asid);
           var accountId = jQuery("#accountId").text();
           $.ajax({
  type: "POST",
  url: "https://barclaysbotnode-thestinson.c9users.io/account/link/"+accountId,
  data: {"ASID":asid,"secure_pin":spin},
  success: function(){ console.log("linking success") },
  dataType: "application/json"
});
          
         }
    
    </script>
    <!-- jQuery 3 -->
    <script src="https://adminlte.io/themes/AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="https://adminlte.io/themes/AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="https://adminlte.io/themes/AdminLTE/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="https://adminlte.io/themes/AdminLTE/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="https://adminlte.io/themes/AdminLTE/dist/js/demo.js"></script>
      </body>
</html>
