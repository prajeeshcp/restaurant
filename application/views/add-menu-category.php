<?php $this->load->view('includes/header'); ?>
		<!-- END HEADER -->

		<!-- Left panel : Navigation area -->
		<!-- Note: This width of the aside area can be adjusted through LESS variables -->
		<?php $this->load->view('includes/sidebar', array('selected' => 'menucategory')); ?>
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
				Catalog 
			<span>> 
				<?=(empty($get_data)) ? 'Add Category' : 'Edit Category'?>
			</span>
		</h1>
         
	</div>
	<?php $this->load->view('includes/pagewise-pi-chart') ?>
</div>

<!-- widget grid -->
<section id="widget-grid" class="">

	<!-- row -->
	<div class="row">
    
		<article class="col-lg-12">
        	 <?php if (!empty($message)): ?>
           <?php $message_type = (!empty($message_type)) ? $message_type : 'info';
		   			if ($message_type == 'success') {
						$notific	= 'Success';
					} else {
						$notific	= 'Warning';
					}
		    ?>
        <div class="alert alert-<?=$message_type?> fade in">
				<button class="close" data-dismiss="alert">
					×
				</button>
				<i class="fa-fw fa fa-check"></i>
				<strong><?=$notific?></strong> <?php echo $message; ?>
			</div>
            <?php endif; ?>
        </article>
		<!-- NEW WIDGET START -->
		<article class="col-sm-12 col-md-12 col-lg-3">
			
			<!-- Widget ID (each widget will need unique ID)-->
			
			<!-- end widget -->

		</article>
		<!-- WIDGET END -->

		<!-- NEW WIDGET START -->
		<article class="col-sm-12 col-md-12 col-lg-6">
			
			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false"	data-widget-editbutton="false">
				<!-- widget options:
					usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
					
					data-widget-colorbutton="false"	
					data-widget-editbutton="false"
					data-widget-togglebutton="false"
					data-widget-deletebutton="false"
					data-widget-fullscreenbutton="false"
					data-widget-custombutton="false"
					data-widget-collapsed="true" 
					data-widget-sortable="false"
					
				-->
				<header>
					<span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
					<h2><?=(empty($get_data)) ? 'Add New Category ' : 'Edit '.$get_data['entity_name']?></h2>				
					
				</header>

				<!-- widget div-->
				<div>
					
					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->
						
					</div>
					<!-- end widget edit box -->
					
					<!-- widget content -->
					<div class="widget-body no-padding">
						<!-- Success states for elements -->
						<form action="<?=site_url('manage/submit_category')?>" method="post" class="smart-form">
                        <?php if (!empty($get_data)) { ?>
                        <input type="hidden" name="edit_id" value="<?=$get_data['entity_id']?>" />
                        <?php } ?>
							<fieldset>					
								<section>
									<label class="label">Name</label>
									<label class="input state-success">
										<input type="text" value="<?=(!empty($get_data)) ? $get_data['entity_name'] : '' ?>" name="category_name" required>
									</label>
									<div class="note note-success">This is a required field.</div>
								</section>
                                
                                <section>
									<label class="label">Attribute</label>
									<label class="select state-success">
										<select id="" name="attribute_name" required>
                                         <option value="">SELECT ATTRIBUTE</option>
                                        <?php if (!empty($attributes)) {
												foreach ($attributes as $attr) {
											 ?>
											<option <?=(!empty($get_data) && $get_data['attribute_id'] == $attr['entity_id'])  ? 'selected' : ''?> value="<?=$attr['entity_id']?>"><?=stripslashes($attr['attribute_name'])?></option>
											<?php } } ?>
										</select>
										<i></i>
									</label>
									<div class="note note-success">Thanks for your selection.</div>
								</section>
								
								<section>
									<label class="label">Status</label>
									<label class="select state-success">
										<select id="" name="category_status" required>
											<option <?=(!empty($get_data) && $get_data['status'] == 1)  ? 'selected' : ''?> value="1">Enabled</option>
											<option <?=(!empty($get_data) && $get_data['status'] == 2) ? 'selected' : ''?> value="2">Disabled</option>
										</select>
										<i></i>
									</label>
									<div class="note note-success">Thanks for your selection.</div>
								</section>
							</fieldset>
							<footer>
								<button type="submit" class="btn btn-primary">Submit</button>
								<button type="button" class="btn btn-default" onclick="window.history.back();">Back</button>
							</footer>
						</form>
						<!--/ Success states for elements -->				
						
					</div>
					<!-- end widget content -->
					
				</div>
				<!-- end widget div -->
				
			</div>
			<!-- end widget -->

		</article>
		<!-- WIDGET END -->
		<article class="col-sm-12 col-md-12 col-lg-3">
			
			<!-- Widget ID (each widget will need unique ID)-->
			
			<!-- end widget -->

		</article>
	</div>

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
	pageSetUp();
</script>
<?php $this->load->view('includes/footer'); ?>

	</body>

</html>