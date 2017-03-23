<?php $selected		= (isset($selected) ? $selected : 'dashboard');
	$catelog		= FALSE;
	$system			= FALSE;
	$table			= FALSE;
	$report			= FALSE;
	if ($selected == "menuattribute" || $selected == "menucategory" || $selected == "allmenus") {
		$catelog		= TRUE;
	} else if($selected == "system") {
		$system		= TRUE;
	} else if ($selected == "tablecategory" || $selected == "tabledetails") {
		$table		= TRUE;
	} else if ($selected == "billreport") {
		$report		= TRUE;
	}
 ?>
 <?php 
	$user = $this->ion_auth->user()->row();
 ?>
<aside id="left-panel">

			<!-- User info -->
			<div class="login-info">
				<span> <!-- User image size is adjusted inside CSS, it should stay as it --> 
					<img src="<?=site_url('assets/')?>img/avatars/sunny.png" alt="me" class="online" /> 
					<a href="javascript:void(0);" id="show-shortcut">
						<?=$user->first_name." ".$user->last_name?> <i class="fa fa-angle-down"></i>
					</a> 
				</span>
			</div>
			<!-- end user info -->

			<!-- NAVIGATION : This navigation is also responsive

			To make this navigation dynamic please make sure to link the node
			(the reference to the nav > ul) after page load. Or the navigation
			will not initialize.
			-->
			<nav>
				<!-- NOTE: Notice the gaps after each icon usage <i></i>..
				Please note that these links work a bit different than
				traditional href="" links. See documentation for details.
				-->

				<ul>
					<li class="<?=($selected == 'dashboard') ? 'active' : ''?>">
						<a href="<?=site_url('manage')?>" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
					</li>
					<?php if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {?>
					<li class="<?=($catelog) ? 'open' : ''?>">
						<a href="#"><i class="fa fa-lg fa-fw fa-list-alt"></i> <span class="menu-item-parent">Menu Master</span></a>
						<ul style=" <?=($catelog) ? 'display: block;' : ''?>">
							<li class="<?=($selected == 'allmenus') ? 'active' : ''?>"> 
								<a href="<?=site_url('manage/manage_menu')?>" >Manage Menu</a>
							</li>
							<li class="<?=($selected == 'menucategory') ? 'active' : ''?>">
								<a href="<?=site_url('manage/menu_categories')?>">Manage Category</a>
							</li>
							<li class="<?=($selected == 'menuattribute') ? 'active' : ''?>">
								<a href="<?=site_url('manage/menu_attribute')?>">Manage Attributes</a>
							</li>
						</ul>
					</li>
					<li class="<?=($table) ? 'open' : ''?>">
						<a href="#"><i class="fa fa-lg fa-fw fa-table"></i> <span class="menu-item-parent">Tables Master</span></a>
						<ul style=" <?=($table) ? 'display: block;' : ''?>">	
							<li class="<?=($selected == 'tabledetails') ? 'active' : ''?>">
								<a href="<?=site_url('manage/table_details')?>">Manage Tables</a>
							</li>
                            <li class="<?=($selected == 'tablecategory') ? 'active' : ''?>">
								<a href="<?=site_url('manage/table_categories')?>">Table Category</a>
							</li>
						</ul>
					</li>
					
                    <li class="<?=($report) ? 'open' : ''?>">
						<a href="#"><i class="fa fa-lg fa-fw fa-sort-alpha-desc"></i> <span class="menu-item-parent">Report Master</span></a>
						<ul style=" <?=($report) ? 'display: block;' : ''?>">	
							<li class="<?=($selected == 'billreport') ? 'active' : ''?>">
								<a href="<?=site_url('manage/bill_report')?>">Bill</a>
							</li>
                             <li class="<?=($selected == 'taxreport') ? 'active' : ''?>">
								<a href="<?=site_url('manage/tax_report')?>">Tax</a>
							</li>
                             <li class="<?=($selected == 'orderreport') ? 'active' : ''?>">
								<a href="<?=site_url('manage/order_report')?>">Orders</a>
							</li>
                            <li class="<?=($selected == 'tableorderreport') ? 'active' : ''?>">
								<a href="<?=site_url('manage/table_order_report')?>">Table Orders</a>
							</li>
                            <li class="<?=($selected == 'parcelorderreport') ? 'active' : ''?>">
								<a href="<?=site_url('manage/parcel_order_report')?>">Parcel Orders</a>
							</li>
							<li class="<?=($selected == 'salesreport') ? 'active' : ''?>">
								<a href="<?=site_url('manage/sales_report')?>">Sales</a>
							</li>
                            
						</ul>
					</li>
                    <li class="<?=($system) ? 'active' : ''?>">
						<a href="<?=site_url('manage/system_config')?>"><i class="fa fa-lg fa-fw fa-cog"></i> <span class="menu-item-parent">System</span></a>
					</li>
					<?php } ?>
				</ul>
			</nav>
			<span class="minifyme"> <i class="fa fa-arrow-circle-left hit"></i> </span>

		</aside>