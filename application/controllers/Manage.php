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
		$this->load->model('order_model');
		$this->data['message'] 			= $this->session->flashdata('message');
		$this->data['message_type'] 	= $this->session->flashdata('message_type');
	}
	
	public function index($page = NULL) {
		$tableDtil						= $this->order_model->get_available_tables();
		$loggedUser 					= $this->ion_auth->user()->row();
		foreach($tableDtil as $key => $table) {
			$checkOrder					=  $this->order_model->check_table($table['id'], $loggedUser->id);
			if (!empty($checkOrder)) {
				unset($tableDtil[$key]);
			}
		}
		$this->data['table_dtil']		= $tableDtil;
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
		$allCategories					= _DB_data($this->tables['table_category'], null, null, null, array('id','desc'));

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
		$this->data['price_types']	= _DB_data($this->tables['menu_entity_price_type'], array('status' => 1), null, null, null);
		$this->data['tax_class']	= _DB_data($this->tables['tax_entity'], array('status' => 1), null, null, null);
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
				$taxClass			= $this->input->post('tax_class', true);
				$status				= $this->input->post('menu_status', true);
				$ingredients		= $this->input->post('ingredients', true);
				$price_types		= _DB_data($this->tables['menu_entity_price_type'], array('status' => 1), null, null, null);
				if (!$editId) {
				$insert				= _DB_insert($this->tables['menu_entity'], array('category_id' => $category, 'menu_name' => $menuName, 'tax_class' => $taxClass, 'created_at' => $dateTime, 'updated_at' => $dateTime, 'status' => $status));
				if ($insert) {
					$menuId			= _DB_insert_id();
					if (!empty($price_types)) {
						foreach ($price_types as $types) {
							$pricetyp	= $this->input->post('price_type_'.$types['entity_id'], true);
							$priceAmt	=  $this->input->post('price_amt_'.$types['entity_id'], true);
							if ($pricetyp) {
								_DB_insert($this->tables['menu_entity_price'], array('menu_id' => $menuId, 'price_type' => $pricetyp, 'price_amount' => $priceAmt));
							}
						}
					}
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
			$update				= _DB_update($this->tables['menu_entity'], array('category_id' => $category, 'menu_name' => $menuName, 'tax_class' => $taxClass, 'updated_at' => $dateTime, 'status' => $status), array('entity_id' => $editId));
				if ($update) {
					#update ingredients
					if (!empty($ingredients)) {
						if (!empty($price_types)) {
						foreach ($price_types as $types) {
							$pricetyp	= $this->input->post('price_type_'.$types['entity_id'], true);
							$priceAmt	=  $this->input->post('price_amt_'.$types['entity_id'], true);
							if ($pricetyp) {
								$checkPrice		= _DB_get_record($this->tables['menu_entity_price'], array('menu_id' => $editId, 'price_type' => $pricetyp));
								if (empty($checkPrice)) {
								_DB_insert($this->tables['menu_entity_price'], array('menu_id' => $editId, 'price_type' => $pricetyp, 'price_amount' => $priceAmt));
								} else {
									_DB_update($this->tables['menu_entity_price'], array('price_type' => $pricetyp, 'price_amount' => $priceAmt), array('menu_id' => $editId, 'price_type' => $pricetyp));
								}
							}
						}
					}
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
			$this->data['price_types']	= _DB_data($this->tables['menu_entity_price_type'], array('status' => 1), null, null, null);
			$this->data['tax_class']	= _DB_data($this->tables['tax_entity'], array('status' => 1), null, null, null);
			$priceList					= _DB_data($this->tables['menu_entity_price'], array('menu_id' => $menu), null, null, null);
			$price_list 				= array();
			foreach ($priceList as $price) {
				$price_list[$price['price_type']]	= $price['price_amount'];
			}
			$this->add_data(compact('get_data', 'categories', 'ingredients', 'price_list'));
			$this->render('add-menu');
			
		} else {
			$this->session->set_flashdata('message', "Oops! something went wrong. Try again later.");
			$this->session->set_flashdata('message_type', 'danger');
			redirect('manage/manage_menu', 'refresh');
		}
	
	}

	#get user details
	public function get_userDetails($userId  = null){

		$get_data 	= $this->manage_model->get_user_details();
		$get_groups = _DB_data($this->tables['groups'], null, null, null, null);

		// print_r($get_groups);
		// die();
		$userData="";
		foreach ($get_data as $rows) {
			$userData .='<tr class="odd gradeX" >
			<td>'. stripslashes($rows['first_name']).'</td>
			<td>'. stripslashes($rows['user_type']).'</td>
			<td>'. stripslashes($rows['username']).'</td>
            <td>'. stripslashes($rows['email']).'</td>					
			';
			if(($rows['id'] != 1) && ($rows['username'] != 'administrator')){
				$userData.='
				<td><a href="#" class="btn btn-warning btn-xs" onclick="edit_userDetails('.$rows['id'].')""><i class="fa fa-edit"></i> Edit</a></td>
				<td id="td_id_'.$rows['id'].'" ><a href="#" class="btn btn-warning btn-xs btn_delete" onclick="deleteUser('.$rows['id'].')"><i class="fa fa-edit"></i> Delete</a></td>';
			}
		$userData.='</tr>';			
		}		
		$data = array('userData'=>$userData,
					  'userGroups' => $get_groups);
		print_r(json_encode($data));				
	}

	#load edit user_details
	public function loadEditUserDetails($userId=null){

		
		$get_data 	= $this->manage_model->get_user_details($userId);
		$get_groups = _DB_data($this->tables['groups'], null, null, null, null);

		
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
							<input type="hidden" class="form-control" placeholder="First Name" name="edituser_id" id="edituser_id" value="'.$rows['id'].'"  />
						</div>
					</div>					
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="First Name" name="editfirstName" id="editfirstName" value="'.$rows['first_name'].'" required />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Last Name" name="editlastName" id="editlastName" value="'.$rows['last_name'].'" required />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="User Name" name="edituserName" id="edituserName" value="'.$rows['username'].'" required />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<input type="number" class="form-control" placeholder="Phone" name="editphone" id="editphone" value="'.$rows['phone'].'"   required />
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<input type="email" class="form-control" placeholder="Email" name="editemail" id="editemail" value="'.$rows['email'].'" required />
						</div>
						<div class="form-group">
							<textarea class="form-control" placeholder="Address" rows="5" id="editaddress" name="editaddress" required>'.$rows['company'].'</textarea>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="category"> User Type</label>
							<select class="form-control" id="edituserType" name="edituserType" >
								';

								$options = '<option value="0">Select A Type</option>';

				             	foreach($get_groups as $group_row) {
				             	  if($group_row['id'] != 1){
				             	  (!empty($rows['user_type']) && $rows['user_type']===$group_row['name']) ? $selected=' selected="selected" ' : $selected='';			            
				             	  	$options.= '<option '.$selected. ' value="' . $group_row["id"] . '">' . $group_row["name"] . '</option>';
				             	  }	
				                  
				             	 }
				              	$closeSelect = '</select>';

					$userData.=$options.$closeSelect;
					$userData.='</select>
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

	#load edit userprofile details of logined user
	public function loadeditUserProfile(){

		$userId = $this->ion_auth->get_user_id();		
		$get_data 	= $this->manage_model->get_user_details($userId);		
		$editUserData="";
		foreach ($get_data as $rows) {			
		
		$editUserData.='
				<div class="row" id="editProfilesuccessMessage" style="display:none">
					<div class="col-lg-12 col-sm-offset-12">
		            	<div class="alert alert-danger" ></div>
		          	</div>					
				</div>
				
				<!-- <form id="registerForm"> -->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<input type="hidden" class="form-control" placeholder="First Name" name="editProfileuser_id" id="editProfileuser_id" value="'.$rows['id'].'"  />
						</div>
					</div>					
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="First Name" name="editProfilefirstName" id="editProfilefirstName" value="'.$rows['first_name'].'" required />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Last Name" name="editProfilelastName" id="editProfilelastName" value="'.$rows['last_name'].'" required />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="User Name" name="editProfileuserName" id="editProfileuserName" value="'.$rows['username'].'" required />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<input type="number" class="form-control" placeholder="Phone" name="editProfilephone" id="editProfilephone" value="'.$rows['phone'].'"   required />
						</div>
					</div>
				</div>				
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<input type="email" class="form-control" placeholder="Email" name="editProfileemail" id="editProfileemail" value="'.$rows['email'].'" required />
						</div>
						<div class="form-group">
							<textarea class="form-control" placeholder="Address" rows="5" id="editProfileaddress" name="editProfileaddress" required>'.$rows['company'].'</textarea>
						</div>
					</div>
				</div>		
				
			';
			}
		$data = array('editUserData'=>$editUserData);
		print_r(json_encode($data));
	}

	#edit user_details
	public function edit_user($flag=null){
		if ($this->ion_auth->logged_in()) { // Check whether the user is already logged-in 
			
		$this->load->library('form_validation');
		$this->form_validation->set_rules('userName', 'user name', 'trim|required|min_length[5]|max_length[15]|alpha');		
		$this->form_validation->set_rules('email', 'email address', 'trim|required|valid_email');
		$this->form_validation->set_rules('phone', 'Phone Number', 'required|integer|min_length[10]|max_length[12]');
		$this->form_validation->set_rules('firstName', 'First name', 'required');
		$this->form_validation->set_rules('lastName', 'Last name', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		if(empty($flag)){
			$this->form_validation->set_rules('userType', 'user type', 'required');
		}		
		if ($this->form_validation->run() == true) {
			
			$user_id 			= $this->input->post('user_id');
			$userName			= $this->input->post('userName');
			// $password			= $this->input->post('password');
			// $confpassword 		= $this->input->post('confpassword');
			$email 				= $this->input->post('email');
			$fisrtName			= $this->input->post('firstName');
			$lastName			= $this->input->post('lastName');
			if(empty($flag)){
				$userGroup			= $this->input->post('userType');
			}
			
			$phone 				= $this->input->post('phone');
			$address 			= $this->input->post('address');
			$additionalData 	= array(
								'first_name' => $fisrtName,
								'last_name' => $lastName,
								'company'	=> $address,
								'phone' 	=> $phone
								);
			if(empty($flag)){
				$group 				= array($userGroup); // Sets user.

				if($userGroup == 2){
					$userType = 'cashier';
				} elseif($userGroup == 3){
					$userType = 'waiter';
				}
			}		

			$userUpdate = _DB_update($this->tables['users'], array('first_name' => $fisrtName, 'last_name' => $lastName, 'username' => $userName, 'email' => $email,  'company' => $address, 'phone' => $phone), array('id' => $user_id));

			if(empty($flag)){
				$userUpdateGroup = _DB_update($this->tables['users_groups'], array('group_id' => $userGroup), array('id' => $user_id));
			}			

			if ($userUpdate && empty($flag)) {
				$userData="";				
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
				
			} else if($userUpdate && !empty($flag)){
				$data 	= array('message' => 'Data updated successfully',
								'message_type' => 'success'
								);
				print_r(json_encode($data));

			} else {
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
	
	#load system config 
	function system_config() {
		$this->data['price_type']	= _DB_data($this->tables['menu_entity_price_type'], null, null, null, array('entity_id', 'desc'));
		$this->data['tax_classes']	= _DB_data($this->tables['tax_entity'], null, null, null, array('entity_id', 'desc'));
		$this->render('system');
	}
	
	#load add price type option
	function add_price_type() {
		$this->render('add-price-type');
	}
	
	#submit price type
	function submit_price_type() {
		$editId						= $this->input->post('edit_id', true);
		if ($editId) {
			$this->form_validation->set_rules('price_type','Price Type Name','trim|required');
		} else {
			$this->form_validation->set_rules('price_type','Price Type Name','trim|required|is_unique[menu_entity_price_type.type_name]');
		}
		$this->form_validation->set_rules('status','Price Type Status','trim|required');
		$priceType					= $this->input->post('price_type', true);
		$status						= $this->input->post('status', true);
		if ($this->form_validation->run() == true) {
			if ($editId) {
				$update				=  _DB_update($this->tables['menu_entity_price_type'], array('type_name' => $priceType, 'status' => $status), array('entity_id' => $editId));
				if ($update) {
					$this->session->set_flashdata('message', "Price type has been updated.");
					$this->session->set_flashdata('message_type', 'success');
					redirect('manage/system_config', 'refresh');
				} else {
					$this->session->set_flashdata('message', "Oops something went wrong. Try again later");
					$this->session->set_flashdata('message_type', 'danger');
					redirect('manage/system_config', 'refresh');
				}
			} else {
				$insert				= _DB_insert($this->tables['menu_entity_price_type'], array('type_name' => $priceType, 'status' => $status));
				if ($insert) {
					$this->session->set_flashdata('message', "Price type has been added.");
					$this->session->set_flashdata('message_type', 'success');
					redirect('manage/system_config', 'refresh');
				
				} else {
					$this->session->set_flashdata('message', "Oops! Something went wrong. Try again later.");
					$this->session->set_flashdata('message_type', 'danger');
					redirect('manage/add_price_type', 'refresh');
				}
			}
		} else {
			$this->session->set_flashdata('message', validation_errors());
			$this->session->set_flashdata('message_type', 'danger');
			redirect('manage/add_price_type', 'refresh');
		}
	}
	
	#load edit price type
	function edit_price_type($editId = NULL) {
		if ($editId) {
			$get_data				= _DB_get_record($this->tables['menu_entity_price_type'], array('entity_id' => $editId));
			$this->data['get_data']	= $get_data;
			$this->render('add-price-type');
		} else {
		$this->session->set_flashdata('message', "Oops! Something went wrong. Try again later.");
		$this->session->set_flashdata('message_type', 'danger');
		redirect('manage/system_config', 'refresh');
		}
	}
	
	#load add tax class
	function add_tax() {
		$this->render('add-tax-class');
	}
	
	#submit tax class
	function submit_tax_class() {
		$editId						= $this->input->post('edit_id', true);
		if ($editId) {
			$this->form_validation->set_rules('tax_class','Tax Class Name','trim|required');
			$this->form_validation->set_rules('tax_rate','Tax Rate','trim|required');
		} else {
			$this->form_validation->set_rules('tax_class','Tax Class Name','trim|required|is_unique[tax_entity.tax_class]');
			$this->form_validation->set_rules('tax_rate','Tax Rate','trim|required|is_unique[tax_entity.tax_rate]');
		}
		$this->form_validation->set_rules('status','Price Status','trim|required');
		$taxClass					= $this->input->post('tax_class', true);
		$taxRate					= $this->input->post('tax_rate', true);
		$status						= $this->input->post('status', true);
		if ($this->form_validation->run() == true) {
			if ($editId) {
				$update				=  _DB_update($this->tables['tax_entity'], array('tax_class' => $taxClass, 'tax_rate' => $taxRate, 'status' => $status), array('entity_id' => $editId));
				if ($update) {
					$this->session->set_flashdata('message', "Tax class has been updated.");
					$this->session->set_flashdata('message_type', 'success');
					redirect('manage/system_config', 'refresh');
				} else {
					$this->session->set_flashdata('message', "Oops something went wrong. Try again later");
					$this->session->set_flashdata('message_type', 'danger');
					redirect('manage/system_config', 'refresh');
				}
			} else {
				$insert				= _DB_insert($this->tables['tax_entity'], array('tax_class' => $taxClass, 'tax_rate' => $taxRate, 'status' => $status));
				if ($insert) {
					$this->session->set_flashdata('message', "Tax calss has been added.");
					$this->session->set_flashdata('message_type', 'success');
					redirect('manage/system_config', 'refresh');
				
				} else {
					$this->session->set_flashdata('message', "Oops! Something went wrong. Try again later.");
					$this->session->set_flashdata('message_type', 'danger');
					redirect('manage/add_tax', 'refresh');
				}
			}
		} else {
			$this->session->set_flashdata('message', validation_errors());
			$this->session->set_flashdata('message_type', 'danger');
			redirect('manage/add_tax', 'refresh');
		}
	}
	
	#load tax edit window
	function edit_tax($editId = NULL) {
		if ($editId) {
			$get_data				= _DB_get_record($this->tables['tax_entity'], array('entity_id' => $editId));
			$this->data['get_data']	= $get_data;
			$this->render('add-tax-class');
		} else {
		$this->session->set_flashdata('message', "Oops! Something went wrong. Try again later.");
		$this->session->set_flashdata('message_type', 'danger');
		redirect('manage/system_config', 'refresh');
		}
	}
	
	#while click on table button for order and view(Load) order page
	function order_desk($tableId = NULL) {
		$this->data['table_id']		= $tableId;
		$loggedUser 				= $this->ion_auth->user()->row();
		if ($tableId) {	
			$checkOrder				= $this->order_model->check_table($tableId, $loggedUser->id);
			if (!empty($checkOrder)) {
				redirect('manage/index', 'refresh');
			} else {
				//check whether pending order is there or what
				$this->data['table_detail']		= _DB_get_record($this->tables['table_details'], array('id' => $tableId));
				$this->data['processing_odr']	= $this->order_model->processing_orders($loggedUser->id, $tableId);
				$this->data['menu_category']	= _DB_data($this->tables['category_entity'], array('status' => 1));
				$this->data['menu_details']		= $this->order_model->get_active_menus();
				$this->data['price_cat_dtil']	= _DB_data($this->tables['menu_entity_price_type'], array('status' => 1));
				$this->render('order-desk');
			}
		} else {
			$this->session->set_flashdata('message', "Oops! Something went wrong. Try again later.");
			$this->session->set_flashdata('message_type', 'danger');
			redirect('manage/index', 'refresh');
		}
	}
	
	#function to create new order
	function create_order() {
		$dateTime					= date('Y-m-d H:i:s');
		$loggedUser 				= $this->ion_auth->user()->row();
		$tableID					= $this->input->post('table_id',true);
		if (!empty($loggedUser) && $tableID) {
			$getMaxOrderId			= $this->order_model->max_increment_id('order_entity');
			if ($getMaxOrderId->increment_id) {
			 	$incrementId		= $getMaxOrderId->increment_id+1;
			 } else {
			 	$incrementId		= 10001;
			 }
			 $status				= 'pending';
			 $insertOrder			= _DB_insert($this->tables['order_entity'], array('status' => $status, 'table_id' => $tableID, 'user_id' => $loggedUser->id, 'increment_id' => $incrementId, ' 	created_at' => $dateTime, 'updated_at' => $dateTime));
			if ($insertOrder) {
				$lastOrder			= _DB_insert_id();
				$getMaxKotId		= $this->order_model->max_increment_id('kot_entity');
				if ($getMaxKotId->increment_id) {
			 	$kotIncrementId		= $getMaxKotId->increment_id+1;
			 } else {
			 	$kotIncrementId		= 10001;
			 }
			
				$createKot			= _DB_insert($this->tables['kot_entity'], array('status' => $status, 'table_id' => $tableID, 'order_id' => $lastOrder, 'increment_id' => $kotIncrementId, 'created_at' => $dateTime, 'updated_at' => $dateTime));
				if ($createKot) {
					$lastKotId		= _DB_insert_id();
				} else {
					$lastKotId		= 0;
				}
				echo '<h1><span class="subscript">ORDER NO</span> "'.$incrementId.'"</h1> <input type="hidden" id="order-id" value="'.$lastOrder.'"><input type="hidden" id="kot-id" value="'.$lastKotId.'">';
			} else {
				echo "Sorry! Something went wrong. Try again later";
			}
		}
	}
	

	#function to manage pending order
	function manage_pending_order() {
		//echo "reached";

		// $kot_id						= $this->input->post('kot_id', true);
		$this->data['order_id']		= $this->input->post('order_id', true);
		$this->data['kot_details']	= $this->order_model->kot_details(80);
		$this->render('ajax/kot_details');
	}

	#to confirm menu from customer
	function confirm_menu($orderType = NULL) {
		$dateTime					= date('Y-m-d H:i:s');
		$order_id					= $this->input->post('order_id', true);
		$menu_id					= $this->input->post('menu_id', true);
		$price_type					= $this->input->post('price_type', true);
		$kot_id						= $this->input->post('kot_id', true); 
		$kot_flag					= $this->input->post('flag', true); 

		if ($orderType) {
			$order_type 			= $orderType;
		} else {
			$order_type 			= 'table';
		}
		if ($order_id && $menu_id && $price_type) {
			$getPrice				= _DB_get_record($this->tables['menu_entity_price'], array('menu_id' => $menu_id, 'price_type' => $price_type));
			
			$typeDtil				=  _DB_get_record($this->tables['menu_entity_price_type'], array('entity_id' => $price_type));
			
			$menuDtil				= _DB_get_record($this->tables['menu_entity'], array('entity_id' => $menu_id));
			$MenuName				= $menuDtil['menu_name']." (".$typeDtil['type_name'].")";
			
			$checkMenu				= _DB_get_record($this->tables['order_entity_items'], array('order_id' => $order_id, 'is_kot' => 0, 'menu_id' => $menu_id, 'price_type' => $price_type));	
			
			if (empty($checkMenu) && $kot_flag != 2 ) {
				$qty				= 1;
				$row_total			= $qty*$getPrice['price_amount'];
				$insertMenu			= _DB_insert($this->tables['order_entity_items'], array('order_id' => $order_id, 'is_kot' => 0, 'menu_id' => $menu_id, 'order_type' => $order_type, 'price_type' => $price_type, 'name' => $MenuName, 'qty_ordered' => $qty, 'price' => $getPrice['price_amount'], 'row_total' => $row_total, 'created_at' => $dateTime, 'updated_at' => $dateTime));
				if ($insertMenu) {
					$insertKOT		= _DB_insert($this->tables['kot_entity_items'], array('kot_id' => $kot_id, 'is_kot' => 0, 'menu_id' => $menu_id, 'order_type' => $order_type, 'price_type' => $price_type, 'name' => $MenuName, 'qty_ordered' => $qty, 'created_at' => $dateTime, 'updated_at' => $dateTime));
					$this->data['order_id']		= $order_id;
					$this->data['kot_details']	= $this->order_model->kot_details($kot_id);
					$this->render('ajax/kot_details');
				}
			} else if(!empty($checkMenu) && $kot_flag != 2) {
				if($kot_flag == 1){
					$qty				= $checkMenu['qty_ordered']-1;

				} else {
					$qty				= $checkMenu['qty_ordered']+1;

				}
				
				$row_total			= $qty*$getPrice['price_amount'];
				$updateMenu			= _DB_update($this->tables['order_entity_items'], array('qty_ordered' => $qty, 'row_total' => $row_total, 'updated_at' => $dateTime), array('item_id' => $checkMenu['item_id']));
				$checkKOT			= _DB_get_record($this->tables['kot_entity_items'],  array('kot_id' => $kot_id, 'is_kot' => 0, 'menu_id' => $menu_id, 'price_type' => $price_type));
				if (!empty($checkKOT)) {
					$updateKOT		= _DB_update($this->tables['kot_entity_items'], array('qty_ordered' => $qty, 'updated_at' => $dateTime), array('item_id' => $checkKOT['item_id']));
				}
				if ($updateMenu) {
					$this->data['order_id']		= $order_id;
					$this->data['kot_details']	= $this->order_model->kot_details($kot_id);
					$this->render('ajax/kot_details');
				}
			} else if(!empty($checkMenu) && $kot_flag == 2){

				$deleteMenu			= _DB_delete($this->tables['order_entity_items'], array('item_id' => $checkMenu['item_id']));
				$checkKOT			= _DB_get_record($this->tables['kot_entity_items'],  array('kot_id' => $kot_id, 'is_kot' => 0, 'menu_id' => $menu_id, 'price_type' => $price_type));
				if (!empty($checkKOT)) {
					$deleteKOT		= _DB_delete($this->tables['kot_entity_items'], array('item_id' => $checkKOT['item_id']));
				}
				if ($deleteMenu) {
					$this->data['order_id']		= $order_id;
					$this->data['kot_details']	= $this->order_model->kot_details($kot_id);					
					if(empty($this->data['kot_details'][0]['kot_id'])){
						echo "null";

					} else {
						$this->render('ajax/kot_details');
					}
					
				}
			}
			
		}
	}

	#to print kot
	function print_kot($orderType = NULL) {

		$dateTime					= date('Y-m-d H:i:s');
		$order_id					= $this->input->post('order_id', true);
		$kot_id						= $this->input->post('kot_id', true); 	

		$updateOrder			= _DB_update($this->tables['order_entity_items'], array('is_kot' => 1, 'updated_at' => $dateTime), array('order_id' => $order_id));

		$updateOrderentity		= _DB_update($this->tables['order_entity'], array('status' => 'processing', 'updated_at' => $dateTime), array('entity_id' => $order_id));

		$updateKOT		= _DB_update($this->tables['kot_entity_items'], array('is_kot' => 1, 'updated_at' => $dateTime), array('kot_id' => $kot_id));

		if($updateOrder && $updateKOT){
			$this->data['order_id']		= $order_id;
			$this->data['kot_details']	= $this->order_model->kot_details($kot_id);
			$this->render('ajax/kot_details');

		}
		



	}
}