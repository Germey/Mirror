<?php 

	require('db.php');
	require('news.php');
	require('weather.php');

	$weather = new Weather();
	$weathers = $weather->getResponse();
	$newscontent = array(
		"习近平佩戴3D眼镜视察",
		"NBA常规赛即将举办",
		"黑客马拉松在济南顺利举办"
		);
	$new = new News();
	$newscontent = $new->parseHTML();
	$mysql = new Mysql();
	$todolist = $mysql->getContent('todolist');
	$todolist = explode(",", $todolist);
	$result = "";
	$result .= join("#", $weathers);
	$result .= "#";
	$result .= join("#", $newscontent);
	$result .= "#";
	$result .= join('#', $todolist);

	echo $result;
