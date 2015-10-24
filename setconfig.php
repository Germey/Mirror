<?php 

	require ('db.php');

	$config = $_GET['config'];
	$mysql = new Mysql();
	if (!$config) {
		echo '0';
		return;
	} else {
		$arr = explode(",", $config);
		foreach ($arr as $key => $value) {
			if (!is_numeric($value)) {
				echo 0;
				return;
			}
		}
	}
	$mysql->insertData($config, 'config');