<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
	
	function get_available_tables() { // get all the tables which is availabe exclude main
		 return $this->db->select("table.*, cat.id, cat.name")
		->from("table_details table")
		->join("table_category cat", "table.table_cat_id = cat.id", "left")
		->where("table.status",1)
		->where("table.table_cat_id !=",1)
		->order_by("table.id", "asc")
		->get()->result_array();
		//echo $str = $this->db->last_query(); exit;	
	}
	
	#check whether table is under taken
	function check_table($tableId = NULL, $userId = NULL) {
		 return $this->db->select("odr.entity_id as check_order_id")
		->from("order_entity odr")
		->where("odr.table_id",$tableId)
		->where("odr.user_id !=", $userId)
		->where("odr.status", 'pending')
		->or_where("odr.status", 'processing')
		->get()->row();
	}
	
	#get all the pending and processing order of logged user
	function processing_orders($userId	= NULL, $table = NULL) {
		return $this->db->select('odr.*, item.*')
		->from('order_entity odr')
		->join('order_entity_items item', 'odr.entity_id = item.order_id', 'left')
		->where('odr.user_id', $userId)
		->where('odr.table_id', $table)
		->where("odr.status", 'pending')
		->or_where("odr.status", 'processing')
		->get()->result_array();
		
	}
	
	#get all the active menus
	function get_active_menus(){
		return $this->db->select('menu.*,cat.entity_name, attr.attribute_name')
				 ->from('menu_entity menu')
				 ->join('category_entity cat', 'menu.category_id = cat.entity_id', 'left')
				 ->join('attributes attr', 'cat.attribute_id = attr.entity_id', 'left')
				 ->where('menu.status', 1)
				 ->or_where('menu.status',3)
				// ->group_by('menu.category_id')
				 ->get()->result_array();	
	}
	
	#get max of increment id
	function max_increment_id($tableName = NULL) {
		if ($tableName) {
			return $this->db->select('MAX(increment_id) increment_id')
							->from($tableName)
							->get()->row();
		} else {
			return 0;
		}
	}
	
	function kot_details($kot_id = NULL) {
		if ($kot_id) {
		return $this->db->select('kot.*, item.table_id, item.menu_id, item.order_type, item.price_type, item.name, item.qty_ordered, item.created_at')
				 ->from('kot_entity kot')
				 ->join('kot_entity_items item', 'kot.entity_id = item.kot_id', 'left')
				 ->where('kot.entity_id', $kot_id)
				 ->get()->result_array();
		}
	}
}