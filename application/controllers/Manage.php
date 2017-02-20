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
}