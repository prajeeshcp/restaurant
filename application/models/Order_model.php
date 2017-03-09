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
		->where("odr.table_id", $tableId)
		->where("odr.user_id !=", $userId)
		->where("odr.status", 'pending')
		->where("odr.status", 'processing')
		->get()->row();
	}
	
	#get all the pending and processing order of logged user
	// function processing_orders($userId	= NULL, $table = NULL) {
	// 	return $this->db->select('odr.*, item.*')
	// 	->from('order_entity odr')
	// 	->join('order_entity_items item', 'odr.entity_id = item.order_id', 'left')
	// 	->where('odr.user_id', $userId)
	// 	->where('odr.table_id', $table)
	// 	->where("odr.status", 'pending')
	// 	->or_where("odr.status", 'processing')
	// 	->get()->result_array();
		
	// }

	function processing_orders($userId	= NULL,$table = NULL) {
		return $this->db->select('*')
		->from('order_entity')
		->where("table_id", $table)
		->where('user_id', $userId)		
		->where("status", 'pending')
		->or_where("status", 'processing')		
		->get()->result_array();
		
	}

	#get all the pending and processing order of logged user
	function processing_odr_cashier($userId	= NULL) {
		return $this->db->select('*')
		->from('order_entity')		
		->where("is_bill", 1)		
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
	
	#to get sum of all the order items 
	function sum_of_order($orderId = NULL) {
		return 	$this->db->select('SUM(qty_ordered) qty_ordered, SUM(tax_amount) tax_amount, SUM(row_total) row_total, SUM(row_total_incld_tax) row_incld_tax')
				 ->from('order_entity_items')
				 ->where('order_id', $orderId)
				 ->get()->row();	
	}
	
	#sum of the KOT qty
	function sum_of_kot($kotId = NULL) {
		return 	$this->db->select('SUM(qty_ordered) qty_ordered')
				 ->from('kot_entity_items')
				 ->where('kot_id', $kotId)
				 ->get()->row();	
	}
	function kot_details($kot_id = NULL,$flag=NULL) {
		if ($kot_id && empty($flag)) {
		return $this->db->select('kot.*, item.item_id,item.kot_id, item.menu_id, item.order_type, item.is_kot, item.price_type, item.name, item.qty_ordered, item.created_at')
				 ->from('kot_entity kot')
				 ->join('kot_entity_items item', 'kot.entity_id = item.kot_id', 'left')
				 ->where('kot.entity_id', $kot_id)
				 ->get()->result_array();
		} else {
			return $this->db->select('kot.*, item.item_id,item.kot_id, item.menu_id, item.order_type, item.is_kot, item.price_type, item.name, item.qty_ordered, item.created_at')
				 ->from('kot_entity kot')
				 ->join('kot_entity_items item', 'kot.entity_id = item.kot_id', 'left')
				 ->where('kot.entity_id', $kot_id)
				 ->where('item.is_kot',0)
				 ->get()->result_array();
		}
	}

	function bill_details($order_id = NULL) {
		if ($order_id) {	

		return $this->db->select('ord.*, ord_ent.*,kot.entity_id as kot_id')
				 ->from('order_entity ord')
				 ->join('order_entity_items ord_ent', 'ord.entity_id = ord_ent.order_id')
				 ->join('kot_entity kot', 'kot.order_id = ord.entity_id')
				 ->where('ord.entity_id', $order_id)
				 ->get()->result_array();
		}
	}
}