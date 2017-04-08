<table id="datatable_fixed_column" class="table table-striped table-bordered smart-form">
  <thead>
    <tr>
    	<th></th>
    	<?php if (!empty($report_details['sales_dates'])) { 
									foreach ($report_details['sales_dates']  as $reportDate) {
							?>
      	<th><?=$reportDate['datetime']?></th>
      	<?php  } } ?>		
		<th>Total</th>
    </tr>
  </thead>
  <tbody>
  
   
   <!-- <?php if (!empty($report_details['sales_names'])) { 
					foreach ($report_details['sales_names']  as $reportName) {
		?>
	    <tr class="odd gradeX">
	    <td><?=$reportName['name']?></td>
	    </tr>
	<?php  } } ?> -->
	      	
	 
	
    <?php if (!empty($report_details['sales_report'])) { 
			foreach ($report_details['sales_report'] as $key => $report) {
	?> 
		    <tr class="odd gradeX">	    	
		      <td><?=$report['name']?></td>
		      <?php foreach ($report_details['sales_dates']  as $reportDate) { 
		      					if ($reportDate['datetime'] == $report['datetime']) { 
		      ?>
		      	<td><?=$report['row_total_bill_items']?></td>
		      	<?php } else { ?>
		      	<td>-</td>      
		      <?php } } ?> 
		      <?php foreach ($report_details['sales_names']  as $reportName) { 
		      			foreach ($report_details['sales_row_total']  as $report_row_total) {

		      					if ($reportName['name'] == $report_row_total['name']) { 
		      ?>
		      	<td><?=$report_row_total['row_total']?></td>
		      	<?php } } } ?>           
		    </tr>    
    
    <?php  } } ?>
    <tr class="odd gradeX">
      <td>Sales Tax</td>
      <?php      

      if (!empty($report_details['sales_report'])) { 
			

		      foreach ($report_details['sales_dates']  as $reportDate) {
		      		foreach ($report_details['sales_report'] as $key => $report) { 
		      					if ($report['tax_amount_bill_items'] > 0 && $reportDate['datetime'] == $report['datetime']) { 
      ?>
      <td><?=$report['tax_amount_bill_items']?></td>
      <?php }  } } } ?>
    </tr>
    <tr class="even gradeY">
    	<th>Total</th>
        	
    </tr> 
  </tbody>
</table>
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
		

		// var oTable = $('#datatable_fixed_column').dataTable({
		// 	"sDom" : "<'dt-top-row'><'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
		// 	//"sDom" : "t<'row dt-wrapper'<'col-sm-6'i><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'>>",
		// 	"oLanguage" : {
		// 		"sSearch" : "Search all columns:"
		// 	},
		// 	"bSortCellsTop" : true
		// });		
		


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
	
</script>