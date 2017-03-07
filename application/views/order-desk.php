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
				Manage order  of 
                <span class="fc-event-title"><?=stripslashes($table_detail['table_number'])?></span>
                
                
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
            	<div class="col-md-6 panel panel-success pricing-big">
                <div class="panel-footer text-align-center">
		                    <a role="button" class="btn btn-success btn-block" href="javascript:void(0);" id="create-new" onclick="return create_new_order()">Create New <span> Order</span></a>
		                
		                </div>
                 </div>
                 <div class="col-md-6 panel panel-success pricing-big">
                <div class="panel-footer text-align-center">
		                    <a role="button" class="btn btn-warning btn-block" href="javascript:void(0);" id="dialog_link">Manage Pending <span> Order</span></a>
		                
		                </div>
                 </div>
            </div>
			<div class="row">
		        <div class="col-xs-12 col-sm-6 col-md-7">
		            <div class="panel panel-darken">
		            	
		                <div class="panel-heading">
		                    <h3 class="panel-title">Menu and Price</h3>
		                </div>
                        <input type="hidden" value="<?=$table_id?>" id="table-id" />
                        <?php if(!empty($order_type)) {?>
                        	<input type="hidden" value="<?=$order_type?>" id="order-type" />
                        	<?php } ?>
		                <div class="panel-body no-padding">
		                    <div class="the-price" id='order-details'>
		                        <h1>#<span class="subscript">ORDER NO</span></h1>
		                    </div>
                            <div class="custom-scroll" style="max-height: 270px;overflow-x: hidden;
overflow-y: scroll;"> 
                                <table class="table ">
                                <tr class="panel-heading">
                                        <th width="50%">Menu Name</th>
                                        <?php if (!empty($price_cat_dtil)) {
												foreach ($price_cat_dtil as $pricecat) {
											 ?>
                                        <th><?=stripslashes(ucfirst($pricecat['type_name']))?></th>
                                        <?php } } else { ?>
                                        <th>Price</th>
                                        <?php } ?>
                                    </tr>
                                    <?php if (!empty($menu_category)) {
											foreach ($menu_category as $menuCat) {
										 ?>
                                    <tr class="active">
                                        <td colspan="<?=(!empty($price_cat_dtil)) ? count($price_cat_dtil)+1 : 2;?>"><strong class="text-danger fast animated"><b><?=($menuCat['entity_id'] == 1)? 'MENU ITEMS WITH NO MENU NAME' : stripslashes(strtoupper($menuCat['entity_name']))?></b></strong></td>
                                    </tr>
                                    <?php if (!empty($menu_details)) foreach ($menu_details as $menudtil) {
										if ($menudtil['category_id'] == $menuCat['entity_id']) {
										 ?>
                                    <tr>
                                        <td width="50%">
                                            <strong><?=stripslashes($menudtil['menu_name'])?></strong>&nbsp;&nbsp;&nbsp;<a class="btn btn-<?=($menudtil['attribute_name'] == 'veg') ? 'success' : 'warning'?> btn-circle" href="javascript:void(0);"><i class="glyphicon glyphicon-ok"></i></a>
                                        </td>
                                        <?php if (!empty($price_cat_dtil)) {
												foreach ($price_cat_dtil as $pricecat) {
													$getPrice		= _DB_get_record($this->tables['menu_entity_price'], array('menu_id' => $menudtil['entity_id'], 'price_type' => $pricecat['entity_id']))
											 ?>
                                        <td>
                                        <?php if ($getPrice['price_amount']) : ?>
                                        <button class="btn btn-primary disabled permision-btn" onclick="return confirm_menu(<?=$menudtil['entity_id']?>, <?=$pricecat['entity_id']?>)"><i class="fa fa-inr"></i>&nbsp;<?=$getPrice['price_amount']?></button> <?php endif; ?></td>
                                        <?php } } else { ?>
                                        <td><button class="btn disabled btn-primary permision-btn">Not Mention</button></td>
                                        <?php } ?>
                                    </tr>
                                    <?php } } } } else { ?>
										<tr class="active">
                                        <td colspan="<?=(!empty($price_cat_dtil)) ? count($price_cat_dtil)+1 : 2;?>"><strong class="text-warning fast animated"><b>No Menu Category Found</b></strong></td>
                                    </tr>
									<?php } ?>
                                </table>
                            </div>
		                </div>
		                <div class="panel-footer text-align-center">
		                    <a href="javascript:void(0);" onclick="return compleate_order();" class="btn btn-success btn-lg disabled permision-btn" role="button">Compleate Order</a></div>
		            </div>
		        </div>
		        <div class="col-xs-12 col-sm-6 col-md-5">
		            <div class="panel panel-primary">
		                <img src="<?=site_url('assets/')?>img/ribbon.png" class="ribbon">
		                <div class="panel-heading">
		                    <h3 class="panel-title">
		                        Order List</h3>
		                </div>
		                <div class="panel-body no-padding" >
		                    <div class="the-price">
		                        <h1><span class="subscript" id="kot-dtil">KOT No</span></h1>
		                    </div>
                            <div class="custom-scroll" style="max-height: 270px;overflow-x: hidden;
