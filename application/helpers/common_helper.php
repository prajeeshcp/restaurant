<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Formatted form of print_r() function
 */
if (!function_exists('printr')) {
	function printr()
	{
		$args = func_get_args();
		foreach ($args as $arg) {
			echo '<pre>' . print_r($arg, true) . '</pre>';
		}
	}
}
/**
 * Validating url
 *
 * @param string $url
 * @param string $mode
 * @return boolean
 */
if (!function_exists('valid_url')) {
	function valid_url($url, $mode = FILTER_VALIDATE_URL)
	{
		return (filter_var($url, $mode) !== false);
	}
}

/**
 * Return the values from a single column in the input array
 *
 * @param array $input input array
 * @param mixed $column_key Column value(s) to return
 * @param mixed $index_key The column to use as the index/keys for the returned array
 *
 * @return array
 */
if (!function_exists('array_column')) {
	function array_column($input, $column_key, $index_key = null)
	{
		$result = array();

		if (!is_array($input)) {
			$input = (array)$input;
		}

		if (!empty($input)) {
			foreach ($input as $tmp_row) {
				if (!is_null($index_key) && isset($tmp_row[$index_key])) {
					if (is_array($column_key)) {
						$row_data = array();
						foreach ($tmp_row as $t_key => $t_val) {
							if (in_array($t_key, $column_key)) {
								$row_data[$t_key] = $t_val;
							}
						}
						$result[$tmp_row[$index_key]] = $row_data;
					} else {
						$result[$tmp_row[$index_key]] = $tmp_row[$column_key];
					}
				} else {
					if (isset($tmp_row[$column_key])) {
						$result[] = $tmp_row[$column_key];
					}
				}
			}
		}
		return $result;
	}
}

/**
 * send_json_response: Sending a json formatted string output by using array as an input
 *
 * @param array[$data] Input data
 */
if (!function_exists('send_json_response')) {
	function send_json_response($data)
	{
		header('Content-type: application/json');
		echo json_encode($data);
		exit;
	}
}

/**
 * mysql_datetime: Returns datetime for MySQL DATETIME field
 *
 * @param integer[$timestamp] : UNIX timestamp. Default value is current timestamp
 */
if (!function_exists('mysql_datetime')) {
	function mysql_datetime($timestamp = null)
	{
		if (is_null($timestamp)) {
			$timestamp = TIME_NOW;
		}

		return date("Y-m-d H:i:s", $timestamp);
	}
}

/**
 * mysql_date: Returns date for MySQL DATE field
 *
 * @param integer[$timestamp] : UNIX timestamp. Default value is current timestamp
 */
if (!function_exists('mysql_date')) {
	function mysql_date($timestamp = null)
	{
		if (is_null($timestamp)) {
			$timestamp = TIME_NOW;
		}

		return date("Y-m-d", $timestamp);
	}
}

/**
 * empty_mysql_date: Check whether the given sql date is empty or not
 */
if (!function_exists('empty_mysql_date')) {
	function empty_mysql_date($date)
	{
		return (empty($date) || ($date == "0000-00-00"));
	}
}

/**
 * empty_mysql_datetime: Check whether the given sql datetime is empty or not
 */
if (!function_exists('empty_mysql_datetime')) {
	function empty_mysql_datetime($datetime)
	{
		return (empty($datetime) || ($datetime == "0000-00-00 00:00:00"));
	}
}

/**
 * time_span: Returns timespan
 *
 * @param integer[$start_time] : UNIX timestamp.
 * @param integer[$end_time]   : UNIX timestamp.  Default value is current timestamp
 */
if (!function_exists('time_span')) {
	function time_span($start_time,$end_time = null,$glue = null)
	{
		if (is_null($end_time)) {
			$end_time = TIME_NOW;
		}
		if(empty($glue)) {
			$glue = ',';
		}
		$timespan =  timespan($start_time ,$end_time);
		$timespan =  explode(',', $timespan);
		if(count($timespan) > 2) {
			$timespan = array_slice($timespan, 0, 2);
		}
		return implode($glue, $timespan);

	}
}

/**
 * format_number: Returns formated number
 *
 * @param integer[$number]
 */
if (!function_exists('format_number')) {
	function format_number($number)
	{
		$prefixes = 'kMGTPEZY';
	    if ($number >= 1000) {
	        for ($i = -1; $number >= 1000; ++$i) {
	            $number /= 1000;
	        }
	        return floor($number).$prefixes[$i];
	    }
        return $number;

	}
}

/**
 * is_multi_array - Check whether an array is multi dimensional array or not
 * @param [array] $array Array to be checked
 * @return [boolean] TRUE if multi dimensional, else FALSE
 */
if (!function_exists('is_multi_array')) {
	function is_multi_array($array)
	{
		if (!is_array($array)) {
			return false;
		}
		return (count(array_filter($array, 'is_array')) > 0);
	}
}