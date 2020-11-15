<?php

	function show_date_human_format($original,$time=false)
	{
    	$newDate       = date('l, d F Y', strtotime($original));
    	if ($time) {
        	$newDate .= ' '.date('h : i :s ',strtotime($original));
    	}
    	return $newDate;
	}

	function time_to_human_format($time)
	{
		if (is_numeric($time)) {
			return date('l, d F Y h:i:s',$time);
		}
	}

	function encrypt_url($string) {
		$key = "KS_05082017"; //key to encrypt and decrypts.
		$result = '';
		$test = "";
		for($i=0; $i<strlen($string); $i++) {
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)+ord($keychar));
			$test[$char]= ord($char)+ord($keychar);
			$result.=$char;
		}
		return urlencode(base64_encode($result));
	}

	function decrypt_url($string) {
		$key = "KS_05082017"; //key to encrypt and decrypts.
		$result = '';
		$string = base64_decode(urldecode($string));
		for($i=0; $i<strlen($string); $i++) {
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)-ord($keychar));
			$result.=$char;
		}
		return $result;
	}

	function set_label_form($field='')
	{
    	if (!empty($field)) {
        	$field = str_replace(array('kues_','_'), array(' ',' '), $field);
        	$field = ucwords($field);
        	return $field;
    	}
    	
	}

