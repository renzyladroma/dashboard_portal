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

    <meta name="theme-color" content="#ea3c3c">
    
    <title>CMA Portal</title>

    <!-- page stylesheets -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/vendor/datatables/media/css/dataTables.bootstrap4.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/vendor/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css">
    <!-- end page stylesheets -->
	
	<!-- page scripts -->
	<script src="<?php echo base_url(); ?>asset/vendor/jquery/dist/jquery.js"></script>
    <!-- end page scripts -->

    <!-- build:css({.tmp,app}) styles/app.min.css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/vendor/bootstrap/dist/css/bootstrap.css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/vendor/pace/themes/black/pace-theme-minimal.css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/vendor/font-awesome/css/font-awesome.css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/vendor/animate.css/animate.css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/styles/app.css" id="load_styles_before"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/styles/app.skins.css"/>
    <!-- endbuild -->
	
	<!--Morris-->
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/vendor/morris/morris.css"/>
	<script src="<?php echo base_url(); ?>asset/vendor/morris/raphael-min.js"></script>
	<script src="<?php echo base_url(); ?>asset/vendor/morris/morris.js"></script>
	
  </head>
  <body>

    <div class="app">
      <!--sidebar panel-->
      <div class="off-canvas-overlay" data-toggle="sidebar"></div>
      <div class="sidebar-panel">
        <div class="brand">
          <!-- toggle offscreen menu -->
          <a href="javascript:;" data-toggle="sidebar" class="toggle-offscreen hidden-lg-up">
            <i class="material-icons">menu</i>
          </a>
          <!-- /toggle offscreen menu -->
          <!-- logo -->
          <a class="brand-logo" href="<?php echo base_url(); ?>">
			<b class="expanding-hidden" style="font-size: 28px;">CMA <font color="#f7d20a"></font>Portal</b>
            
          </a>
          <!-- /logo -->
        </div>
        <div class="nav-profile dropdown">
          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
            <div class="user-image">
              <img src="<?php echo base_url(); ?>asset/images/avatar2.png" class="avatar img-circle" alt="user" title="user"/>
            </div>
            <div class="user-info expanding-hidden">
              <?php echo $this->session->userdata('fname').' '.$this->session->userdata('lname'); ?>
              <small class="bold">Administrator</small>
            </div>
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/main/logout">Logout</a>
          </div>
        </div>
        <!-- main navigation -->
        <nav>
          <p class="nav-title">NAVIGATION</p>
          <ul class="nav">
            <!-- dashboard -->
            <li>
              <a href="<?php echo base_url(); ?>">
                <i class="material-icons" style="color:#ea3c3c;">dashboard</i>
                <span>Dashboard</span>
              </a>
            </li>
		
            <!-- /dashboard -->
			
			<li>
              <a href="<?php echo base_url(); ?>index.php/main/Daily_Report">
                <i class="material-icons" style="color:#ea3c3c;">assignment</i>
                <span>Daily Total Report</span>
              </a>
            </li>
			
			<li>
              <a href="<?php echo base_url(); ?>index.php/main/Ads_Report">
                <i class="material-icons" style="color:#ea3c3c;">assignment</i>
                <span>Daily Ads Report</span>
              </a>
            </li>
			
			<li>
              <a href="<?php echo base_url(); ?>index.php/main/logout">
                <i class="material-icons" style="color:#ea3c3c;">lock_open</i>
                <span>Logout</span>
              </a>
            </li>
				
          </ul>
          
        </nav>
        <!-- /main navigation -->
      </div>
      <!-- /sidebar panel -->
	  
      <!-- content panel -->
      <div class="main-panel">
        <!-- top header -->
        <nav class="header navbar" style="background-color: #ea3c3c">
          <div class="header-inner">
            <div class="navbar-item navbar-spacer-right brand hidden-lg-up" >
              <!-- toggle offscreen menu -->
              <a href="javascript:;" data-toggle="sidebar" class="toggle-offscreen">
                <i class="material-icons">menu</i>
              </a>
              <!-- /toggle offscreen menu -->
              <!-- logo -->
              <a class="brand-logo hidden-xs-down" href="<?php echo base_url(); ?>">
                <b class="expanding-hidden" style="font-size: 30px;">CMA<font color="#5686ef">Portal</font> </b>
              </a>
              <!-- /logo -->
            </div>
            <a class="navbar-item navbar-spacer-right navbar-heading hidden-md-down" href="#">
              <span><br></span>
            </a>
            
            
          </div>
        </nav>
        <!-- /top header -->