overflow-y: scroll;">
		                    <table class="table" id="kot-details">
		                         
		                    </table>
                            </div>
		                </div>
		                <div class="panel-footer text-align-center">
		                    <a href="javascript:void(0);" class="btn btn-warning btn-lg kot-button disabled" role="button" onclick="return print_kot();">PRINT KOT</a></div>
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
<div id="dialog_simple" title="Dialog Simple Title">
	<div class="row">
    	<div class="col-xs-12 col-sm-12 col-md-12">
		            <div class="panel panel-greenLight">
		                <div class="panel-heading">
		                    <h3 class="panel-title">
		                        Pending/Processing</h3>
		                </div>
		                <div class="panel-body no-padding">
		                    <table class="table">
		                        <tbody>
                                <tr>
                                	<th>Order No</th>
                                    <th>Table No</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                <?php if (!empty($processing_odr)) { 
									foreach ($processing_odr as $key => $processing) {
										$tableDtl		= _DB_get_record($this->tables['table_details'], array('id' => $processing['table_id']));
										$kotDtl		= _DB_get_record($this->tables['kot_entity'], array('order_id' => $processing['entity_id']));
								?>
                                <tr class="<?=($key%2 == 0) ? 'active' : ''?>">
		                            <td>
		                               <?=$processing['increment_id']?>
		                            </td>
                                    <td><?=$tableDtl['table_number']?></td>
                                     <td><span class="label bg-color-<?=($processing['status'] == 'pending') ? 'red' : 'orange'?>"><?=ucfirst($processing['status'])?></span></td>
                                    <td><a href="javascript:void(0);" class="btn btn-primary" onclick="return manage_pending_order(<?= $processing['entity_id']?>,<?= $kotDtl['entity_id']?>);"><i class="fa fa-shopping-cart"></i> GO NOW</a></td>
		                        </tr>
                                <?php } } ?>
		                    </tbody></table>
		                </div>
		                
		            </div>
		        </div>
    </div>
</div>
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
	
	// Dialog click
	$('#dialog_link').click(function() {
		$('#dialog_simple').dialog('open');
		return true;

	});

	$('#dialog_simple').dialog({
		autoOpen : false,
		width : 600,
		resizable : false,
		modal : true,
		title : "Pending Order",
		buttons : [/*{
			html : "<i class='fa fa-trash-o'></i>&nbsp; Delete all items",
			"class" : "btn btn-danger",
			click : function() {
				$(this).dialog("close");
			}
		}, */{
			html : "<i class='fa fa-times'></i>&nbsp; Cancel",
			"class" : "btn btn-default",
			click : function() {
				$(this).dialog("close");
			}
		}]
	});
