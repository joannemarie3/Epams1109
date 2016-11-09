<!doctype html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8" />
		<!--IE Compatibility modes-->
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="shortcut icon" href="<?=base_url()?>media/img/eplogo.ico" />
		<title>Elevated Play Asset Management System</title>
		<script>
			document.onreadystatechange = function () {
			  var state = document.readyState
			  if (state == 'interactive') {
			      $('.loader').modal('show');
			  } else if (state == 'complete') {
			     $('.loader').modal('hide');
			  }
			}
		</script>

		<!-- DataTables + jQuery 2.2.3 -->
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>/assets/datatables2/datatables.min.css"/>
		<script type="text/javascript" src="<?=base_url()?>/assets/datatables2/datatables.min.js"></script>

		<!-- Bootstrap-->
		<link rel="stylesheet" href="<?=base_url()?>media/css/bootstrap.css" />
		<script src="<?=base_url()?>media/js/bootstrap.js"></script>
		<!-- Font Awesome -->
		<link rel="stylesheet" href="<?=base_url()?>media/css/font-awesome.css" />
		<!--Alert Notify-->
		<link href="<?=base_url()?>media/css/animate.css" rel="stylesheet">
		<script src="<?=base_url()?>media/js/bootstrap-notify.js"></script>
		<!--AdminLTE-->
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>media/css/AdminLTE.css"/>
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>media/css/skin-green.css"/>
		<!-- AdminLTE App -->
	    <script src="<?=base_url()?>media/js/app.js" type="text/javascript"></script>
	    <!-- SlimScroll 1.3.0 -->
	    <script src="<?=base_url()?>media/js/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	    <!-- Select2 CSS -->
	    <link rel="stylesheet" href="<?=base_url()?>media/css/select2.css" />
	    <link rel="stylesheet" href="<?=base_url()?>media/css/select2-bootstrap.css" />
	    <script src="<?=base_url()?>media/js/select2.js"></script>
		<!-- Mask-->
		<script src="<?=base_url()?>media/js/jquery.mask.js"></script>
		<!-- Capitalize-->
		<script src="<?=base_url()?>media/js/jquery.capitalize.js"></script>
		<!-- DateTimePicker-->
		<script src="<?=base_url()?>media/js/moment.js"></script>
		<link rel="stylesheet" href="<?=base_url()?>media/css/bootstrap-datetimepicker.css" />
		<script src="<?=base_url()?>media/js/bootstrap-datetimepicker.js"></script>

		<!-- jQuery UI  1.12.1 -->
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>/assets/jquery-ui/jquery-ui.min.css"/>
		<script type="text/javascript" src="<?=base_url()?>/assets/jquery-ui/jquery-ui.min.js"></script>

		
		<script type="text/javascript">
			$.fn.modal.Constructor.prototype.enforceFocus = function() {};
		</script>

		<!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    	<!--<link href="<?=base_url()?>media/css/AdminLTE/skins/_all-skins.css" rel="stylesheet" type="text/css" />-->
    	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	    <!-- FastClick -->
	    <!--<script src='<?=base_url()?>media/js/fastclick/fastclick.min.js'></script>-->

	    <!-- DateTimePicker -->
	    <!--<link rel="stylesheet" href="<?=base_url()?>media/css/bootstrap-datetimepicker.css" />
	    <script src="<?=base_url()?>media/js/moment.js"></script>
	    <script src="<?=base_url()?>media/js/bootstrap-datetimepicker.js"></script>-->
		<!-- MaskMoney -->
		<!--<script src="<?=base_url()?>media/js/jquery.maskMoney.js"></script>-->
	</head>
<body class="skin-green sidebar-mini fixed">
<!-- Loading Loader -->
	<div class="loader modal fade" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title text-center"><div class="fa fa-cog fa-spin fa-5x"></div><br>Loading...</h4>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
<!-- End Loading Loader -->

<!-- Save Loader -->
	<div class="saver modal fade" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title text-center"><div class="fa fa-cog fa-spin fa-5x"></div><br>Saving...</h4>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
<!-- End Save Loader -->

<!-- Save Loader -->
	<div class="uploader modal fade" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title text-center"><div class="fa fa-cog fa-spin fa-5x"></div><br>Uploading...</h4>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
<!-- End Save Loader -->

<!-- Save Loader -->
	<div class="generater modal fade" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title text-center"><div class="fa fa-cog fa-spin fa-5x"></div><br>Generating...</h4>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
<!-- End Save Loader -->

<div class="wrapper">
     <header class="main-header">
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>


          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?=base_url()?>media/img/epLogo.png" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><b>Hello <?=$this->session->uname ?>!</b></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?=base_url()?>media/img/no_image_found.png" class="img-circle" alt="User Image" />
                    <p><b><?=$this->session->uname ?></b><br>
                      <br>
											<?php if ($this->session->utype == 1): ?>
															<small>Admin Account</small>
											<?php endif; ?>
											<?php if ($this->session->utype == 2): ?>
															<small>RM Account</small>
											<?php endif; ?>
											<?php if ($this->session->utype == 3): ?>
															<small>Tester Account</small>
											<?php endif; ?>

                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-success">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="javascript:void(0);" onclick="logout();" class="btn btn-danger" >Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <!--<li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-wechat"></i></a>
              </li>-->
            </ul>
          </div>
        </nav>
      </header>
<script type="text/javascript">
	function logout(){
		window.location.href = "<?=base_url()?>panel/logout";
	}
</script>
