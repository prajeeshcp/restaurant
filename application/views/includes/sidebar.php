<?php $selected		= (isset($selected) ? $selected : 'dashboard');
	$catelog		= FALSE;
	$system			= FALSE;
	if ($selected == "menuattribute" || $selected == "menucategory" || $selected == "allmenus") {
		$catelog	= TRUE;
	} else if($selected == "system") {
		$system		= TRUE;
	}
 ?>
<aside id="left-panel">

			<!-- User info -->
			<div class="login-info">
				<span> <!-- User image size is adjusted inside CSS, it should stay as it --> 
					<img src="<?=site_url('assets/')?>img/avatars/sunny.png" alt="me" class="online" /> 
					<a href="javascript:void(0);" id="show-shortcut">
						john.doe <i class="fa fa-angle-down"></i>
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
					<li class="">
						<a href="<?=site_url('manage')?>" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
					</li>
					
					<li class="<?=($catelog) ? 'open' : ''?>">
						<a href="#"><i class="fa fa-lg fa-fw fa-list-alt"></i> <span class="menu-item-parent">Catalog</span></a>
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
					<li>
						<a href="#"><i class="fa fa-lg fa-fw fa-table"></i> <span class="menu-item-parent">Tables</span></a>
						<ul>
							<li>
								<a href="ajax/table.html">Manage Tables</a>
							</li>
							<li>
								<a href="ajax/datatables.html">Table Category</a>
							</li>
						</ul>
					</li>
					<li class="<?=($system) ? 'active' : ''?>">
						<a href="<?=site_url('manage/system_config')?>"><i class="fa fa-lg fa-fw fa-cog"></i> <span class="menu-item-parent">System</span></a>
					</li>
				</ul>
			</nav>
			<span class="minifyme"> <i class="fa fa-arrow-circle-left hit"></i> </span>

		</aside>