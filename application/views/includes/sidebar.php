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
						<a href="ajax/dashboard.html" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
					</li>
					
					<li>
						<a href="#"><i class="fa fa-lg fa-fw fa-list-alt"></i> <span class="menu-item-parent">Catalog</span></a>
						<ul>
							<li>
								<a href="ajax/flot.html">Manage Menu</a>
							</li>
							<li>
								<a href="ajax/morris.html">Manage Category</a>
							</li>
							<li>
								<a href="ajax/inline-charts.html">Manage Attributes</a>
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
					
				</ul>
			</nav>
			<span class="minifyme"> <i class="fa fa-arrow-circle-left hit"></i> </span>

		</aside>