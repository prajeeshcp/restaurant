<?php $this->load->view('includes/header'); ?>
		<!-- END HEADER -->

		<!-- Left panel : Navigation area -->
		<!-- Note: This width of the aside area can be adjusted through LESS variables -->
		<?php $this->load->view('includes/sidebar', array('selected' => 'dashboard')); ?>
		<!-- END NAVIGATION -->

		<!-- MAIN PANEL -->
		<div id="main" role="main">

			<!-- RIBBON -->
			<div id="ribbon">

				<span class="ribbon-button-alignment"> <span id="refresh" class="btn btn-ribbon" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true"><i class="fa fa-refresh"></i></span> </span>

				<!-- breadcrumb -->
				<ol class="breadcrumb">
					<!-- This is auto generated -->
				</ol>
				<!-- end breadcrumb -->

				<!-- You can also add more buttons to the
				ribbon for further usability

				Example below:

				<span class="ribbon-button-alignment pull-right">
				<span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i> Change Grid</span>
				<span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i> Add</span>
				<span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">Search</span></span>
				</span> -->

			</div>
			<!-- END RIBBON -->

			<!-- MAIN CONTENT -->
			<div id="content">
<div class="row">
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa fa-table fa-fw "></i> 
				Order Desk 
			<span>> 
				Manage order
			</span>
		</h1>
	</div>
	<?php $this->load->view('includes/pagewise-pi-chart') ?>
</div>

<!-- widget grid -->
<section id="widget-grid" class="">

	<!-- row -->
	<div class="row">
	
	<div class="col-sm-12">
		
		<div class="well well-light">
			<div class="row">
				
		        <div class="col-xs-12 col-sm-6 col-md-7">
		            <div class="panel panel-darken">
		            	
		                <div class="panel-heading">
		                    <h3 class="panel-title">Menu and Price</h3>
		                </div>
		                <div class="panel-body no-padding">
		                    <div class="the-price">
		                        <h1>10001<span class="subscript">ORDER NO</span></h1>
		                        
		                    </div>
                            <div class="custom-scroll" style="max-height: 270px;overflow-x: hidden;
overflow-y: scroll;">
                                <table class="table ">
                                <tr class="panel-heading">
                                        <th width="50%">Menu Name</th>
                                        <th>Full</th>
                                        <th>Half</th>
                                    </tr>
                                    <tr class="active">
                                        <td colspan="3"><strong class="text-danger fast animated"><b>START UP</b></strong></td>
                                    </tr>
                                    <tr>
                                        <td width="50%">
                                            <strong>Beel Poori</strong>
                                        </td>
                                        <td><button class="btn btn-primary">300</button></td>
                                        <td><button class="btn btn-primary">150</button></td>
                                    </tr>
                                    <tr>
                                        <td width="50%">
                                            <strong>Beel Poori</strong>
                                        </td>
                                        <td><button class="btn btn-primary">300</button></td>
                                        <td><button class="btn btn-primary">150</button></td>
                                    </tr>
                                    <tr>
                                        <td width="50%">
                                            <strong>Beel Poori</strong>
                                        </td>
                                        <td><button class="btn btn-primary">300</button></td>
                                        <td><button class="btn btn-primary">150</button></td>
                                    </tr><tr>
                                        <td width="50%">
                                            <strong>Beel Poori</strong>
                                        </td>
                                        <td><button class="btn btn-primary">300</button></td>
                                        <td><button class="btn btn-primary">150</button></td>
                                    </tr><tr>
                                        <td width="50%">
                                            <strong>Beel Poori</strong>
                                        </td>
                                        <td><button class="btn btn-primary">300</button></td>
                                        <td><button class="btn btn-primary">150</button></td>
                                    </tr>
                                    <tr>
                                        <td width="50%">
                                            <strong>Beel Poori</strong>
                                        </td>
                                        <td><button class="btn btn-primary">300</button></td>
                                        <td><button class="btn btn-primary">150</button></td>
                                    </tr>
                                </table>
                            </div>
		                </div>
		                <div class="panel-footer text-align-center">
		                    <a href="javascript:void(0);" class="btn btn-success btn-lg" role="button">PRINT BILL</a></div>
		            </div>
		        </div>
		        <div class="col-xs-12 col-sm-6 col-md-5">
		            <div class="panel panel-primary">
		                <img src="<?=site_url('assets/')?>img/ribbon.png" class="ribbon">
		                <div class="panel-heading">
		                    <h3 class="panel-title">
		                        Order List</h3>
		                </div>
		                <div class="panel-body no-padding">
		                    <div class="the-price">
		                        <h1>
		                            10003<span class="subscript"> KOT No</span></h1>
		                    </div>
                            <div class="custom-scroll" style="max-height: 270px;overflow-x: hidden;
