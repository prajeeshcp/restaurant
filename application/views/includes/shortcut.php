<div id="shortcut">
	<ul>
	<?php if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {?>
		<li>
			<a href="#" class="jarvismetro-tile big-cubes bg-color-blue"  data-toggle="modal" data-target="#myModalRegister"> <span class="iconbox"> <i class="fa fa-user fa-4x"></i> <span>Add User </span> </span> </a>
		</li>

		<li>
			<a href="#" class="jarvismetro-tile big-cubes bg-color-orangeDark" data-toggle="modal" data-target="#myModalListUsers"> <span class="iconbox"> <i class="fa fa-group fa-4x"></i> <span>List Users</span> </span> </a>
		</li>
		<?php } ?>
		<li>
			<a href="#ajax/gmap-xml.html" class="jarvismetro-tile big-cubes bg-color-greenLight"> <span class="iconbox"> <i class="fa fa-key fa-4x"></i> <span>Change password</span> </span> </a>
		</li>
		
	</ul>
</div>


<!-- Modal -->
<div class="modal fade" id="myModalRegister" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLabel">Add User</h4>
			</div>

			<div class="modal-body">
				<div class="row" id="messages" style="display:none">
					<div class="col-lg-12 col-sm-offset-12">
		            	<div class="alert alert-danger" ></div>
		          	</div>					
				</div>
				
				<!-- <form id="registerForm"> -->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="First Name" name="firstName" id="firstName" required />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Last Name" name="lastName" id="lastName" required />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="User Name" name="userName" id="userName" required />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<input type="number" class="form-control" placeholder="Phone" name="phone" id="phone"   required />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<input type="password" class="form-control" placeholder="Password" name="password" id="password" required />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<input type="password" class="form-control" placeholder="Confirm Password" name="confPassword" id="confPassword" required />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<input type="email" class="form-control" placeholder="Email" name="email" id="email" required />
						</div>
						<div class="form-group">
							<textarea class="form-control" placeholder="Address" rows="5" id="address" name="address" required></textarea>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="category"> User Type</label>
							<select class="form-control" id="userType" name="userType" id="userType">
								<option value="" selected>Select A Type</option>
								<option value="2">Cashier</option>
								<option value="3">Waiter</option>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Cancel
				</button>
				<button type="button" class="btn btn-primary" id="register" >
					Add
				</button>
			</div>
				
			<!-- </form> -->

				
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Modal -->
<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLabel">Edit User</h4>
			</div>

			<div class="modal-body" id="myModalEditBody">
				

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Cancel
				</button>
				<button type="button" class="btn btn-primary" id="editUser" >
					Edit
				</button>
			</div>
				
			<!-- </form> -->

				
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!-- Modal -->
<div class="modal fade" id="myModalListUsers" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLabel">User List</h4>
			</div>
			<div class="modal-body">
				<div class="row" id="successMessages" style="display:none">
					<div class="col-lg-12 col-sm-offset-12">
		            	<div class="alert alert-success" ></div>
		          	</div>					
				</div>

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
					<h2>Users</h2>
			<a href="#" class="btn btn-success btn-sm pull-right" data-dismiss="modal" aria-hidden="true" data-toggle="modal" data-target="#myModalRegister" >Add new User</a>
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
									<th>Name</th>									
									<th>Type</th>
									<th>User Name</th>
									<th>Email</th>
									<th>Action</th>
									<th></th>
								</tr>
								<tr class="second">
									<td>
										<label class="input">
											<input type="text" name="search_engine" value="Filter  Name " class="search_init">
										</label>
									</td>
									<td>
										<label class="input">
											<input type="text" name="search_browser" value="Filter Type" class="search_init">
										</label>	
									</td>
                                    <td>
										<label class="input">
											<input type="text" name="search_attribute" value="Filter User Name" class="search_init">
										</label>	
									</td>
									<td>
										<label class="input">
											<input type="text" name="search_platform" value="Filter Email" class="search_init">
										</label>	
									</td>
									<td></td>
									<td></td>
									
								</tr>
							</thead>
							<tbody id="userData">
                            
							</tbody>
						</table>
					</div>
					<!-- end widget content -->

				</div>
				<!-- end widget div -->

			</div>
			<!-- end widget -->

				

			</div>
			
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script type="text/javascript">


</script>