<?php $this->load->view('includes/header'); ?>
		<!-- END HEADER -->

		<!-- Left panel : Navigation area -->
		<!-- Note: This width of the aside area can be adjusted through LESS variables -->
		<?php $this->load->view('includes/sidebar', array('selected' => 'system')); ?>
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
				System 
			<span>> 
				Configuration
			</span>
		</h1>
	</div>
	<?php $this->load->view('includes/pagewise-pi-chart') ?>
</div>

<!-- widget grid -->
<section id="widget-grid" class="">

	<!-- row -->
	<div class="row">

		<!-- NEW WIDGET START -->
		<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-1" data-widget-editbutton="false">
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
					<span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Price Type</h2>
			<a href="<?=site_url('manage/add_price_type')?>" class="btn btn-success btn-sm pull-right">Add price type</a>
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

						<table id="datatable_fixed_column" class="table table-striped table-bordered smart-form">
							<thead>
								<tr>
									<th>SL NO</th>
									<th>Price Type</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
								<tr class="second">
									<td>
										<label class="input">
											<input type="text" name="search_engine" value="Filter ID" class="search_init">
										</label>
									</td>
									<td>
										<label class="input">
											<input type="text" name="search_browser" value="Filter price type" class="search_init">
										</label>	
									</td>
                                    
									<td>
										<label class="input">
											<input type="text" name="search_platform" value="Filter status" class="search_init">
										</label>	
									</td>
									<td>	
									</td>
									
								</tr>
							</thead>
							<tbody>
                            <?php if (!empty($price_type)) { 
									foreach ($price_type as $key => $type) {
							?>
								<tr class="odd gradeX">
									<td><?=$key+1?></td>
									<td><?=stripslashes($type['type_name'])?></td>
									<td><a href="javascript:void(0);" class="btn btn-<?=($type['status'] == 1) ? 'success' : 'warning'?> btn-xs"><?=($type['status'] == 1) ? 'Enabled' : 'Disabled'?></a></td>		
									<td><a href="<?=site_url('manage/edit_price_type/'.$type['entity_id'])?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Edit</a></td>
								</tr>
                                <?php  } } ?>
							</tbody>
						</table>
					</div>
					<!-- end widget content -->

				</div>
				<!-- end widget div -->

			</div>
			<!-- end widget -->

			

		</article>
		<!-- WIDGET END -->
        
        <!-- SECOND WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-2" data-widget-editbutton="false">
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
					<span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Tax Classes</h2>
                    &nbsp;&nbsp;&nbsp;<a href="javascript:;" data-toggle="modal" data-target="#set-system-tax" class="btn btn-danger btn-sm ">System Tax</a>&nbsp;&nbsp;&nbsp;
			<a href="<?=site_url('manage/add_tax')?>" class="btn btn-success btn-sm pull-right">Add Tax Class</a>&nbsp;&nbsp;&nbsp;
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

						<table id="datatable_fixed_column-1" class="table table-striped table-bordered smart-form">
							<thead>
								<tr>
									<th>SL NO</th>
									<th>Class</th>
                                    <th>Rate</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
								<tr class="second">
									<td>
										<label class="input">
											<input type="text" name="search_engine" value="Filter ID" class="search_init">
										</label>
									</td>
									<td>
										<label class="input">
											<input type="text" name="search_browser" value="Filter tax class" class="search_init">
										</label>	
									</td>
                                    <td>
										<label class="input">
											<input type="text" name="search_browser" value="Filter tax rate" class="search_rate">
										</label>	
									</td>
									<td>
										<label class="input">
											<input type="text" name="search_platform" value="Filter status" class="search_init">
										</label>	
									</td>
									<td>	
									</td>
									
								</tr>
							</thead>
							<tbody>
                            <?php if (!empty($tax_classes)) { 
									foreach ($tax_classes as $key => $taxclass) {
							?>
								<tr class="odd gradeX">
									<td><?=$key+1?></td>
									<td><?=stripslashes($taxclass['tax_class'])?></td>
                                    <td><?=stripslashes($taxclass['tax_rate'])?></td>
									<td><a href="javascript:void(0);" class="btn btn-<?=($taxclass['status'] == 1) ? 'success' : 'warning'?> btn-xs"><?=($type['status'] == 1) ? 'Enabled' : 'Disabled'?></a></td>		
									<td><a href="<?=site_url('manage/edit_tax/'.$taxclass['entity_id'])?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Edit</a></td>
								</tr>
                                <?php  } } ?>
							</tbody>
						</table>
					</div>
					<!-- end widget content -->

				</div>
				<!-- end widget div -->

			</div>
			<!-- end widget -->

			

		</article>
        
        <!-- SECOND WIDGET END -->

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
        
        
        <div class="modal fade" id="set-system-tax" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLabel">Set system tax class</h4>
			</div>

			<div class="modal-body" id="myModalEditBody">
				<div class="row" id="changePasswordMessages" style="display:none">
					<div class="col-lg-12 col-sm-offset-12">
		            	<div class="alert alert-danger" ></div>
		          	</div>					
				</div>
				
				<!-- <form id="registerForm"> -->				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="modal-title">Select Tax Class</label>
						</div>
					</div>
                    <?php $tax_class	= _DB_data($this->tables['tax_entity'], array('status' => 1), null, null, array('tax_class', 'asc')); 
						  $applay_tax	= _DB_get_record($this->tables['system_config'], array('config_code' => 'system-tax'));
					?>
					<div class="col-md-6">
						<div class="form-group">
							<select class="form-control" name="main_tax" id="main_tax" required >
                            	<option value="">SELECT CLASS</option>
                                <?php if (!empty($tax_class)) {
										foreach ($tax_class as $tax) {
									 ?>
                                <option value="<?=stripslashes($tax['entity_id'])?>" <?=($applay_tax['value'] ==$tax['entity_id']) ? 'selected' : ''?>><?=stripslashes($tax['tax_class'])?></option>
                                <?php } }  ?>
                            </select>
						</div>
					</div>
					
				</div>
                <div class="row">
                	<div class="col-lg-12"><p>This is the base tax which will get added to the grand total amount. This tax will get added once after calculate the discount.</p></div>
                </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Cancel
				</button>
				<button type="button" class="btn btn-primary" id="change-sytem-tax" >
					Save Tax
				</button>
			</div>
				
			<!-- </form> -->

				
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
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
	
	// PAGE RELATED SCRIPTS

	loadDataTableScripts();
	function loadDataTableScripts() {

		loadScript("<?=site_url('assets/')?>js/plugin/datatables/jquery.dataTables-cust.min.js", dt_2);

		function dt_2() {
			loadScript("<?=site_url('assets/')?>js/plugin/datatables/ColReorder.min.js", dt_3);
		}

		function dt_3() {
			loadScript("<?=site_url('assets/')?>js/plugin/datatables/FixedColumns.min.js", dt_4);
		}

		function dt_4() {
			loadScript("<?=site_url('assets/')?>js/plugin/datatables/ColVis.min.js", dt_5);
		}

		function dt_5() {
			loadScript("<?=site_url('assets/')?>js/plugin/datatables/ZeroClipboard.js", dt_6);
		}

		function dt_6() {
			loadScript("<?=site_url('assets/')?>js/plugin/datatables/media/js/TableTools.min.js", dt_7);
		}

		function dt_7() {
			loadScript("<?=site_url('assets/')?>js/plugin/datatables/DT_bootstrap.js", runDataTables);
		}

	}

	function runDataTables() {

		/*
		 * BASIC
		 */
		$('#dt_basic').dataTable({
			"sPaginationType" : "bootstrap_full"
		});

		/* END BASIC */

		/* Add the events etc before DataTables hides a column */
		$("#datatable_fixed_column thead input").keyup(function() {
			oTable.fnFilter(this.value, oTable.oApi._fnVisibleToColumnIndex(oTable.fnSettings(), $("thead input").index(this)));
		});

		$("#datatable_fixed_column thead input").each(function(i) {
			this.initVal = this.value;
		});
		$("#datatable_fixed_column thead input").focus(function() {
			if (this.className == "search_init") {
				this.className = "";
				this.value = "";
			}
		});
		$("#datatable_fixed_column thead input").blur(function(i) {
			if (this.value == "") {
				this.className = "search_init";
				this.value = this.initVal;
			}
		});		
		

		var oTable = $('#datatable_fixed_column').dataTable({
			"sDom" : "<'dt-top-row'><'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
			//"sDom" : "t<'row dt-wrapper'<'col-sm-6'i><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'>>",
			"oLanguage" : {
				"sSearch" : "Search all columns:"
			},
			"bSortCellsTop" : true
		});		
		


		/*
		 * COL ORDER
		 */
		$('#datatable_col_reorder').dataTable({
			"sPaginationType" : "bootstrap",
			"sDom" : "R<'dt-top-row'Clf>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
			"fnInitComplete" : function(oSettings, json) {
				$('.ColVis_Button').addClass('btn btn-default btn-sm').html('Columns <i class="icon-arrow-down"></i>');
			}
		});
		
		/* END COL ORDER */

		/* TABLE TOOLS */
		$('#datatable_tabletools').dataTable({
			"sDom" : "<'dt-top-row'Tlf>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
			"oTableTools" : {
				"aButtons" : ["copy", "print", {
					"sExtends" : "collection",
					"sButtonText" : 'Save <span class="caret" />',
					"aButtons" : ["csv", "xls", "pdf"]
				}],
				"sSwfPath" : "<?=site_url('assets/')?>js/plugin/datatables/media/swf/copy_csv_xls_pdf.swf"
			},
			"fnInitComplete" : function(oSettings, json) {
				$(this).closest('#dt_table_tools_wrapper').find('.DTTT.btn-group').addClass('table_tools_group').children('a.btn').each(function() {
					$(this).addClass('btn-sm btn-default');
				});
			}
		});
		
		/* END TABLE TOOLS */

	}
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
<script type="application/javascript" language="javascript">
	$('#change-sytem-tax').click(function(){
			var tax_class		= $('#main_tax').find(":selected").val();
			
			if (tax_class) {
			var dataString    	= "tax_class="+tax_class;
			$.ajax({ 
				type : "POST",
				url : "<?=site_url()?>manage/manage_system_tax",
				data : dataString,
				dataType : 'html',
				cache : false, // (warning: this will cause a timestamp and will call the request twice)
				beforeSend : function() {
			// cog placed
					$('#content').css({opacity : '0.5'});
						// scroll up
						$("html, body").animate({
							scrollTop : 0
						}, "fast");
				},
				success : function(data) { 
					alert(data);
					//$('#kot-details').html(data);
					$('#content').css({opacity : '1'});
				},
				error : function(xhr, ajaxOptions, thrownError) {
					container.html('<h4 style="margin-top:10px; display:block; text-align:left"><i class="fa fa-warning txt-color-orangeDark"></i> Error 404! Page not found.</h4> <br>Or you are running this page from your hard drive. Please make sure for all ajax calls your page needs to be hosted in a server');
				},
				async : false
			});
		}
		
		});
</script>
	</body>

</html>