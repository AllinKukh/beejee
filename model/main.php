<?php

function get_task($id){
	$params = array($id);
	$q = q1("SELECT * FROM `task` WHERE `id`=? ",$params);
	return $q;
}

function add_task(){
	$name = $_POST['name'];
	$email = $_POST['email'];
	$text = $_POST['text'];

	$params = array($name, $email ,$text);
	$r = qi("INSERT INTO `task` (`name`, `email`, `text`) VALUES (?,?,?)",$params );  // добавляем запись
}

function edit_task(){
	$name = $_POST['name'];
	$email = $_POST['email'];
	$text = $_POST['text'];	
	$id = $_POST['id'];
	$status = 0;
	if ( isset($_POST['status']) ){
		$status = 1;
	}

	$task = get_task($id);
	$edit=0;
	if ( $task['text'] != $text || $task['edit'] == 1){
		$edit=1;
	}
	
	$params = array($name, $email ,$text, $status, $edit, $id );
	qi("UPDATE `task` SET `name`=?, `email`=?, `text`=?, `status`=?, `edit`=? WHERE id=? ",$params ); //
	
}

function get_page(){
	global $request;
	$nupage = 3; // Число записей на странице
	if ( isset($request[1]) || !isset($request[0])){
		$page = $_SESSION['page'];
	}else{
		$page = $request[0];
	}
	if ($page < 1) $page = 1;
	$_SESSION['page'] = $page;
	$offset = ($page - 1) *$nupage;	

	if ( !isset($_SESSION['$orderby']) ){
		$orderby = 'id DESC';
		$_SESSION['$orderby'] = 'id DESC';
	}
	$orderby = $_SESSION['$orderby'];

	$params=array($offset, $nupage);
	$q = q("SELECT * FROM `task`  ORDER BY $orderby LIMIT ?, ?",$params);	
	foreach ($q as $Row) {
		$Row['status_text']='новая задача';
		if ( $Row['status'] ){
			$Row['status_text']='выполнено';
		}
		if ( $Row['edit'] ){
			$Row['status_text'] .='<br>отредактировано модератором';
		}
		$query[] = $Row;
	}

	return $query;
}


function get_paginator(){
	global $request;
	$nupage = 3; // Число записей на странице
	if ( isset($request[1]) || !isset($request[0])){
		$page = $_SESSION['page'];
	}else{
		$page = $request[0];
	}
	if ($page < 1) $page = 1;
	$orderby = 'id DESC';
	$params=array($orderby);
	$q = q("SELECT `id` FROM `task` order by ?",$params);
	$num_rows = qRows();
	$maxpages = $num_rows / $nupage + 1;
	$paginator ="Страница: &nbsp ";
	for($i=1; ($i<$maxpages); $i++){       
		if ($page <> $i){
			$paginator .="&nbsp;<a href='/$i'>$i</a>&nbsp;";
		}else{
			$paginator .="&nbsp;$i&nbsp;";
		}
	}
	return $paginator;
}	


?>