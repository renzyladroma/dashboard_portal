<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content=""/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1"/>
    <meta name="msapplication-tap-highlight" content="no">
    
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="Milestone">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Milestone">

    <meta name="theme-color" content="#4C7FF0">
    
    <title>CMA Portal</title>

    <!-- page stylesheets -->
    <!-- end page stylesheets -->

    <!-- build:css({.tmp,app}) styles/app.min.css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/vendor/bootstrap/dist/css/bootstrap.css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/vendor/pace/themes/blue/pace-theme-minimal.css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/vendor/font-awesome/css/font-awesome.css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/vendor/animate.css/animate.css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/styles/app.css" id="load_styles_before"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/styles/app.skins.css"/>
    <!-- endbuild -->
  </head>
  <body>

    <div class="app no-padding no-footer layout-static">
      <div class="session-panel">
        <div class="session">
          <div class="session-content">
            <div class="card card-block form-layout">
              <form role="form" method="post" action="<?php echo base_url(); ?>index.php/main/login_validation" id="validate">
                <div class="text-xs-center m-b-3">
			<p> </p>
               <center> <b> <h1> CMA Portal </h1> </b> </center>
				<center> <h6> Sign in to continue. </h6> </center>
                </div>
                <fieldset class="form-group">
                  <label for="username">
                  <h5> Enter Username: </h5>
                  </label>
                  <input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="username" required/>
                </fieldset>
                <fieldset class="form-group">
                  <label for="password">
                  <h5>  Enter Password: </h5>
                  </label>
                  <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="********" required/>
                </fieldset>
                
                <button class="btn btn-danger btn-block btn-lg" type="submit">
                  Login
                </button>
                <br>
				<p style="text-align: center;"><img src="<?php echo base_url(); ?>asset/images/CDU.png" alt="Cosmic Digital Universe"><br> Cosmic Digital Universe</p>
                
              </form>
            </div>
          </div>
          
        </div>

      </div>
    </div>

    <script type="text/javascript">
      window.paceOptions = {
        document: true,
        eventLag: true,
        restartOnPushState: true,
        restartOnRequestAfter: true,
        ajax: {
          trackMethods: [ 'POST','GET']
        }
      };
    </script>

    <!-- build:js({.tmp,app}) scripts/app.min.js -->
    <script src="<?php echo base_url(); ?>asset/vendor/jquery/dist/jquery.js"></script>
    <script src="<?php echo base_url(); ?>asset/vendor/pace/pace.js"></script>
    <script src="<?php echo base_url(); ?>asset/vendor/tether/dist/js/tether.js"></script>
    <script src="<?php echo base_url(); ?>asset/vendor/bootstrap/dist/js/bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>asset/vendor/fastclick/lib/fastclick.js"></script>
    <script src="<?php echo base_url(); ?>asset/scripts/constants.js"></script>
    <script src="<?php echo base_url(); ?>asset/scripts/menu.js"></script>
    <!-- endbuild -->

    <!-- page scripts -->
    <script src="<?php echo base_url(); ?>asset/vendor/jquery-validation/dist/jquery.validate.min.js"></script>
    <!-- end page scripts -->

    <!-- initialize page scripts -->
    <script type="text/javascript">
      $('#validate').validate();
    </script>
    <!-- end initialize page scripts -->
    
  </body>
</html>