overflow-y: scroll;">
		                    <table class="table">
		                        <tr>
		                            <td width="55%">
		                               <strong> Beel Poori </strong>
		                            </td>
                                    <td><button type="button" class="btn btn-sm btn-info btn-prev">
									10</button></td>
                                    <td><div class="actions">
								<button type="button" class="btn btn-sm btn-warning btn-prev">
									<i class="fa fa-minus-circle"></i></button>
								<button type="button" class="btn btn-sm btn-success btn-next" data-last="Finish"><i class="fa fa-plus-circle"></i>
								</button>
                                <button type="button" class="btn btn-sm btn-danger btn-prev">
									<i class="fa  fa-trash-o"></i></button>
							</div></td>
		                        </tr>
                                <tr class="active">
		                            <td width="55%">
		                               <strong> Sav Poori </strong>
		                            </td>
                                    <td><button type="button" class="btn btn-sm btn-info btn-prev">
									15</button></td>
                                    <td><div class="actions">
								<button type="button" class="btn btn-sm btn-warning btn-prev">
									<i class="fa fa-minus-circle"></i></button>
								<button type="button" class="btn btn-sm btn-success btn-next" data-last="Finish"><i class="fa fa-plus-circle"></i>
								</button>
                                <button type="button" class="btn btn-sm btn-danger btn-prev">
									<i class="fa  fa-trash-o"></i></button>
							</div></td>
		                        </tr>
                                <tr>
		                            <td width="55%">
		                               <strong> Masala Poori </strong>
		                            </td>
                                    <td><button type="button" class="btn btn-sm btn-info btn-prev">
									15</button></td>
                                    <td><div class="actions">
								<button type="button" class="btn btn-sm btn-warning btn-prev">
									<i class="fa fa-minus-circle"></i></button>
								<button type="button" class="btn btn-sm btn-success btn-next" data-last="Finish"><i class="fa fa-plus-circle"></i>
								</button>
                                <button type="button" class="btn btn-sm btn-danger btn-prev">
									<i class="fa  fa-trash-o"></i></button>
							</div></td>
		                        </tr>
                                <tr class="active">
		                            <td width="55%">
		                               <strong> Pani Poori </strong>
		                            </td>
                                    <td><button type="button" class="btn btn-sm btn-info btn-prev">
									15</button></td>
                                    <td><div class="actions">
								<button type="button" class="btn btn-sm btn-warning btn-prev">
									<i class="fa fa-minus-circle"></i></button>
								<button type="button" class="btn btn-sm btn-success btn-next" data-last="Finish"><i class="fa fa-plus-circle"></i>
								</button>
                                <button type="button" class="btn btn-sm btn-danger btn-prev">
									<i class="fa  fa-trash-o"></i></button>
							</div></td>
		                        </tr>
                                <tr>
		                            <td width="55%">
		                               <strong> Vada </strong>
		                            </td>
                                    <td><button type="button" class="btn btn-sm btn-info btn-prev">
									15</button></td>
                                    <td><div class="actions">
								<button type="button" class="btn btn-sm btn-warning btn-prev">
									<i class="fa fa-minus-circle"></i></button>
								<button type="button" class="btn btn-sm btn-success btn-next" data-last="Finish"><i class="fa fa-plus-circle"></i>
								</button>
                                <button type="button" class="btn btn-sm btn-danger btn-prev">
									<i class="fa  fa-trash-o"></i></button>
							</div></td>
		                        </tr>
		                    </table>
                            </div>
		                </div>
		                <div class="panel-footer text-align-center">
		                    <a href="javascript:void(0);" class="btn btn-warning btn-lg" role="button">PRINT KOT</a></div>
		            </div>
		        </div>	
		    			    	
    		</div>

			<hr>
			
		</div>
		
	</div>
	
