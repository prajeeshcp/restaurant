<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Manage_model extends CI_Model 
{	
	public function __construct()
	{
		parent::__construct();
	}
	#get all categories
	public function get_categories() { 
		 return $this->db->select('cat.*, attr.attribute_name')
						->from("category_entity cat")
						->join("attributes attr", "cat.attribute_id = attr.entity_id", "left")
						->order_by('cat.entity_id', 'desc')
						->get()->result_array();
		}

	public function get_tables() { 
		 return $this->db->select('td.*, tc.name as category')
						->from("table_details td")
						->join("table_category tc", "tc.id = td.table_cat_id", "left")
						->order_by('td.id', 'desc')
						->get()->result_array();
		}
		
	#get all menus
	public function get_menus() {
		 return $this->db->select('menu.*, cat.entity_name')
						->from("menu_entity menu")
						->join("category_entity cat", "menu.category_id = cat.entity_id", "left")
						->order_by('menu.entity_id', 'desc')
						->get()->result_array();
	}
		
	#get all user_details
	public function get_user_details($id=null) {
		// select u.*, g.name as user_type from users u join users_groups ug on u.id = ug.user_id join groups g on ug.group_id = g.id where active=1 
		 if(!empty($id)){
		 	return $this->db->select('u.*, g.name as user_type')
						->from("users u")
						->join("users_groups ug", "u.id = ug.user_id")
						->join("groups g", "ug.group_id = g.id")
						->where("active",1)
						->where('u.id',$id)
						->order_by('u.id')
						->get()->result_array();

		 } else {
		 	return $this->db->select('u.*, g.name as user_type')
						->from("users u")
						->join("users_groups ug", "u.id = ug.user_id")
						->join("groups g", "ug.group_id = g.id")
						->where("active",1)
						->order_by('u.id')
						->get()->result_array();
		 }
		 
	}
	
}