<?php 

	require("db.php");

	$mysql = new Mysql();
	$content = $_GET['list'];
	$mysql->insertData($content, 'todolist');