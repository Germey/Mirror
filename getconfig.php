<?php 

	require('db.php');

	$mysql = new Mysql();
	echo $mysql->getContent('config');