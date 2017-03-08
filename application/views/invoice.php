<?php $this->load->view('includes/header'); 
	$orderDtil			= _DB_get_record($this->tables['order_entity'], array('entity_id' => $order_id));
	$billDtil			= _DB_get_record($this->tables['bill_entity'], array('entity_id' => $bill_id));
	$tableDtil			= _DB_get_record($this->tables['table_details'], array('id' => $orderDtil['table_id']));
	$billItems			= _DB_data($this->tables['bill_entity_items'], array('bill_id' => $bill_id), null, null, null);
?>
		<!-- END HEADER -->

		<!-- Left panel : Navigation area -->
		<!-- Note: This width of the aside area can be adjusted through LESS variables -->
		<?php $this->load->view('includes/sidebar'); ?>
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
            
			<link href="css/invoice.css" rel="stylesheet">

<!-- widget grid -->
<section id="widget-grid" class="">

	<!-- row -->
	<div class="row">

		<!-- NEW WIDGET START -->
		<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget well jarviswidget-color-darken" id="wid-id-0" data-widget-sortable="false" data-widget-deletebutton="false" data-widget-editbutton="false" data-widget-colorbutton="false">
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
				

				<!-- widget div-->
				<div>

					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->

					</div>
					<!-- end widget edit box -->

					<!-- widget content -->
					<div class="widget-body no-padding">

						<div class="widget-body-toolbar">

							<div class="row">

								<div class="col-sm-4">

									
								</div>

								<div class="col-sm-8 text-align-right">
                                <div class="btn-group">
										<a href="javascript:void(0)" id="print-bill" class="btn btn-sm btn-warning"> <i class="fa fa-print"></i> Print </a>
									</div>

									<div class="btn-group">
										<a href="javascript:void(0)" class="btn btn-sm btn-primary"> <i class="fa fa-edit"></i> Edit </a>
									</div>

									<div class="btn-group">
										<a href="javascript:void(0)" class="btn btn-sm btn-success"> <i class="fa fa-plus"></i> Create New </a>
									</div>

								</div>

							</div>

						</div>

						<div class="padding-10" id="bill-area">
							<br>
							<div class="pull-left">
								<img src="<?=site_url('assets/img/restaurent.png')?>" style="height:70px" alt="bill icon">
							</div>
							
							<div class="clearfix"></div>
							<br>
							<br>
							<div class="row">
								<div class="col-sm-9">
									<h4 class="semi-bold">Order No. #<?=$orderDtil['increment_id']?></h4>
									<address>
										<strong>Table No. #<?=$tableDtil['table_number']?></strong>
										<br>
										Maya International,
										<br>
										Mangalore, pin 431464
										<br>
										<abbr title="Phone">P:</abbr> (467) 143-4317
									</address>
								</div>
								<div class="col-sm-3">
									<div>
										<div class="font-md">
											<strong>BILL NO :</strong>
											<span class="pull-right"> #<?=$billDtil['increment_id']?> </span>
										</div>

									</div>
									<div>
										<div class="font-md">
											<strong>BILL DATE :</strong>
											<span class="pull-right"> <i class="fa fa-calendar"></i> <?=date('d/m/Y', strtotime($billDtil['created_at']))?> </span>
										</div>

									</div>
									<br>
									<div class="well well-sm  bg-color-darken txt-color-white no-border">
										<div class="fa-lg">
											Total Due :
											<span class="pull-right"> RS <?=$billDtil['grand_total']?>** </span>
										</div>

									</div>
									<br>
									<br>
								</div>
							</div>
							<table class="table table-hover">
								<thead>
									<tr>
										<th class="text-center">QTY</th>
										<th>ITEM</th>
										<th>DESCRIPTION</th>
										<th>PRICE</th>
										<th>SUBTOTAL</th>
									</tr>
								</thead>
								<tbody>
                                <?php if (!empty($billItems)) : foreach ($billItems as $items) { ?>
									<tr>
										<td class="text-center"><strong><?=$items['qty_ordered']?></strong></td>
										<td><a href="javascript:void(0);"><?=$items['name']?></a></td>
										<td><?=$items['order_type']?></td>
										<td><?=$items['price']?></td>

										<td><?=$items['row_total']?></td>
									</tr>
									<?php } endif;?>
									<tr>
										<td colspan="4">TAX</td>
										<td><strong>0%</strong></td>
									</tr>
								</tbody>
							</table>

							<div class="invoice-footer">

								<div class="row">

									<div class="col-sm-7">
										
									</div>
									<div class="col-sm-5">
										<div class="invoice-sum-total pull-right">
											<h3><strong>Total: <span class="text-success">RS <?=$billDtil['grand_total']?></span></strong></h3>
										</div>
									</div>

								</div>
								
								<div class="row">
									<div class="col-sm-12">
										<p class="note">**To avoid any excess panelty charges, please make payments within 30 days of the due date. There will be a 2% interest charge per month on all late invoices.</p>
									</div>
								</div>

							</div>
						</div>

					</div>
					<!-- end widget content -->

				</div>
				<!-- end widget div -->

			</div>
			<!-- end widget -->

		</article>
		<!-- WIDGET END -->

	</div>

	<!-- end row -->

</section>
<!-- end widget grid -->

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

		<!-- EASY PIE CHARTS -->
		<script src="<?=site_url('assets/')?>js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js"></script>

		<!-- SPARKLINES -->
		<script src="<?=site_url('assets/')?>js/plugin/sparkline/jquery.sparkline.min.js"></script>

		<!-- JQUERY VALIDATE -->
		<script src="<?=site_url('assets/')?>js/plugin/jquery-validate/jquery.validate.min.js"></script>

		<!-- JQUERY MASKED INPUT -->
		<script src="<?=site_url('assets/')?>js/plugin/masked-input/jquery.maskedinput.min.js"></script>

		<!-- JQUERY SELECT2 INPUT -->
		<script src="<?=site_url('assets/')?>js/plugin/select2/select2.min.js"></script>

		<!-- JQUERY UI + Bootstrap Slider -->
		<script src="<?=site_url('assets/')?>js/plugin/bootstrap-slider/bootstrap-slider.min.js"></script>

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
		<script type="text/javascript" language="javascript">
        	$('#print-bill').click(function(){
				var data	= $('#bill-area').html(); 
				var myWindow=window.open('','','width=750,height=750');
						myWindow.document.write(data);
						myWindow.document.close();
						myWindow.focus();
						myWindow.print();
						myWindow.close();
				});
        </script>

<?php $this->load->view('includes/footer'); ?>

	</body>

</html>