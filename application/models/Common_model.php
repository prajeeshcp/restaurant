<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * common_model : used to invoke frequently used operations
 */

class common_model extends CI_Model
{
	private $_db = null;

	public function __construct()
	{
		parent::__construct();
		$this->use_default_db();
	}

	/**
	 * use_default_db
	 * To bind default database object
	 */
	public function use_default_db()
	{
		//$this->setlocale();
		$this->_db = $this->db;		
	}

	/**
	 * 
	 * Load specified database and bind the database object
	 * @param  [string] $db_config [database config group]
	 */
	public function use_db($db_config)
	{
		$this->_db = $this->load->database($db_config, true);
	}

	/**
	 * db_data(string table [, mixed condition] [, mixed limit] [, mixed sel_fields]) - Fetching data from table
	 *
	 * @param table [required]
	 * @param condition [optional]
	 * @param limit [optional]
	 * @param sel_fields [optional]
	 *
	 * @return array
	 */
	final public function db_data($table, $condition = null, $limit = null, $sel_fields = null, $order = null)
	{
		if (!empty($condition)) {
			$this->_db->where($condition);
		}

		if (!empty($sel_fields)) {
			if (is_array($sel_fields)) {
				if (is_array($sel_fields[0])) {
					$this->_db->select(implode(', ', $sel_fields[0]), (isset($sel_fields[1]) ? $sel_fields[1] : true));
				} else {
					$this->_db->select(implode(', ', $sel_fields), false);
				}
			} else {
				$this->_db->select($sel_fields, false);
			}
		}

		if (!empty($limit)) {
			if (is_array($limit)) {
				$this->_db->limit($limit[0], $limit[1]);
			} else {
				$this->_db->limit($limit);
			}
		}

		if (!empty($order)) {
			if (is_array($order)) {
				if (!isset($order[1])) {
					$order[1] = 'ASC';
				}
				$this->db->order_by($order[0], $order[1]);
			} else {
				$this->db->order_by($order);
			}
		}

		return $this->_db->from($table)
						->get()->result_array();
	}

	/**
	 * db_get_record(string table, mixed condition [, mixed sel_fields]) - Fetching a single row
	 *
	 * @param table [required]
	 * @param condition [required]
	 * @param sel_fields [optional]
	 *
	 * @return array
	 */
	final public function db_get_record($table, $condition, $sel_fields = null)
	{
		if (empty($condition)) {
			return false;
		}

		if (!empty($sel_fields)) {
			if (is_array($sel_fields)) {
				if (is_array($sel_fields[0])) {
					$this->_db->select(implode(', ', $sel_fields[0]), (isset($sel_fields[1]) ? $sel_fields[1] : true));
				} else {
					$this->_db->select(implode(', ', $sel_fields), false);
				}
			} else {
				$this->_db->select($sel_fields, false);
			}
		}

		return $this->_db->from($table)
						->where($condition)
						->limit(1)
						->get()->row_array();
	}

	/**
	 * db_insert(string table, array data [, function callback]) - Insert data into a table
	 *
	 * @param table [required] - Name of the table to which data to be inserted
	 * @param data [required] - Data to be inserted
	 * @param callback [optional] - Function to be called when successfully inserted data into given table
	 *
	 * @return boolean
	 */
	final public function db_insert($table, $data, $callback = null)
	{
		$data = $this->filter_data($table, $data);
		if (!empty($data)) {
			if (is_multi_array($data)) {
				$inserted = $this->_db->insert_batch($table, $data);
			} else {
				$inserted = $this->_db->insert($table, $data);
			}
			if ($inserted) {
				if (!is_null($callback)) {
					$callback();
				}
				return true;
			}
		}

		return false;
	}

	/**
	 * db_update(string table, array data, mixed condition [, function callback]) - Updates table data
	 *
	 * @param table [required] - Name of the table to which data to be updated
	 * @param data [required] - New data
	 * @param condition [required] - Condition to select desired row
	 * @param callback [optional] - Function to be called when data updated successfully
	 *
	 * @return boolean
	 */
	final public function db_update($table, $data, $condition, $callback = null)
	{
		//printr($data);exit();

		if (!empty($condition) && !empty($data)) {
			$data = $this->filter_data($table, $data, $condition);
			$updated = $this->_db->update($table, $data, $condition);			
			if ($updated !== false) {
				if (!is_null($callback)) {
					$callback();
				}
				return true;
			}
		}

		return false;
	}

	/**
	 * db_delete(string table, mixed condition [, function callback]) - Delete table data
	 *
	 * @param table [required] - Name of the table to which data to be deleted
	 * @param condition [required] - Condition to select desired row(s)
	 * @param callback [optional] - Function to be called when data updated successfully
	 *
	 * @return boolean
	 */
	final public function db_delete($table, $condition, $callback = null)
	{
		if (!empty($condition)) {
			$deleted = $this->_db->delete($table, $condition);
			if ($deleted !== false) {
				if (!is_null($callback)) {
					$callback();
				}
				return true;
			}
		}

		return false;
	}

	/**
	 * db_get_count(string table [, mixed condition]) Returns row counts
	 */
	final public function db_get_count($table, $condition = null)
	{
		if (!empty($table)) {
			if (!empty($condition)) {
				$this->_db->where($condition);
			}
			$this->_db->from($table);
			return $this->_db->count_all_results();
		}

		return 0;
	}

	/**
	 * set_config(string key, array value) - Set config value
	 */
	final public function db_set_config($key, $value)
	{
		if (!empty($key)) {
			$value = is_array($value) ? serialize($value) : $value;
			$record = $this->db_get_record($this->tables['site_settings'], array('c_key' => $key));
			if (!empty($record)) {
				return $this->db_update($this->tables['site_settings'], array('c_value' => $value), array('c_key' => $key));
			} else {
				return $this->db_insert($this->tables['site_settings'], array('c_key' => $key, 'c_value' => $value));
			}
		}
	}

	/**
	 * get_config(string key [, mixed default])
	 */
	final public function db_get_config($key, $default = null)
	{
		if (!empty($key)) {
			$record = $this->db_get_record($this->tables['site_settings'], array('c_key' => $key));
			if (!empty($record)) {
				$value = @unserialize($record['c_value']);
				if ($value === false) {
					$value = $record['c_value'];
				}
				return $value;
			}
		}

		return $default;
	}

	/**
	 * unset_config(string key)
	 */
	final public function db_unset_config($key)
	{
		if (!empty($key)) {
			return $this->db_delete($this->tables['site_settings'], array('c_key' => $key));
		}

		return false;
	}

	/**
	 * CI's query helper - last_query() method
	 */
	final public function db_last_query()
	{
		return $this->_db->last_query();
	}

	/**
	 * CI's query helper - insert_id()
	 */
	public function db_insert_id()
	{
		return $this->_db->insert_id();
	}

	/**
	 * filter_data - Filter array by matching the table fields
	 * @param  [string] $table Table name
	 * @param  [array] $data  Data to be inserted/updated
	 * @return [array] Filtered array
	 */
	public function filter_data($table, $data)
	{
		if ($this->config->item('enable_db_data_filtering', 'database') !== true) {
			return $data;
		}

		$filtered_data = array();
		$columns = $this->db->list_fields($table);

		if (is_array($data))
		{
			if (is_multi_array($data)) {
				foreach ($data as $k => $v) {
					$filtered_data[$k] = $this->filter_data($table, $v);
				}
			} else {
				foreach ($columns as $column)
				{
					if (array_key_exists($column, $data))
						$filtered_data[$column] = $data[$column];
				}
			}
		}

		return $filtered_data;
	}
}