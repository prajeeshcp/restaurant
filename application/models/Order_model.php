<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
	
	function get_available_tables() { // get all the tables which is availabe exclude main
		 return $this->db->select("table.*, cat.name")
		->from("table_details table")
		->join("table_category cat", "table.table_cat_id = cat.id", "left")
		//->join("table_category cat", "table.table_cat_id = cat.id", "left")
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
	
}