<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends Cpanel_Controller
{
	protected static $upload_config 	= array();
	const MAX_IMAGES_ALLOWED 			= 5;
	public function __construct() {	
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library("pagination");
		$this->load->helper('url');
		$this->load->model('manage_model');
		$this->data['message'] 			= $this->session->flashdata('message');
		$this->data['message_type'] 	= $this->session->flashdata('message_type');
	}
	
	public function index($page = NULL) {
		if ($page) {
			$this->render($page);
		} else  {
			$this->render('dashboard');
		}
		}
		
	#manage menu attributes here 
	function menu_attribute() {
		$allAttributes		= _DB_data($this->tables['attributes'],null, null, null, array('entity_id', 'desc')); 
		$this->add_data(compact('allAttributes'));
		$this->render('manage-menu-attributes');
	}

	#load add page 
	function add_attribute() {
			$attribute_name		= '';
			$attribute_status	= '';
		$this->add_data(compact('attribute_name', 'attribute_status'));
		$this->render('add-menu-attributes');
	}
	
	#load edit attributes
	function edit_attribute($attId	= NULL) {
		if ($attId) {
			$get_data					= _DB_get_record($this->tables['attributes'], array('entity_id' => $attId));
			$attribute_name				= '';
			$attribute_status			= '';
			$this->add_data(compact('get_data', 'attribute_name', 'attribute_status'));
			$this->render('add-menu-attributes');
			
		} else {
			$this->session->set_flashdata('message', "Oops! something went wrong. Try again later.");
			$this->session->set_flashdata('message_type', 'danger');
			redirect('manage/menu_attribute', 'refresh');
		}
	}
	
	#add or edit menu attributes
	function submit_attribute() {
		$editId					= $this->input->post('edit_id', true);
		if (!$editId) {
		$this->form_validation->set_rules('attribute_name','Attribute Name','trim|required|is_unique[attributes.attribute_name]');
		} else {
			$this->form_validation->set_rules('attribute_name','Attribute Name','trim|required');
		}
		$this->form_validation->set_rules('attribute_status','Attribute Status','trim|required');
		$attribute_name			= $this->input->post('attribute_name', true);
		$attribute_status		= $this->input->post('attribute_status', true);
		if ($this->form_validation->run() == true) {
		 	
			if ($editId) {
			$update				= _DB_update($this->tables['attributes'], array('attribute_name' => $attribute_name, 'status' => $attribute_status), array('entity_id' => $editId));
				if ($update) {
				 $this->session->set_flashdata('message', "Attribute '<strong>$attribute_name</strong>' has been updated successfully.");
				$this->session->set_flashdata('message_type', 'success');
				redirect('manage/menu_attribute', 'refresh');
			} else {
				 $this->session->set_flashdata('message', "Oops! Something went wrong. Try again later");
				 $this->session->set_flashdata('message_type', 'danger');
				 redirect('manage/menu_attribute', 'refresh');
			}
			} else {
				$insert				= _DB_insert($this->tables['attributes'], array('attribute_name' => $attribute_name, 'status' => $attribute_status));
				if ($insert) {
				 $this->session->set_flashdata('message', "Attribute '<strong>$attribute_name</strong>' has been Added successfully.");
				$this->session->set_flashdata('message_type', 'success');
				redirect('manage/menu_attribute', 'refresh');
			} else {
				 $this->session->set_flashdata('message', "Oops! Something went wrong. Try again later");
				 $this->session->set_flashdata('message_type', 'danger');
				 redirect('manage/menu_attribute', 'refresh');
			}
			}
			
			} else {
				 $this->session->set_flashdata('message', validation_errors());
				 $this->session->set_flashdata('message_type', 'danger'); 
			}
			$this->add_data(compact('attribute_name', 'attribute_status'));
			redirect('manage/add_attribute', 'refresh');
	}
	
	#list menu categories
	function menu_categories() {
		$allCategories				= $this->manage_model->get_categories();
		$this->data['categories']	= $allCategories;
		$this->render('manage-menu-categories');
	}
	
	#add new category
	function add_category() {
		$this->data['attributes']		= _DB_data($this->tables['attributes'], array('status' => 1), null, null, null);
		$this->render('add-menu-category');
	}
	
	#sumbit category
	function submit_category() {
		$dateTime				= date('Y-m-d H:i:s');		
		$editId					= $this->input->post('edit_id', true);
		if (!$editId) {
		$this->form_validation->set_rules('category_name','Category Name','trim|required|is_unique[category_entity.entity_name]');
		} else {
			$this->form_validation->set_rules('category_name','Category Name','trim|required');
		}
		$this->form_validation->set_rules('attribute_name','Attribute','trim|required');
		$this->form_validation->set_rules('category_status','Category Status','trim|required');
		$category_name			= $this->input->post('category_name', true);
		$attribute_id			= $this->input->post('attribute_name', true);
		$category_status		= $this->input->post('category_status', true);
		if ($this->form_validation->run() == true) {
		 	
			if ($editId) {
			$update				= _DB_update($this->tables['category_entity'], array('attribute_id' => $attribute_id, 'entity_name' => $category_name,  'updated_at' => $dateTime, 'status' => $category_status), array('entity_id' => $editId));
				if ($update) {
				 $this->session->set_flashdata('message', "Category '<strong>$category_name</strong>' has been updated successfully.");
				$this->session->set_flashdata('message_type', 'success');
				redirect('manage/menu_categories', 'refresh');
			} else {
				 $this->session->set_flashdata('message', "Oops! Something went wrong. Try again later");
				 $this->session->set_flashdata('message_type', 'danger');
				 redirect('manage/menu_categories', 'refresh');
			}
			} else {
				$insert				= _DB_insert($this->tables['category_entity'], array('attribute_id' => $attribute_id, 'entity_name' => $category_name, 'created_at' => $dateTime, 'status' => $category_status));
				if ($insert) {
				 $this->session->set_flashdata('message', "Category '<strong>$category_name</strong>' has been Added successfully.");
				$this->session->set_flashdata('message_type', 'success');
				redirect('manage/menu_categories', 'refresh');
			} else {
				 $this->session->set_flashdata('message', "Oops! Something went wrong. Try again later");
				 $this->session->set_flashdata('message_type', 'danger');
				 redirect('manage/menu_categories', 'refresh');
			}
			}
			
			} else {
				 $this->session->set_flashdata('message', validation_errors());
				 $this->session->set_flashdata('message_type', 'danger'); 
			}
			$this->add_data(compact('attribute_name', 'attribute_status'));
			redirect('manage/add_category', 'refresh');
	}
	
	#load edit category
	function edit_category($catId	= NULL) {
		if ($catId) {
			
			$get_data					= _DB_get_record($this->tables['category_entity'], array('entity_id' => $catId));
			$attributes					= _DB_data($this->tables['attributes'], array('status' => 1), null, null, null);
			$this->add_data(compact('get_data', 'attributes'));
			$this->render('add-menu-category');
			
		} else {
			$this->session->set_flashdata('message', "Oops! something went wrong. Try again later.");
			$this->session->set_flashdata('message_type', 'danger');
			redirect('manage/menu_categories', 'refresh');
		}
	}

	#list table categories
	function table_categories() {
		//$allCategories				= $this->manage_model->get_table_categories();
		$allCategories					= _DB_data($this->tables['table_category'], null, null, null, null);

		$this->data['categories']	= $allCategories;
		$this->render('manage-table-categories');
	}

	#add new table category
	function add_table_category() {
		
		$this->render('add-table-category');
	}

	#sumbit table category
	function submit_table_category() {
		$dateTime				= date('Y-m-d H:i:s');		
		$editId					= $this->input->post('edit_id', true);
		if (!$editId) {
		$this->form_validation->set_rules('category_name','Category Name','trim|required|is_unique[table_category.name]');
		} else {
			$this->form_validation->set_rules('category_name','Category Name','trim|required');
		}
		$this->form_validation->set_rules('category_status','Category Status','trim|required');
		$category_name			= $this->input->post('category_name', true);		
		$category_status		= $this->input->post('category_status', true);
		if ($this->form_validation->run() == true) {
		 	
			if ($editId) {
			$update				= _DB_update($this->tables['table_category'], array('name' => $category_name,  'updated_at' => $dateTime, 'status' => $category_status), array('id' => $editId));
				if ($update) {
				 $this->session->set_flashdata('message', "Category '<strong>$category_name</strong>' has been updated successfully.");
				$this->session->set_flashdata('message_type', 'success');
				redirect('manage/table_categories', 'refresh');
			} else {
				 $this->session->set_flashdata('message', "Oops! Something went wrong. Try again later");
				 $this->session->set_flashdata('message_type', 'danger');
				 redirect('manage/table_categories', 'refresh');
			}
			} else {
				$insert				= _DB_insert($this->tables['table_category'], array('name' => $category_name, 'created_at' => $dateTime, 'status' => $category_status));
				if ($insert) {
				 $this->session->set_flashdata('message', "Category '<strong>$category_name</strong>' has been Added successfully.");
				$this->session->set_flashdata('message_type', 'success');
				redirect('manage/table_categories', 'refresh');
				} else {
					 $this->session->set_flashdata('message', "Oops! Something went wrong. Try again later");
					 $this->session->set_flashdata('message_type', 'danger');
					 redirect('manage/table_categories', 'refresh');
				}
			}
			
		} else {
			 $this->session->set_flashdata('message', validation_errors());
			 $this->session->set_flashdata('message_type', 'danger'); 
		}		
		redirect('manage/add_table_category', 'refresh');
	}
	

	#load edit tabel category
	function edit_table_category($catId	= NULL) {
		if ($catId) {
			
			$get_data					= _DB_get_record($this->tables['table_category'], array('id' => $catId));			
			$this->add_data(compact('get_data'));
			$this->render('add-table-category');
			
		} else {
			$this->session->set_flashdata('message', "Oops! something went wrong. Try again later.");
			$this->session->set_flashdata('message_type', 'danger');
			redirect('manage/table_categories', 'refresh');
		}
	}

	#list table details
	function table_details() {
		$allTabels				= $this->manage_model->get_tables();
		$this->data['tables']	= $allTabels;
		$this->render('manage-table-details');
	}
	
	#add new table details
	function add_table_details() {
		$this->data['category']		= _DB_data($this->tables['table_category'], array('status' => 1), null, null, null);
		$this->render('add-table-details');
	}
	
	#sumbit table details
	function submit_table_details() {
		$dateTime				= date('Y-m-d H:i:s');		
		$editId					= $this->input->post('edit_id', true);
		if (!$editId) {
		$this->form_validation->set_rules('table_number','Table Number','trim|required|is_unique[table_details.table_number]');
		} else {
			$this->form_validation->set_rules('table_number','Table Number','trim|required');
		}
		$this->form_validation->set_rules('capacity','Capacity','trim|required');
		$this->form_validation->set_rules('table_category','Table Category','trim|required');
		$this->form_validation->set_rules('table_status','Status','trim|required');
		$table_number			= $this->input->post('table_number', true);
		$capacity				= $this->input->post('capacity', true);
		$table_category			= $this->input->post('table_category', true);
		$table_status			= $this->input->post('table_status', true);
		if ($this->form_validation->run() == true) {
		 	
			if ($editId) {
			$update				= _DB_update($this->tables['table_details'], array('table_cat_id' => $table_category,'table_number' => $table_number, 'capacity' => $capacity,  'updated_at' => $dateTime, 'status' => $table_status), array('id' => $editId));
				if ($update) {
				 $this->session->set_flashdata('message', "Table '<strong>$table_number</strong>' has been updated successfully.");
				$this->session->set_flashdata('message_type', 'success');
				redirect('manage/table_details', 'refresh');
			} else {
				 $this->session->set_flashdata('message', "Oops! Something went wrong. Try again later");
				 $this->session->set_flashdata('message_type', 'danger');
				 redirect('manage/table_details', 'refresh');
			}
			} else {
				$insert				= _DB_insert($this->tables['table_details'], array('table_cat_id' => $table_category, 'table_number' => $table_number, 'capacity' => $capacity, 'created_at' => $dateTime, 'status' => $table_status));
				if ($insert) {
				 $this->session->set_flashdata('message', "Table '<strong>$table_number</strong>' has been Added successfully.");
				$this->session->set_flashdata('message_type', 'success');
				redirect('manage/table_details', 'refresh');
			} else {
				 $this->session->set_flashdata('message', "Oops! Something went wrong. Try again later");
				 $this->session->set_flashdata('message_type', 'danger');
				 redirect('manage/table_details', 'refresh');
			}
			}
			
			} else {
				 $this->session->set_flashdata('message', validation_errors());
				 $this->session->set_flashdata('message_type', 'danger'); 
			}
			
			redirect('manage/add_table_details', 'refresh');
	}
	
	#load edit table details
	function edit_table_details($tabId	= NULL) {
		if ($tabId) {
			
			$get_data					= _DB_get_record($this->tables['table_details'], array('id' => $tabId));
			$category					= _DB_data($this->tables['table_category'], array('status' => 1), null, null, null);
			$this->add_data(compact('get_data', 'category'));
			$this->render('add-table-details');
		} else {
		$this->session->set_flashdata('message', "Oops! something went wrong. Try again later.");
		$this->session->set_flashdata('message_type', 'danger');
		redirect('manage/table_details', 'refresh');
		}
	}

	#list menus
	function manage_menu() {
		$this->data['menus']		= $this->manage_model->get_menus();
		$this->render('manage-menus');
	}
	
	#add new menu
	function add_menu() {
		$this->data['categories']	= _DB_data($this->tables['category_entity'], array('status' => 1), null, null, null);
		$this->render('add-menu');
	}
	
	#insert menu
	function submit_menu() {
		$dateTime					= date('Y-m-d H:i:s');	
		$editId						= $this->input->post('edit_id', true);
		if (!$editId) {
			$this->form_validation->set_rules('menu_name','Menu Name','trim|required|is_unique[menu_entity.menu_name]');
		} else {
			$this->form_validation->set_rules('menu_name','Menu Name','trim|required');
		}
		$this->form_validation->set_rules('category','Category','trim|required');
		if ($this->form_validation->run() == true) {
				$menuName			= $this->input->post('menu_name', true);
				$category			= $this->input->post('category', true);
				$status				= $this->input->post('menu_status', true);
				$ingredients		= $this->input->post('ingredients', true);
				
				if (!$editId) {
				$insert				= _DB_insert($this->tables['menu_entity'], array('category_id' => $category, 'menu_name' => $menuName, 'created_at' => $dateTime, 'updated_at' => $dateTime, 'status' => $status));
				if ($insert) {
					$menuId			= _DB_insert_id();
					if (!empty($ingredients)) {
						foreach ($ingredients as $inds) {
							_DB_insert($this->tables['menu_entity_ingredients'], array('menu_id' => $menuId, 'ingredient_name' => $inds));
						}
					}
					$this->session->set_flashdata('message', "Menu has been addedd successfully");
					$this->session->set_flashdata('message_type', 'success');
					redirect('manage/manage_menu', 'refresh');
				} else {
					$this->session->set_flashdata('message', "Oops something went wrong try again later");
					$this->session->set_flashdata('message_type', 'danger');
					redirect('manage/add_menu', 'refresh');
				}
		} else {
			$update				= _DB_update($this->tables['menu_entity'], array('category_id' => $category, 'menu_name' => $menuName, 'updated_at' => $dateTime, 'status' => $status), array('entity_id' => $editId));
				if ($update) {
					#update ingredients
					if (!empty($ingredients)) {
						$getAllIngredients		= _DB_data($this->tables['menu_entity_ingredients'], null, null, null, null);
						$tmp					= array();
						foreach ($getAllIngredients as $allIngredients) {
							$tmp[]				= $allIngredients['ingredient_id'];
						}
						foreach ($ingredients as $key => $inds) {
							if (in_array($key, $tmp)) {
							_DB_update($this->tables['menu_entity_ingredients'], array( 'ingredient_name' => $inds), array('ingredient_id' => $key, 'menu_id' => $editId));
							} else {
								_DB_insert($this->tables['menu_entity_ingredients'], array('menu_id' => $editId, 'ingredient_name' => $inds));
							}
						}
					}
					
					$this->session->set_flashdata('message', "Menu has been updated successfully");
					$this->session->set_flashdata('message_type', 'success');
					redirect('manage/manage_menu', 'refresh');
				} else {
					$this->session->set_flashdata('message', "Oops something went wrong try again later");
					$this->session->set_flashdata('message_type', 'danger');
					redirect('manage/add_menu', 'refresh');
				}
		}
			 } else {
			 		$this->session->set_flashdata('message', validation_errors());
					$this->session->set_flashdata('message_type', 'danger');
					redirect('manage/add_menu', 'refresh');
			 }
		
	}
	
	#edit menu
	function edit_menu($menu = NULL) {
		
		if ($menu) {
			$get_data					= _DB_get_record($this->tables['menu_entity'], array('entity_id' => $menu));
			$categories					= _DB_data($this->tables['category_entity'], array('status' => 1), null, null, null);
			$ingredients				= _DB_data($this->tables['menu_entity_ingredients'], array('menu_id' => $menu), null, null, null);
			$this->add_data(compact('get_data', 'categories', 'ingredients'));
			$this->render('add-menu');
			redirect('manage/manage_menu', 'refresh');
		} else {
			$this->session->set_flashdata('message', "Oops! something went wrong. Try again later.");
			$this->session->set_flashdata('message_type', 'danger');
			redirect('manage/manage_menu', 'refresh');
		}
	}

	#get user details
	public function get_userDetails($userId  = null){

		$get_data 	= $this->manage_model->get_user_details();
		$userData="";
		foreach ($get_data as $rows) {
			$userData .='<tr class="odd gradeX" >
			<td>'. stripslashes($rows['first_name']).'</td>
			<td>'. stripslashes($rows['user_type']).'</td>
			<td>'. stripslashes($rows['username']).'</td>
            <td>'. stripslashes($rows['email']).'</td>					
			<td><a href="#" class="btn btn-warning btn-xs" onclick="edit_userDetails('.$rows['id'].')""><i class="fa fa-edit"></i> Edit</a></td>';
			if(($rows['id'] != 1) && ($rows['username'] != 'administrator')){
				$userData.='<td id="td_id_'.$rows['id'].'" ><a href="#" class="btn btn-warning btn-xs btn_delete" onclick="deleteUser('.$rows['id'].')"><i class="fa fa-edit"></i> Delete</a></td>';
			}
		$userData.='</tr>';

			

			
		}
		
			$data = array('userData'=>$userData);
			print_r(json_encode($data));

		
				
	}

	#load edit user_details
	public function edit_userDetails($userId=null){
		
		$get_data 	= $this->manage_model->get_user_details($userId);
		
		$userData="";
		foreach ($get_data as $rows) {
			
		
		$userData.='
				<div class="row" id="editsuccessMessages" style="display:none">
					<div class="col-lg-12 col-sm-offset-12">
		            	<div class="alert alert-danger" ></div>
		          	</div>					
				</div>
				
				<!-- <form id="registerForm"> -->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<input type="hidden" class="form-control" placeholder="First Name" name="user_id" id="user_id" value="'.$rows['id'].'"  />
						</div>
					</div>					
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="First Name" name="firstName" id="firstName" value="'.$rows['first_name'].'" required />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Last Name" name="lastName" id="lastName" value="'.$rows['last_name'].'" required />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="User Name" name="userName" id="userName" value="'.$rows['username'].'" required />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<input type="number" class="form-control" placeholder="Phone" name="phone" id="phone" value="'.$rows['phone'].'"   required />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<input type="password" class="form-control" placeholder="Password" name="password" id="password" value="'.$rows['password'].'" required readonly />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<input type="password" class="form-control" placeholder="Confirm Password" name="confPassword" id="confPassword" value="'.$rows['password'].'"  readonly required />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<input type="email" class="form-control" placeholder="Email" name="email" id="email" value="'.$rows['email'].'" required />
						</div>
						<div class="form-group">
							<textarea class="form-control" placeholder="Address" rows="5" id="address" name="address" required>'.$rows['company'].'</textarea>
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
			';
			}
		$data = array('userData'=>$userData);
		print_r(json_encode($data));


	}

	#edit user_details
	public function edit_user($Id=null){
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) { // Check whether the user is already logged-in and is admin 
			
		$this->load->library('form_validation');
		$this->form_validation->set_rules('userName', 'user name', 'trim|required|min_length[5]|max_length[12]|alpha');
		//$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
		//$this->form_validation->set_rules('confPassword', 'Confirm password', 'trim|matches[password]');
		$this->form_validation->set_rules('email', 'email address', 'trim|required|valid_email');
		$this->form_validation->set_rules('phone', 'Phone Number', 'required|integer|min_length[10]|max_length[12]');
		$this->form_validation->set_rules('firstName', 'First name', 'required');
		$this->form_validation->set_rules('lastName', 'Last name', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');

		$this->form_validation->set_rules('userType', 'user type', 'required');
		if ($this->form_validation->run() == true) {
			
			$user_id 			= $this->input->post('user_id');
			$userName			= $this->input->post('userName');
			// $password			= $this->input->post('password');
			// $confpassword 		= $this->input->post('confpassword');
			$email 				= $this->input->post('email');
			$fisrtName			= $this->input->post('firstName');
			$lastName			= $this->input->post('lastName');
			$userGroup			= $this->input->post('userType');
			$phone 				= $this->input->post('phone');
			$address 			= $this->input->post('address');
			$additionalData 	= array(
								'first_name' => $fisrtName,
								'last_name' => $lastName,
								'company'	=> $address,
								'phone' 	=> $phone
								);
			$group 				= array($userGroup); // Sets user.

			if($userGroup == 2){
				$userType = 'cashier';
			} elseif($userGroup == 3){
				$userType = 'waiter';
			}

			$userUpdate = _DB_update($this->tables['users'], array('first_name' => $fisrtName, 'last_name' => $last_name, 'email' => $email,  'company' => $address, 'phone' => $phone), array('id' => $user_id));
			$userUpdateGroup = _DB_update($this->tables['users_groups'], array('group_id' => $userGroup), array('id' => $user_id));


			
			if ($userUpdate) {
				//$user_id = _DB_insert_id();

				$userData="";
				// $this->session->set_flashdata('message', $this->ion_auth->messages());
				// $this->session->set_flashdata('message_type', 'success');
				// redirect('manage/', 'refresh');

				$userData .='<tr class="odd gradeX" >
					<td>'. stripslashes($fisrtName).'</td>
					<td>'. stripslashes($userType).'</td>
					<td>'. stripslashes($userName).'</td>
		            <td>'. stripslashes($email).'</td>					
					<td><a href="#" class="btn btn-warning btn-xs" onclick="edit_userDetails('.$user_id.')"><i class="fa fa-edit"></i> Edit</a></td>';
					if($user_id != 1){
						$userData.='<td id="td_id_'.$user_id.'" ><a href="#" class="btn btn-warning btn-xs btn_delete" onclick="deleteUser('.$user_id.')"><i class="fa fa-edit"></i> Delete</a></td>';
					}
				$userData.='</tr>';
				$data 	= array('message' => 'Data updated successfully',
								'message_type' => 'success',
								'userData'  => $userData
								);
				print_r(json_encode($data));
			} else {
				// $this->session->set_flashdata('message', $this->ion_auth->errors());
				// $this->session->set_flashdata('message_type', 'danger');
				$data 	= array('message' => 'error',
								'message_type' => 'danger'
								);
				print_r(json_encode($data));
			}
				
			} else {
				$data 	= array('message' => validation_errors(),
								'message_type' => 'danger'
								);
				print_r(json_encode($data));

			}
			
		}
	}
}