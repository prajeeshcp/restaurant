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
		
	
	
}