<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>EP Asset Management System</title>
	<link rel="shortcut icon" href="<?=base_url()?>media/img/eplogo.ico" />
	<!-- jQuery -->
	<script src="<?=base_url()?>media/js/jquery-1.11.3.js"></script>
	<!--Bootstrap-->
	<link rel="stylesheet" href="<?=base_url()?>media/css/bootstrap.css" />
	<script src="<?=base_url()?>media/js/bootstrap.js"></script>

	<!--Pace-->
	<link rel="stylesheet" href="<?=base_url()?>media/css/pace-minimal.css" />
	<script src='<?=base_url()?>media/js/pace.js'></script>
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?=base_url()?>media/css/font-awesome.css" />
	<!-- AdminLTE -->
	<link rel="stylesheet" href="<?=base_url()?>media/css/AdminLTE.css" />
	<!--Alert Notify-->
	<link href="<?=base_url()?>media/css/animate.css" rel="stylesheet">
	<script src="<?=base_url()?>media/js/bootstrap-notify.js"></script>
	<style>
		.profile-img {
			width: 450px;
			height: 200px;
			margin: 0 auto 10px;
			display: block;
			-moz-border-radius: 50%;
			-webkit-border-radius: 50%;
			border-radius: 50%;
		}
	</style>
	<script type="text/javascript">
		function launchFullscreen(element){
			if($("#expander").hasClass("fa-expand")){
				if(element.requestFullscreen) {
			    element.requestFullscreen();
			  } else if(element.mozRequestFullScreen) {
			    element.mozRequestFullScreen();
			  } else if(element.webkitRequestFullscreen) {
			    element.webkitRequestFullscreen();
			  } else if(element.msRequestFullscreen) {
			    element.msRequestFullscreen();
			  }
			}else{
				if(document.exitFullscreen) {
			    document.exitFullscreen();
			  } else if(document.mozCancelFullScreen) {
			    document.mozCancelFullScreen();
			  } else if(document.webkitExitFullscreen) {
			    document.webkitExitFullscreen();
			  }
			}
			$("#expander").toggleClass("fa-expand fa-compress")
		}
	</script>
</head>
<body style="background-color:#ecf0f5;">
<!--<div class="row">
	<div class="pull-right">
		<button onclick="launchFullscreen(document.documentElement);" class="btn btn-lg btn-success btn-block" id="fullscreen" ><i id="expander" class="fa fa-expand"></i></button>
	</div>
</div>-->