</script> 
<script type="text/javascript" language="javascript">
	function create_new_order() {
		var tableId			= $('#table-id').val(); 
		var dataString    	= "table_id="+tableId;
		$.ajax({ 
			type : "POST",
			url : "<?=site_url()?>manage/create_order",
			data : dataString,
			dataType : 'html',
			cache : false, // (warning: this will cause a timestamp and will call the request twice)
			beforeSend : function() {
			// cog placed
				$('#create-new').addClass('disabled');
				$('#content').css({opacity : '0.5'});
					// scroll up
				$("html, body").animate({
					scrollTop : 0
				}, "fast");
			},
			success : function(data) { 
				$('#order-details').html(data);
				get_kot_details();
				$('#create-new').removeClass('disabled');
				$('.permision-btn').removeClass('disabled');
				$('#content').css({opacity : '1'});
			},
			error : function(xhr, ajaxOptions, thrownError) {
				container.html('<h4 style="margin-top:10px; display:block; text-align:left"><i class="fa fa-warning txt-color-orangeDark"></i> Error 404! Page not found.</h4> <br>Or you are running this page from your hard drive. Please make sure for all ajax calls your page needs to be hosted in a server');
			},
			async : false
		});
	}
	function get_kot_details() { 
		var kotId			= $('#kot-id').val();
		var dataString    	= "kot_id="+kotId;
		$.ajax({ 
			type : "POST",
			url : "<?=site_url()?>manage/get_kot_details",
			data : dataString,
			dataType : 'html',
			cache : false, // (warning: this will cause a timestamp and will call the request twice)
			beforeSend : function() {},
			success : function(data) { 
				$('#kot-dtil').html("KOT No "+data);
				
			},
			error : function(xhr, ajaxOptions, thrownError) {
				container.html('<h4 style="margin-top:10px; display:block; text-align:left"><i class="fa fa-warning txt-color-orangeDark"></i> Error 404! Page not found.</h4> <br>Or you are running this page from your hard drive. Please make sure for all ajax calls your page needs to be hosted in a server');
			},
			async : false
		});
		
		
	}
</script>
<script type="text/javascript" language="javascript">
	function confirm_menu(menu_id = null, price_type = null, orderId=null,kotId=null,flag=null) {		
		if(orderId == null){ var orderId			= $('#order-id').val(); }
		if(kotId == null){ var kotId				= $('#kot-id').val(); } 
		if(flag == null){ var flag				= 0; }	
		var order_type = $('#order-type').val();			
		if (orderId && kotId) {
			var dataString    	= "order_id="+orderId+'&menu_id='+menu_id+'&price_type='+price_type+'&kot_id='+kotId+'&flag='+flag;
			$.ajax({ 
				type : "POST",
				url : "<?=site_url()?>manage/confirm_menu/"+order_type,
				data : dataString,
				dataType : 'html',
				cache : false, // (warning: this will cause a timestamp and will call the request twice)
				beforeSend : function() {
			// cog placed
			
					$('#create-new').addClass('disabled');
					$('.kot-button').removeClass('disabled');
					$('#content').css({opacity : '0.5'});
						// scroll up
						$("html, body").animate({
							scrollTop : 0
						}, "fast");
				},
				success : function(data) {
					
					if(data === "null"){
						//alert(data);
						$('#kot-details').html("");						
						$('.kot-button').addClass('disabled');
					} else {
						$('#kot-details').html();
						$('#kot-details').html(data);
						$('#create-new').removeClass('disabled');
						$('.kot-button').removeClass('disabled');	
					}
					$('#content').css({opacity : '1'});
					
				},
				error : function(xhr, ajaxOptions, thrownError) {
					container.html('<h4 style="margin-top:10px; display:block; text-align:left"><i class="fa fa-warning txt-color-orangeDark"></i> Error 404! Page not found.</h4> <br>Or you are running this page from your hard drive. Please make sure for all ajax calls your page needs to be hosted in a server');
				},
				async : false
			});
		}
	}
