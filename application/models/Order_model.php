<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
	
	function get_available_tables() { // get all the tables which is availabe exclude main
		 return $this->db->select("table.*, cat.id cat_id, cat.name")
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
		 return $this->db->select("odr.entity_id as check_order_id, odr.user_id, odr.table_id")
		->from("order_entity odr")
		->where("odr.table_id", $tableId)
		->where("odr.status", 'pending')
		->or_where("odr.status", 'processing')
		//->where("odr.user_id !=", $userId)
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

	#get all the order which have status ready
	function processing_odr_cashier($userId	= NULL) {
		return $this->db->select('*')
		->from('order_entity')		
		->where("is_bill", 1)		
		->get()->result_array();
	}

	#get all the completed order
	function completed_odr_cashier() {
		return $this->db->select('*')
		->from('order_entity')		
		->where("is_bill", 2)
		->order_by("updated_at", "desc")		
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
	
	#get report of bill
	function bill_report($startDate = NULL, $endDate = NULL, $timeperiod = NULL) {
		if ($timeperiod == 'day')  {
			$this->db->select('DATE_FORMAT(bill.created_at, "%d %b %Y") datetime, COUNT(bill.entity_id) bill_count, ROUND(SUM(bill.grand_total)) grand_total_bill');
		} else if($timeperiod == 'month') {
			$this->db->select('DATE_FORMAT(bill.created_at, "%b %Y") datetime, COUNT(bill.entity_id) bill_count, ROUND(SUM(bill.grand_total)) grand_total_bill');
		} else {
			$this->db->select('DATE_FORMAT(bill.created_at, "%Y") datetime, COUNT(bill.entity_id) bill_count, ROUND(SUM(bill.grand_total)) grand_total_bill');
		}
		$this->db->from('bill_entity bill');
		$this->db->where('date(bill.created_at) >=', $startDate);
		$this->db->where('date(bill.created_at) <=', $endDate);
		if ($timeperiod == 'day')  {
			$this->db->group_by('day(bill.created_at)');
		} else if ($timeperiod == 'month') {
			$this->db->group_by('month(bill.created_at)');
		} else {
			$this->db->group_by('year(bill.created_at)');
		}
		return $this->db->get()->result_array();
	}
	#total bill report
	function total_bill_report($startDate = NULL, $endDate = NULL) {
		$this->db->select('COUNT(bill.entity_id) bill_count, ROUND(SUM(bill.grand_total)) grand_total_bill');
		$this->db->from('bill_entity bill');
		$this->db->where('date(bill.created_at) >=', $startDate);
		$this->db->where('date(bill.created_at) <=', $endDate);
		return $this->db->get()->row();
	}

	#get report of tax
	function tax_report($startDate = NULL, $endDate = NULL, $timeperiod = NULL) {
		if ($timeperiod == 'day')  {
			$this->db->select('DATE_FORMAT(bill.created_at, "%d %b %Y") datetime, COUNT(bill.entity_id) tax_count, SUM(bill.tax_amount) grand_total_tax');
		} else if($timeperiod == 'month') {
			$this->db->select('DATE_FORMAT(bill.created_at, "%b %Y") datetime, COUNT(bill.entity_id) tax_count, SUM(bill.tax_amount) grand_total_tax');
		} else {
			$this->db->select('DATE_FORMAT(bill.created_at, "%Y") datetime, COUNT(bill.entity_id) tax_count, SUM(bill.tax_amount) grand_total_tax');
		}
		$this->db->from('bill_entity bill');
		$this->db->where('date(bill.created_at) >=', $startDate);
		$this->db->where('date(bill.created_at) <=', $endDate);
		if ($timeperiod == 'day')  {
			$this->db->group_by('day(bill.created_at)');
		} else if ($timeperiod == 'month') {
			$this->db->group_by('month(bill.created_at)');
		} else {
			$this->db->group_by('year(bill.created_at)');
		}
		return $this->db->get()->result_array();
	}
	#total tax report
	function total_tax_report($startDate = NULL, $endDate = NULL) {
		$this->db->select('COUNT(bill.entity_id) tax_count, SUM(bill.tax_amount) grand_total_tax');
		$this->db->from('bill_entity bill');
		$this->db->where('date(bill.created_at) >=', $startDate);
		$this->db->where('date(bill.created_at) <=', $endDate);
		return $this->db->get()->row();
	}

	#get report of order
	function order_report($startDate = NULL, $endDate = NULL, $timeperiod = NULL) {
		if ($timeperiod == 'day')  {
			$this->db->select('DATE_FORMAT(order.updated_at, "%d %b %Y") datetime, COUNT(order.entity_id) order_count, SUM(order.total_paid) grand_total_order');
		} else if($timeperiod == 'month') {
			$this->db->select('DATE_FORMAT(order.updated_at, "%b %Y") datetime, COUNT(order.entity_id) order_count, SUM(order.total_paid) grand_total_order');
		} else {
			$this->db->select('DATE_FORMAT(order.updated_at, "%Y") datetime, COUNT(order.entity_id) order_count, SUM(order.total_paid) grand_total_order');
		}
		$this->db->from('order_entity order');
		$this->db->where('date(order.updated_at) >=', $startDate);
		$this->db->where('date(order.updated_at) <=', $endDate);
		if ($timeperiod == 'day')  {
			$this->db->group_by('day(order.updated_at)');
		} else if ($timeperiod == 'month') {
			$this->db->group_by('month(order.updated_at)');
		} else {
			$this->db->group_by('year(order.updated_at)');
		}

		$result['order_report'] =  $this->db->get()->result_array();


		if ($timeperiod == 'day')  {
			$this->db->select('DATE_FORMAT(order.updated_at, "%d %b %Y") datetime, COUNT(order.total_paid) not_paid_count');
		} else if($timeperiod == 'month') {
			$this->db->select('DATE_FORMAT(order.updated_at, "%b %Y") datetime, COUNT(order.total_paid) not_paid_count');
		} else {
			$this->db->select('DATE_FORMAT(order.updated_at, "%Y") datetime, COUNT(order.total_paid) not_paid_count');
		}
		$this->db->from('order_entity order');
		$this->db->where('date(order.updated_at) >=', $startDate);
		$this->db->where('date(order.updated_at) <=', $endDate);
		$this->db->where('order.total_paid <=', 0.00);
		if ($timeperiod == 'day')  {
			$this->db->group_by('day(order.updated_at)');
		} else if ($timeperiod == 'month') {
			$this->db->group_by('month(order.updated_at)');
		} else {
			$this->db->group_by('year(order.updated_at)');
		}

		$result['order_not_paid'] = $this->db->get()->result_array();

		return $result;


	}
	#total order report
	function total_order_report($startDate = NULL, $endDate = NULL) {
		$this->db->select('COUNT(order.entity_id) order_count, SUM(order.total_paid) grand_total_order');
		$this->db->from('order_entity order');
		$this->db->where('date(order.updated_at) >=', $startDate);
		$this->db->where('date(order.updated_at) <=', $endDate);
		return $this->db->get()->row();
	}
        
        #get report of parcel_order
	function parcel_order_report($startDate = NULL, $endDate = NULL, $timeperiod = NULL) {
		$this->db->distinct('order_items.order_id');
		$this->db->select('order_items.order_id');
		$this->db->from('order_entity_items order_items');
		$this->db->where('order_items.order_type', 'Parcel');
		$this->db->where('date(order_items.updated_at) >=', $startDate);
		$this->db->where('date(order_items.updated_at) <=', $endDate);
		$orderIdResult =  $this->db->get()->result_array();

		$orderId = array();
		foreach ($orderIdResult as $row) {
			$orderId[] = $row['order_id'];
		}

		if ($timeperiod == 'day')  {
			$this->db->select('DATE_FORMAT(order.updated_at, "%d %b %Y") datetime, COUNT(order.entity_id) parcel_order_count, SUM(order.total_paid) grand_total_parcel_order');
		} else if($timeperiod == 'month') {
			$this->db->select('DATE_FORMAT(order.updated_at, "%b %Y") datetime, COUNT(order.entity_id) parcel_order_count, SUM(order.total_paid) grand_total_parcel_order');
		} else {
			$this->db->select('DATE_FORMAT(order.updated_at, "%Y") datetime, COUNT(order.entity_id) parcel_order_count, SUM(order.total_paid) grand_total_parcel_order');
		}
		$this->db->from('order_entity order');		
		$this->db->where('date(order.updated_at) >=', $startDate);
		$this->db->where('date(order.updated_at) <=', $endDate);
		if (!empty($orderId)) {			
			$this->db->where_in('order.entity_id', $orderId);
		} else {
			$this->db->where_in('order.entity_id', '');
		} 
		if ($timeperiod == 'day')  {
			$this->db->group_by('day(order.updated_at)');
		} else if ($timeperiod == 'month') {
			$this->db->group_by('month(order.updated_at)');
		} else {
			$this->db->group_by('year(order.updated_at)');
		}

		$result['parcel_order_report'] =  $this->db->get()->result_array();


		if ($timeperiod == 'day')  {
			$this->db->select('DATE_FORMAT(order.updated_at, "%d %b %Y") datetime, COUNT(order.total_paid) not_paid_count');
		} else if($timeperiod == 'month') {
			$this->db->select('DATE_FORMAT(order.updated_at, "%b %Y") datetime, COUNT(order.total_paid) not_paid_count');
		} else {
			$this->db->select('DATE_FORMAT(order.updated_at, "%Y") datetime, COUNT(order.total_paid) not_paid_count');
		}		
		$this->db->from('order_entity order');		
		$this->db->where('date(order.updated_at) >=', $startDate);
		$this->db->where('date(order.updated_at) <=', $endDate);
		$this->db->where('order.total_paid <=', 0.00);
		if (!empty($orderId)) {			
			$this->db->where_in('order.entity_id', $orderId);
		} else {
			$this->db->where_in('order.entity_id', '');
		} 
		if ($timeperiod == 'day')  {
			$this->db->group_by('day(order.updated_at)');
		} else if ($timeperiod == 'month') {
			$this->db->group_by('month(order.updated_at)');
		} else {
			$this->db->group_by('year(order.updated_at)');
		}

		$result['parcel_order_not_paid'] = $this->db->get()->result_array();

		return $result;


	}
	#total parcel_order report
	function total_parcel_order_report($startDate = NULL, $endDate = NULL) {
		$this->db->distinct('order_items.order_id');
		$this->db->select('order_items.order_id');
		$this->db->from('order_entity_items order_items');
		$this->db->where('order_items.order_type', 'Parcel');
		$this->db->where('date(order_items.updated_at) >=', $startDate);
		$this->db->where('date(order_items.updated_at) <=', $endDate);
		$orderIdResult =  $this->db->get()->result_array();

		$orderId = array();
		foreach ($orderIdResult as $row) {
			$orderId[] = $row['order_id'];
		}


		$this->db->select('COUNT(order.entity_id) parcel_order_count, SUM(order.total_paid) grand_total_parcel_order');
		$this->db->from('order_entity order');		
		$this->db->where('date(order.updated_at) >=', $startDate);
		$this->db->where('date(order.updated_at) <=', $endDate);
		if (!empty($orderId)) {			
			$this->db->where_in('order.entity_id', $orderId);
		} else {
			$this->db->where_in('order.entity_id', '');
		} 
		return $this->db->get()->row();
	}
        
        #get report of table_order
	function table_order_report($startDate = NULL, $endDate = NULL, $timeperiod = NULL) {

		$this->db->distinct('order_items.order_id');
		$this->db->select('order_items.order_id');
		$this->db->from('order_entity_items order_items');
		$this->db->where('order_items.order_type', 'Table');
		$this->db->where('date(order_items.updated_at) >=', $startDate);
		$this->db->where('date(order_items.updated_at) <=', $endDate);
		$orderIdResult =  $this->db->get()->result_array();

		$orderId = array();
		foreach ($orderIdResult as $row) {
			$orderId[] = $row['order_id'];
		}		

		if ($timeperiod == 'day')  {
			$this->db->select('DATE_FORMAT(order.updated_at, "%d %b %Y") datetime, COUNT(order.entity_id) table_order_count, SUM(order.total_paid) grand_total_table_order');
		} else if($timeperiod == 'month') {
			$this->db->select('DATE_FORMAT(order.updated_at, "%b %Y") datetime, COUNT(order.entity_id) table_order_count, SUM(order.total_paid) grand_total_table_order');
		} else {
			$this->db->select('DATE_FORMAT(order.updated_at, "%Y") datetime, COUNT(order.entity_id) table_order_count, SUM(order.total_paid) grand_total_table_order');
		}
		$this->db->from('order_entity order');		
		$this->db->where('date(order.updated_at) >=', $startDate);
		$this->db->where('date(order.updated_at) <=', $endDate);		
		if (!empty($orderId)) {			
			$this->db->where_in('order.entity_id', $orderId);
		} else {
			$this->db->where_in('order.entity_id', '');
		} 

		if ($timeperiod == 'day')  {
			$this->db->group_by('day(order.updated_at)');
		} else if ($timeperiod == 'month') {
			$this->db->group_by('month(order.updated_at)');
		} else {
			$this->db->group_by('year(order.updated_at)');
		}

		$result['table_order_report'] =  $this->db->get()->result_array();		


		if ($timeperiod == 'day')  {
			$this->db->select('DATE_FORMAT(order.updated_at, "%d %b %Y") datetime, COUNT(order.total_paid) not_paid_count');
		} else if($timeperiod == 'month') {
			$this->db->select('DATE_FORMAT(order.updated_at, "%b %Y") datetime, COUNT(order.total_paid) not_paid_count');
		} else {
			$this->db->select('DATE_FORMAT(order.updated_at, "%Y") datetime, COUNT(order.total_paid) not_paid_count');
		}		
		$this->db->from('order_entity order');		
		$this->db->where('date(order.updated_at) >=', $startDate);
		$this->db->where('date(order.updated_at) <=', $endDate);
		$this->db->where('order.total_paid <=', 0.00);
		if (!empty($orderId)) {			
			$this->db->where_in('order.entity_id', $orderId);
		} else {
			$this->db->where_in('order.entity_id', '');
		} 
		if ($timeperiod == 'day')  {
			$this->db->group_by('day(order.updated_at)');
		} else if ($timeperiod == 'month') {
			$this->db->group_by('month(order.updated_at)');
		} else {
			$this->db->group_by('year(order.updated_at)');
		}

		$result['table_order_not_paid'] = $this->db->get()->result_array();

		return $result;


	}
	#total table_order report
	function total_table_order_report($startDate = NULL, $endDate = NULL) {

		$this->db->distinct('order_items.order_id');
		$this->db->select('order_items.order_id');
		$this->db->from('order_entity_items order_items');
		$this->db->where('order_items.order_type', 'Table');
		$this->db->where('date(order_items.updated_at) >=', $startDate);
		$this->db->where('date(order_items.updated_at) <=', $endDate);
		$orderIdResult =  $this->db->get()->result_array();

		$orderId = array();
		foreach ($orderIdResult as $row) {
			$orderId[] = $row['order_id'];
		}


		$this->db->select('COUNT(order.entity_id) table_order_count, SUM(order.total_paid) grand_total_table_order');
		$this->db->from('order_entity order');		
		$this->db->where('date(order.updated_at) >=', $startDate);
		$this->db->where('date(order.updated_at) <=', $endDate);
		if (!empty($orderId)) {			
			$this->db->where_in('order.entity_id', $orderId);
		} else {
			$this->db->where_in('order.entity_id', '');
		} 
		return $this->db->get()->row();
	}

	#get report of sales
	function sales_report($startDate = NULL, $endDate = NULL, $timeperiod = NULL) {

		if ($timeperiod == 'day')  {
			$this->db->select('DATE_FORMAT(bill_items.created_at, "%d %b %Y") datetime');
		} else if($timeperiod == 'month') {
			$this->db->select('DATE_FORMAT(bill_items.created_at, "%b %Y") datetime');
		} else {
			$this->db->select('DATE_FORMAT(bill_items.created_at, "%Y") datetime');
		}
		$this->db->from('bill_entity_items bill_items');
		$this->db->where('date(bill_items.created_at) >=', $startDate);
		$this->db->where('date(bill_items.created_at) <=', $endDate);
		if ($timeperiod == 'day')  {
			$this->db->group_by('day(bill_items.created_at)');
		} else if ($timeperiod == 'month') {
			$this->db->group_by('month(bill_items.created_at)');
		} else {
			$this->db->group_by('year(bill_items.created_at)');
		}

		$result['sales_dates'] = $this->db->get()->result_array();

		if ($timeperiod == 'day')  {
			$this->db->select('DATE_FORMAT(bill_items.created_at, "%d %b %Y") datetime, bill_items.name name' );
		} else if($timeperiod == 'month') {
			$this->db->select('DATE_FORMAT(bill_items.created_at, "%b %Y") datetime, bill_items.name name');
		} else {
			$this->db->select('DATE_FORMAT(bill_items.created_at, "%Y") datetime, bill_items.name name');
		}
		$this->db->from('bill_entity_items bill_items');
		$this->db->where('date(bill_items.created_at) >=', $startDate);
		$this->db->where('date(bill_items.created_at) <=', $endDate);
		$this->db->group_by('bill_items.name');	

		$result['sales_names'] = $this->db->get()->result_array();

		$this->db->select('SUM(bill_items.row_total) row_total, SUM(bill_items.tax_amount) tax_amount_row_total, bill_items.name name');	
		$this->db->from('bill_entity_items bill_items');
		$this->db->where('date(bill_items.created_at) >=', $startDate);
		$this->db->where('date(bill_items.created_at) <=', $endDate);
		$this->db->group_by('bill_items.name');	

		$result['sales_row_total'] = $this->db->get()->result_array();


		if ($timeperiod == 'day')  {
			$this->db->select('DATE_FORMAT(bill_items.created_at, "%d %b %Y") datetime, COUNT(bill_items.item_id) bill_items_count, SUM(bill_items.row_total) row_total_bill_items, SUM(bill_items.tax_amount) tax_amount_bill_items, SUM(bill_items.row_total_incld_tax) grand_total_bill_items, bill_items.name name');
		} else if($timeperiod == 'month') {
			$this->db->select('DATE_FORMAT(bill_items.created_at, "%b %Y") datetime, COUNT(bill_items.item_id) bill_items_count, SUM(bill_items.row_total) row_total_bill_items, SUM(bill_items.tax_amount) tax_amount_bill_items, SUM(bill_items.row_total_incld_tax) grand_total_bill_items, bill_items.name name');
		} else {
			$this->db->select('DATE_FORMAT(bill_items.created_at, "%Y") datetime, COUNT(bill_items.item_id) bill_items_count, SUM(bill_items.row_total) row_total_bill_items, SUM(bill_items.tax_amount) tax_amount_bill_items, SUM(bill_items.row_total_incld_tax) grand_total_bill_items, bill_items.name name');
		}
		$this->db->from('bill_entity_items bill_items');
		$this->db->where('date(bill_items.created_at) >=', $startDate);
		$this->db->where('date(bill_items.created_at) <=', $endDate);
		if ($timeperiod == 'day')  {
			$this->db->group_by('day(bill_items.created_at)');
			$this->db->group_by('bill_items.name');
		} else if ($timeperiod == 'month') {
			$this->db->group_by('month(bill_items.created_at)');
			$this->db->group_by('bill_items.name');
		} else {
			$this->db->group_by('year(bill_items.created_at)');
			$this->db->group_by('bill_items.name');
		}

		$result['sales_report'] = $this->db->get()->result_array();

		if ($timeperiod == 'day')  {
			$this->db->select('DATE_FORMAT(bill_items.created_at, "%d %b %Y") datetime, SUM(bill_items.tax_amount) tax_amount_bill_items' );
		} else if($timeperiod == 'month') {
			$this->db->select('DATE_FORMAT(bill_items.created_at, "%b %Y") datetime, SUM(bill_items.tax_amount) tax_amount_bill_items');
		} else {
			$this->db->select('DATE_FORMAT(bill_items.created_at, "%Y") datetime, SUM(bill_items.tax_amount) tax_amount_bill_items');
		}
		$this->db->from('bill_entity_items bill_items');
		$this->db->where('date(bill_items.created_at) >=', $startDate);
		$this->db->where('date(bill_items.created_at) <=', $endDate);
		if ($timeperiod == 'day')  {
			$this->db->group_by('day(bill_items.created_at)');
		} else if ($timeperiod == 'month') {
			$this->db->group_by('month(bill_items.created_at)');
		} else {
			$this->db->group_by('year(bill_items.created_at)');
		}

		$result['sales_tax'] = $this->db->get()->result_array();

		if ($timeperiod == 'day')  {
			$this->db->select('DATE_FORMAT(bill_items.created_at, "%d %b %Y") datetime, SUM(bill_items.row_total) row_total_bill_items' );
		} else if($timeperiod == 'month') {
			$this->db->select('DATE_FORMAT(bill_items.created_at, "%b %Y") datetime, SUM(bill_items.row_total) row_total_bill_items');
		} else {
			$this->db->select('DATE_FORMAT(bill_items.created_at, "%Y") datetime, SUM(bill_items.row_total) row_total_bill_items');
		}
		$this->db->from('bill_entity_items bill_items');
		$this->db->where('date(bill_items.created_at) >=', $startDate);
		$this->db->where('date(bill_items.created_at) <=', $endDate);
		if ($timeperiod == 'day')  {
			$this->db->group_by('day(bill_items.created_at)');
		} else if ($timeperiod == 'month') {
			$this->db->group_by('month(bill_items.created_at)');
		} else {
			$this->db->group_by('year(bill_items.created_at)');
		}
		
		$result['sales_total'] = $this->db->get()->result_array();

		return $result;
	}
	#total sales report
	function total_sales_report($startDate = NULL, $endDate = NULL) {
		$this->db->select('COUNT(bill_items.item_id) bill_items_count, SUM(bill_items.row_total) row_total_bill_items, SUM(bill_items.tax_amount) tax_amount_bill_items, SUM(bill_items.row_total_incld_tax) grand_total_bill_items');
		$this->db->from('bill_entity_items bill_items');
		$this->db->where('date(bill_items.created_at) >=', $startDate);
		$this->db->where('date(bill_items.created_at) <=', $endDate);
		return $this->db->get()->row();
	}
}