<!DOCTYPE html>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
		<!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

		<title> Restaurant Management </title>
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- Use the correct meta names below for your web application
			 Ref: http://davidbcalhoun.com/2010/viewport-metatag 
			 
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">-->
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<!-- Basic Styles -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?=site_url('assets/')?>css/bootstrap.min.css">	
		<link rel="stylesheet" type="text/css" media="screen" href="<?=site_url('assets/')?>css/font-awesome.min.css">

		<!-- SmartAdmin Styles : Please note (smartadmin-production.css) was created using LESS variables -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?=site_url('assets/')?>css/smartadmin-production.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?=site_url('assets/')?>css/smartadmin-skins.css">	
		
		<!-- SmartAdmin RTL Support is under construction
			<link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-rtl.css"> -->
		
		<!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?=site_url('assets/')?>css/demo.css">

		<!-- FAVICONS -->
		<link rel="shortcut icon" href="<?=site_url('assets/')?>img/favicon/favicon.ico" type="image/x-icon">
		<link rel="icon" href="<?=site_url('assets/')?>img/favicon/favicon.ico" type="image/x-icon">

		<!-- GOOGLE FONT -->
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

	</head>
	<body id="login" class="animated fadeInDown">
		<!-- possible classes: minified, no-right-panel, fixed-ribbon, fixed-header, fixed-width-->
		<header id="header">
			<!--<span id="logo"></span>-->

			<div id="logo-group">
				<span id="logo"> <img src="<?=site_url('assets/')?>img/restaurent.png" alt="SmartAdmin"> </span>

				<!-- END AJAX-DROPDOWN -->
			</div>

			<span id="login-header-space"> <a href="javascript:;" class="btn btn-danger">Restaurant Management</a> </span>

		</header>

		<div id="main" role="main">

			<!-- MAIN CONTENT -->
			<div id="content" class="container">

				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">
						<h1 class="txt-color-red login-header-big">Restaurant Management</h1>
						<div class="hero">

							<div class="pull-left login-desc-box-l">
								<h4 class="paragraph-header">It's Okay to be Smart. Experience the simplicity of Restaurant, everywhere you go!</h4>
								<div class="login-app-icons">
									<a href="javascript:void(0);" class="btn btn-danger btn-sm">Manager</a>
									<a href="javascript:void(0);" class="btn btn-danger btn-sm">Table Order</a>
                                    <a href="javascript:void(0);" class="btn btn-danger btn-sm">K O T</a>
								</div>
							</div>
							
							<img src="<?=site_url('assets/')?>img/sales-icon.jpg" class="pull-right display-image" alt="" >

						</div>

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<h5 class="about-heading">About Restaurant Management - Are you up to date?</h5>
								<p>
									Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's.
								</p>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<h5 class="about-heading">Not just your average template!</h5>
								<p>
									Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.
								</p>
							</div>
						</div>

					</div>
					<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
						<div class="well no-padding">
							<form action="<?=current_url()?>" id="login-form" class="smart-form client-form" method="post">
								<header>
									Sign In
								</header>
<?php if (!empty($message)): ?>
 
          <div class="col-lg-12 col-sm-offset-12">
            <?php $message_type = (!empty($message_type)) ? $message_type : 'info'; ?>
            <div class="alert alert-<?=$message_type?>"><?php echo $message; ?></div>
          </div>

        <?php endif; ?>
								<fieldset>
									
									<section>
										<label class="label">E-mail</label>
										<label class="input"> <i class="icon-append fa fa-user"></i>
											<input type="email" name="identity">
											<b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter email address/username</b></label>
									</section>

									<section>
										<label class="label">Password</label>
										<label class="input"> <i class="icon-append fa fa-lock"></i>
											<input type="password" name="password">
											<b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> </label>
										
									</section>

									<section>
										<label class="checkbox">
											<input type="checkbox" name="remember" value="TRUE" checked="">
											<i></i>Stay signed in</label>
									</section>
								</fieldset>
								<footer>
									<button type="submit" class="btn btn-primary">
										Sign in
									</button>
								</footer>
							</form>

						</div>
						
						
															
										
						
					</div>
				</div>
			</div>

		</div>

		<!--================================================== -->	

		<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)
		<script data-pace-options='{ "restartOnRequestAfter": true }' src="js/plugin/pace/pace.min.js"></script>-->

	    <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
	    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script> if (!window.jQuery) { document.write('<script src="<?=site_url('assets/')?>js/libs/jquery-2.0.2.min.js"><\/script>');} </script>

	    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script> if (!window.jQuery.ui) { document.write('<script src="<?=site_url('assets/')?>js/libs/jquery-ui-1.10.3.min.js"><\/script>');} </script>

		<!-- JS TOUCH : include this plugin for mobile drag / drop touch events 		
		<script src="js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> -->

		<!-- BOOTSTRAP JS -->		
		<script src="<?=site_url('assets/')?>js/bootstrap/bootstrap.min.js"></script>

		<!-- CUSTOM NOTIFICATION -->
		<script src="<?=site_url('assets/')?>js/notification/SmartNotification.min.js"></script>

		
		
		
		
		<!-- JQUERY VALIDATE -->
		<script src="<?=site_url('assets/')?>js/plugin/jquery-validate/jquery.validate.min.js"></script>
		
		
		
		
		<!-- JQUERY UI + Bootstrap Slider -->
		
		
		<!-- browser msie issue fix -->
		<script src="<?=site_url('assets/')?>js/plugin/msie-fix/jquery.mb.browser.min.js"></script>
		
		<!-- SmartClick: For mobile devices -->
		<script src="<?=site_url('assets/')?>js/plugin/smartclick/smartclick.js"></script>
		
		<!--[if IE 7]>
			
			<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
			
		<![endif]-->

		<!-- MAIN APP JS FILE -->
		<script src="js/app.js"></script>

		<script type="text/javascript">
			runAllForms();

			$(function() {
				// Validation
				$("#login-form").validate({
					// Rules for form validation
					rules : {
						email : {
							required : true,
							email : true
						},
						password : {
							required : true,
							minlength : 3,
							maxlength : 20
						}
					},

					// Messages for form validation
					messages : {
						email : {
							required : 'Please enter your email address',
							email : 'Please enter a VALID email address'
						},
						password : {
							required : 'Please enter your password'
						}
					},

					// Do not change code below
					errorPlacement : function(error, element) {
						error.insertAfter(element.parent());
					}
				});
			});
		</script>

	</body>
</html>