</div>

	<!-- end row -->

	<!-- end row -->

</section>
<!-- end widget grid -->

<!-- widget grid -->

<!-- end widget grid -->



			</div>
			<!-- END MAIN CONTENT -->

		</div>
		<!-- END MAIN PANEL -->

		<!-- SHORTCUT AREA : With large tiles (activated via clicking user name tag)
		Note: These tiles are completely responsive,
		you can add as many as you like
		-->
		<?php $this->load->view('includes/shortcut'); ?>
		<!-- END SHORTCUT AREA -->

		<!--================================================== -->

		<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)
		<script data-pace-options='{ "restartOnRequestAfter": true }' src="<?=site_url('assets/')?>js/plugin/pace/pace.min.js"></script>-->

		<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script>
			if (!window.jQuery) {
				document.write('<script src="<?=site_url('assets/')?>js/libs/jquery-2.0.2.min.js"><\/script>');
			}
		</script>

		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script>
			if (!window.jQuery.ui) {
				document.write('<script src="<?=site_url('assets/')?>js/libs/jquery-ui-1.10.3.min.js"><\/script>');
			}
		</script>

		<!-- JS TOUCH : include this plugin for mobile drag / drop touch events -->
		<script src="<?=site_url('assets/')?>js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script>

		<!-- BOOTSTRAP JS -->
		<script src="<?=site_url('assets/')?>js/bootstrap/bootstrap.min.js"></script>

		<!-- CUSTOM NOTIFICATION -->
		<script src="<?=site_url('assets/')?>js/notification/SmartNotification.min.js"></script>

		<!-- JARVIS WIDGETS -->
		<script src="<?=site_url('assets/')?>js/smartwidgets/jarvis.widget.min.js"></script>

		
		<!-- SPARKLINES -->
		<script src="<?=site_url('assets/')?>js/plugin/sparkline/jquery.sparkline.min.js"></script>

		

		<!-- JQUERY MASKED INPUT -->
		<script src="<?=site_url('assets/')?>js/plugin/masked-input/jquery.maskedinput.min.js"></script>

		<!-- JQUERY SELECT2 INPUT -->
		<script src="<?=site_url('assets/')?>js/plugin/select2/select2.min.js"></script>

		

		<!-- browser msie issue fix -->
		<script src="<?=site_url('assets/')?>js/plugin/msie-fix/jquery.mb.browser.min.js"></script>

		<!-- SmartClick: For mobile devices -->
		<script src="<?=site_url('assets/')?>js/plugin/smartclick/smartclick.js"></script>

		<!--[if IE 7]>

		<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>

		<![endif]-->

		<!-- Demo purpose only -->
		<script src="<?=site_url('assets/')?>js/demo.js"></script>

		<!-- MAIN APP JS FILE -->
		<script src="<?=site_url('assets/')?>js/app.js"></script>

		<!-- Your GOOGLE ANALYTICS CODE Below -->
		
<script type="text/javascript">

	// DO NOT REMOVE : GLOBAL FUNCTIONS!
	pageSetUp();
	
	 <?php if (!empty($message)): 
	 	 $message_type = (!empty($message_type)) ? $message_type : 'info'; 
		 if (!empty($message_type) && ($message_type == 'success')) {
		 	$code		= "#060";
		 } else {
			 $code		= "#C00";
		 }
		 
	 ?>
	$(function() {
		$.smallBox({
			title : "Information box",
			content : "<?php echo $message; ?>",
			color : "<?=$code?>",
			//timeout: 8000,
			icon : "fa fa-bell"
		});

	
		});
	<?php endif; ?>
</script> 
<?php $this->load->view('includes/footer'); ?>

	</body>

</html>