<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * To select the default database
 *
 * CI uses ./application/config/database.php to find the default
 * database by checking $active_group variable.
 */
if (!function_exists('_DB_use_default')) {
	function _DB_use_default()
	{
		$CI =& get_instance();
		$CI->load->model('common_model');

		$CI->common_model->use_default_db();
	}
}

/**
 * To select a database (similar to `USE` keyword)
 */
if (!function_exists('_DB_use')) {
	function _DB_use($database_config)
	{
		$CI =& get_instance();
		$CI->load->model('common_model');

		$CI->common_model->use_db($database_config);
	}
}

/**
 * _DB_insert
 *
 * Insert a record in to a database table
 *
 * @param string $table Name of the table
 * @param array $data Record to be inserted as an associative array
 * @param function $callback Callback function
 */
if (!function_exists('_DB_insert')) {
	function _DB_insert($table, $data, $callback = null)
	{
		$CI =& get_instance();
		$CI->load->model('common_model');

		return $CI->common_model->db_insert($table, $data, $callback);
	}
}

/**
 * _DB_update
 *
 * Update a database table
 *
 * @param string $table Name of the table
 * @param array $data Record to be updated as an associative array
 * @param array $condition Where clause as an associative array
 * @param function $callback Callback function
 */
if (!function_exists('_DB_update')) {
	function _DB_update($table, $data, $condition, $callback = null)
	{
		$CI =& get_instance();
		$CI->load->model('common_model');

		return $CI->common_model->db_update($table, $data, $condition, $callback);
	}
}

/**
 * _DB_delete
 *
 * Delete data from table
 *
 * @param string $table Name of the table
 * @param array $condition Where clause as an associative array
 * @param function $callback Callback function
 */
if (!function_exists('_DB_delete')) {
	function _DB_delete($table, $condition, $callback = null)
	{
		$CI =& get_instance();
		$CI->load->model('common_model');
		return $CI->common_model->db_delete($table, $condition, $callback);
	}
}

/**
 * _DB_data
 *
 * Fetch data from database
 *
 * @param string $table Name of the table
 * @param array $condition Where clause as an associative array
 * @param integer/array $limit Limit clause
 * @param array $sel_fields Fields to be filtered
 */
if (!function_exists('_DB_data')) {
	function _DB_data($table, $condition = null, $limit = null, $sel_fields = null, $order = null)
	{
		$CI =& get_instance();
		$CI->load->model('common_model');

		return $CI->common_model->db_data($table, $condition, $limit, $sel_fields, $order);
	}
}

/**
 * _DB_get_record
 *
 * Fetch a particular record from database
 *
 * @param string $table Name of the table
 * @param array $condition Where clause as an associative array
 * @param array $sel_fields Fields to be filtered
 */
if (!function_exists('_DB_get_record')) {
	function _DB_get_record($table, $condition, $sel_fields = null)
	{
		$CI =& get_instance();
		$CI->load->model('common_model');

		return $CI->common_model->db_get_record($table, $condition, $sel_fields);
	}
}

/**
 * _DB_get_count
 *
 * Returns the number of rows in a particular table. Optionally use
 * where clause with function, so that it will return the number of
 * rows in the result set.
 *
 * @param string $table Name of the table
 * @param array $condition Where clause as an associative array
 */
if (!function_exists('_DB_get_count')) {
	function _DB_get_count($table, $condition = null)
	{
		$CI =& get_instance();
		$CI->load->model('common_model');

		return $CI->common_model->db_get_count($table, $condition);
	}
}

if (!function_exists('_DB_set_config')) {
	function _DB_set_config($key, $value)
	{
		$CI =& get_instance();
		$CI->load->model('common_model');

		return $CI->common_model->db_set_config($key, $value);
	}
}

if (!function_exists('_DB_get_config')) {
	function _DB_get_config($key, $default = null)
	{
		$CI =& get_instance();
		$CI->load->model('common_model');

		return $CI->common_model->db_get_config($key, $default);
	}
}

if (!function_exists('_DB_unset_config')) {
	function _DB_unset_config($key)
	{
		$CI =& get_instance();
		$CI->load->model('common_model');

		return $CI->common_model->db_unset_config($key);
	}
}

/**
 * Function to fetch data from data tables (table name like data_****)
 *
 * Data tables should have a common pattern and the field names are similar to language name.
 * This function will be handled the language switching process internally.
 *
 * @param [string] $tbl Table name
 */
if (!function_exists('_DB_data_list')) {
	function _DB_data_list($tbl, $where = null, $limit = null)
	{
		$CI   =& get_instance();
		if (!empty($where)) {
			if (is_array($where)) {
				$where['status'] = 1;
			} elseif (is_string($where)) {
				$where = trim($where) . " AND status = 1";
			}
		} else {
			$where = array('status' => 1);
		}
		$data = _DB_data($tbl, $where, $limit, array('id', $CI->lang->lang()));
		$data = array_column($data, $CI->lang->lang(), 'id');
		return $data;
	}
}

if (!function_exists('_DB_last_query')) {
	function _DB_last_query()
	{
		$CI =& get_instance();
		$CI->load->model('common_model');

		return $CI->common_model->db_last_query();
	}
}

if (!function_exists('_DB_insert_id')) {
	function _DB_insert_id()
	{
		$CI =& get_instance();
		$CI->load->model('common_model');

		return $CI->common_model->db_insert_id();
	}
}

if (!function_exists('_DB_filter_data')) {
	function _DB_filter_data($table, $data)
	{
		$CI =& get_instance();
		$CI->load->model('common_model');

		return $CI->common_model->filter_data($table, $data);
	}
}