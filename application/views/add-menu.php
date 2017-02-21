<?php $this->load->view('includes/header'); ?>
		<!-- END HEADER -->

		<!-- Left panel : Navigation area -->
		<!-- Note: This width of the aside area can be adjusted through LESS variables -->
		<?php $this->load->view('includes/sidebar', array('selected' => 'allmenus')); ?>
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
				<?=(empty($get_data)) ? 'Add Menu' : 'Edit Menu'?>
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
		<article class="col-sm-12 col-md-12 col-lg-2">
			
			<!-- Widget ID (each widget will need unique ID)-->
			
			<!-- end widget -->

		</article>
		<!-- WIDGET END -->

		<!-- NEW WIDGET START -->
		<article class="col-sm-12 col-md-12 col-lg-8">
			
			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget" id="wid-id-8" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false">
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
					<h2><?=(empty($get_data)) ? 'Add New Menu ' : 'Edit '.stripslashes($get_data['menu_name'])?></h2>
					<ul class="nav nav-tabs pull-right in">

						<li class="active">

							<a data-toggle="tab" href="#hb1"> <i class="fa fa-lg fa-sitemap"></i> <span class="hidden-mobile hidden-tablet"> Genaral Information </span> </a>

						</li>
						<li>

							<a data-toggle="tab" href="#hb3"> <i class="fa fa-lg fa-inr"></i> <span class="hidden-mobile hidden-tablet"> Price </span> </a>

						</li>
						<li>
							<a data-toggle="tab" href="#hb2"> <i class="fa fa-lg fa-list"></i> <span class="hidden-mobile hidden-tablet"> Ingredients </a>
						</li>

					</ul>
				</header>

				<!-- widget div-->
				<div>

					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->

					</div>
					<!-- end widget edit box -->

					<!-- widget content -->
                    <form action="<?=site_url('manage/submit_menu')?>" method="post" class="smart-form">
					<div class="widget-body">

						<div class="tab-content">
							<div class="tab-pane active" id="hb1">

								<div class="widget-body no-padding">
						<!-- Success states for elements -->
						
                        <?php if (!empty($get_data)) { ?>
                        <input type="hidden" name="edit_id" value="<?=$get_data['entity_id']?>" />
                        <?php } ?>
							<fieldset>					
								<section>
									<label class="label">Name</label>
									<label class="input state-success">
										<input type="text" value="<?=(!empty($get_data)) ? $get_data['menu_name'] : '' ?>" name="menu_name" required>
									</label>
									<div class="note note-success">This is a required field.</div>
								</section>
                                
                                <section>
									<label class="label">Category</label>
									<label class="select state-success">
										<select id="" name="category" required>
                                         <option value="">SELECT CATEGORY</option>
                                        <?php if (!empty($categories)) {
												foreach ($categories as $cat) {
											 ?>
											<option <?=(!empty($get_data) && $get_data['category_id'] == $cat['entity_id'])  ? 'selected' : ''?> value="<?=$cat['entity_id']?>"><?=stripslashes($cat['entity_name'])?></option>
											<?php } } ?>
										</select>
										<i></i>
									</label>
									<div class="note note-success">Thanks for your selection.</div>
								</section>
								
								<section>
									<label class="label">Status</label>
									<label class="select state-success">
										<select id="" name="menu_status" required>
											<option <?=(!empty($get_data) && $get_data['status'] == 1)  ? 'selected' : ''?> value="1">Enabled</option>
											<option <?=(!empty($get_data) && $get_data['status'] == 2) ? 'selected' : ''?> value="2">Disabled</option>
										</select>
										<i></i>
									</label>
									<div class="note note-success">Thanks for your selection.</div>
								</section>
							</fieldset>
							
						
						<!--/ Success states for elements -->				
						
					</div>

							</div>
                            <div class="tab-pane" id="hb3">
  <div class="widget-body no-padding"> 
    <!-- Success states for elements -->
    <?php if (!empty($price_types)){ 
		foreach($price_types as $types) {
	?>
    <fieldset>
    <div class="row">
        <section class="col col-4">
        <label class="label">Price Type</label>
            <label class="select">
                <select name="price_type_<?=$types['entity_id']?>">
                
                	<option value="<?=$types['entity_id']?>"><?=stripslashes($types['type_name'])?></option>
                  
                </select>
            </label>
        </section>
        <section class="col col-8">
        <label class="label">Price Amount</label>
            <label class="input">
                <input name="price_amt_<?=$types['entity_id']?>" type="text" value="<?=(!empty($price_list) && $price_list[$types['entity_id']]) ? $price_list[$types['entity_id']] : ''?>" placeholder="Enter amount">
            </label>
        </section>
    </div>
    </fieldset>
    <?php } } else { ?>
    <fieldset>
    <div class="row">
        <section class="col col-12">
        <label class="label">Price Amount</label>
            <label class="input">
                <input name="price_amt_<?=$types['entity_id']?>" type="text" placeholder="Enter amount">
            </label>
        </section>
        </div>
        </fieldset>
    <?php } ?>
    <!--/ Success states for elements --> 
    <fieldset>
    <div class="row">
        <section class="col col-8">
        <label class="label">Tax Class</label>
            <label class="select">
                <select name="tax_class">
                	<option value="">SELECT TAX CLASS</option>
                	<?php if (!empty($tax_class)) : foreach ($tax_class as $tax) { ?>
                	<option value="<?=$tax['entity_id']?>" <?=($get_data['tax_class'] == $tax['entity_id']) ? 'selected' : ''?>><?=stripslashes($tax['tax_class'])?></option>
                    <?php } endif; ?>
                </select>
            </label>
        </section>
        </div>
        </fieldset>
  </div>
