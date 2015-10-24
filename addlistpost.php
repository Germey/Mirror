<?php 

	require("db.php");

	$mysql = new Mysql();
	$content = $_POST['list'];
	$mysql->insertData($content, 'todolist');