</script>
<script type="text/javascript" language="javascript">
	function print_kot() {
		var orderId			= $('#order-id').val();
		var kotId			= $('#kot-id').val(); 		
		if (orderId && kotId) {
			var dataString    	= "order_id="+orderId+'&kot_id='+kotId;
			$.ajax({ 
				type : "POST",
				url : "<?=site_url()?>manage/print_kot",
				data : dataString,
				dataType : 'html',
				cache : false, // (warning: this will cause a timestamp and will call the request twice)
				beforeSend : function() {
			// cog placed
			
					$('#create-new').addClass('disabled');
					$('#content').css({opacity : '0.5'});
						// scroll up
						$("html, body").animate({
							scrollTop : 0
						}, "fast");
				},
				success : function(data) {
					//$('#kot-details').html(data);
					$('#create-new').removeClass('disabled');
					$('.kot-button').addClass('disabled');
					$('#content').css({opacity : '1'});
					 var myWindow=window.open('','','width=500,height=500');
						myWindow.document.write(data);
						myWindow.document.close();
						myWindow.focus();
						myWindow.print();
						myWindow.close();
						var kotId			= $('#kot-id').val(); 	
						refresh_kot(kotId);
				},
				error : function(xhr, ajaxOptions, thrownError) {
					container.html('<h4 style="margin-top:10px; display:block; text-align:left"><i class="fa fa-warning txt-color-orangeDark"></i> Error 404! Page not found.</h4> <br>Or you are running this page from your hard drive. Please make sure for all ajax calls your page needs to be hosted in a server');
				},
				async : false
			});
		}
	}
	
	function refresh_kot(kotId){
		if (kotId) {
			var dataString    	= 'kot_id='+kotId;
			$.ajax({ 
				type : "POST",
				url : "<?=site_url()?>manage/refresh_kot",
				data : dataString,
				dataType : 'html',
				cache : false, // (warning: this will cause a timestamp and will call the request twice)
				beforeSend : function() {},
				success : function(data) {
					if (data) {
					$('#kot-details').html(data);
					}
				},
				error : function(xhr, ajaxOptions, thrownError) {
					container.html('<h4 style="margin-top:10px; display:block; text-align:left"><i class="fa fa-warning txt-color-orangeDark"></i> Error 404! Page not found.</h4> <br>Or you are running this page from your hard drive. Please make sure for all ajax calls your page needs to be hosted in a server');
				},
				async : false
			});
		}
	}
</script>

<script type="text/javascript" language="javascript">
	function manage_pending_order(orderId=null,kotId = null) {
		// var orderId			= $('#order-id').val();
		// var kotId			= $('#kot-id').val(); 		
		if (kotId) {
			var dataString    	= "order_id="+orderId+'&kot_id='+kotId;
			$.ajax({ 
				type : "POST",
				url : "<?=site_url()?>manage/manage_pending_order",
				data : dataString,
				dataType : 'html',
				cache : false, // (warning: this will cause a timestamp and will call the request twice)
				beforeSend : function() {
			// cog placed
					$('#dialog_simple').dialog('close');
					$('#create-new').addClass('disabled');
					$('#content').css({opacity : '0.5'});
						// scroll up
						$("html, body").animate({
							scrollTop : 0
						}, "fast");
				},
				success : function(data) {
					
					$('#kot-details').html(data);
					$('#create-new').removeClass('disabled');
					$('.kot-button').removeClass('disabled');
					$('#content').css({opacity : '1'});
				},
				error : function(xhr, ajaxOptions, thrownError) {
					container.html('<h4 style="margin-top:10px; display:block; text-align:left"><i class="fa fa-warning txt-color-orangeDark"></i> Error 404! Page not found.</h4> <br>Or you are running this page from your hard drive. Please make sure for all ajax calls your page needs to be hosted in a server');
				},
				async : false
			});
		}
	}
</script>
<script type="text/javascript" language="javascript">
	function compleate_order() {
	 var orderId		= $('#order-id').val();
	 var dataString    	= "order_id="+orderId;
			$.ajax({ 
				type : "POST",
				url : "<?=site_url()?>manage/compleate_order",
				data : dataString,
				dataType : 'html',
				cache : false, // (warning: this will cause a timestamp and will call the request twice)
				beforeSend : function() {
			// cog placed
					$('#dialog_simple').dialog('close');
					$('#create-new').addClass('disabled');
					$('#content').css({opacity : '0.5'});
						// scroll up
						$("html, body").animate({
							scrollTop : 0
						}, "fast");
				},
				success : function(data) {
					//$('#kot-details').html(data);
				},
				error : function(xhr, ajaxOptions, thrownError) {
					container.html('<h4 style="margin-top:10px; display:block; text-align:left"><i class="fa fa-warning txt-color-orangeDark"></i> Error 404! Page not found.</h4> <br>Or you are running this page from your hard drive. Please make sure for all ajax calls your page needs to be hosted in a server');
				},
				async : false
			});
	}
</script>
<?php $this->load->view('includes/footer'); ?>

	</body>

</html>