</div>

							<div class="tab-pane" id="hb2">
								<input type="hidden" id="option-count" name="option-count" value="<?=(!empty($get_data)) ? count($ingredients) : 0 ?>" />
					  			<input type="hidden" id="option-last-count" name="option-last-count" value="<?=(!empty($get_data)) ? count($ingredients) : 0 ?>" />			
								<div class="widget-body no-padding">
                                <div class="row">
                                <div class="col-md-11"><br />
                                <a href="javascript:void(0);" class="btn btn-primary btn-xs pull-right" id="more_sons_btn"><i class="fa fa-plus-circle"></i> Add New</a>
                                </div>
                                </div>
                               <?php if (empty($get_data) && empty($ingredients)) { ?>
                               <fieldset>					
								<section> 
                                
									<label class="label">Ingredient 1</label>
									<label class="input state-success">
										<input type="text" value="" name="ingredients[]" >
									</label>
								</section>
                                </fieldset>
                               <?php } ?>
								
                                <div id="more-options">
                                	<?php if (!empty($ingredients)) { 
										foreach ($ingredients as $key => $ings) {
											$keyId		= $key+1;
											
									?>
                                    		<fieldset id="option-wrapper-<?=$keyId?>"><section><button onclick="remove_sons(<?=$keyId?>)" id="remove-option-<?=$keyId?>" class="btn btn-danger btn-xs pull-right" type="button" > <i class="fa  fa-times-circle"></i> Remove</button><label class="label">Ingredient <?=$keyId?></label><label class="input state-success"><input type="text" value="<?=stripslashes($ings['ingredient_name'])?>" name="ingredients[<?=$ings['ingredient_id']?>]" ></label></section></fieldset>
                                    <?php } } ?>
                                </div>
                                    </div>
                               
								</div>
                                <footer>
								<button type="submit" class="btn btn-primary">Submit</button>
								<button type="button" class="btn btn-default" onclick="window.history.back();">Back</button>
							</footer>
							</div>
						</div>
 </form>
					</div>
                   
					<!-- end widget content -->

				</div>
				<!-- end widget div -->

			</div>
			<!-- end widget -->

		</article>
		<!-- WIDGET END -->
		<article class="col-sm-12 col-md-12 col-lg-2">
			
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
		<script type="application/javascript" language="javascript">
	function remove_sons(id_count)
	{
		//alert(id_count);
		$('#option-wrapper-'+id_count).remove();
		$('#remove-option-'+id_count).remove();
		var optLastCount 	= $('#option-last-count').val();
		var optLastCount = (Number(optLastCount)-1);
		$('#option-last-count').val(optLastCount);
	}
	$('#more_sons_btn').click(function(){
	
		var optCount 	= $('#option-count').val();
		var optLastCount = $('#option-last-count').val();
		//if(Number(optLastCount)<9)
		//{
			var optCount = (Number(optCount)+1);
			var optLastCount = (Number(optLastCount)+1);
			$('#more-options').append('<fieldset id="option-wrapper-'+optCount+'"><section><button onclick="remove_sons('+optCount+')" id="remove-option-'+optCount+'" class="btn btn-danger btn-xs pull-right" type="button" > <i class="fa  fa-times-circle"></i> Remove</button><label class="label">Ingredient '+(optCount+1)+'</label><label class="input state-success"><input type="text" value="" name="ingredients[]" ></label></section></fieldset>');
			$('#option-count').val(optCount);
			$('#option-last-count').val(optLastCount);
		//}
	});
</script>
<script type="text/javascript">
	pageSetUp();
</script>
<?php $this->load->view('includes/footer'); ?>

	</body>

</html>