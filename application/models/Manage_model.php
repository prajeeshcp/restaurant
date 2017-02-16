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
		
	
	
}