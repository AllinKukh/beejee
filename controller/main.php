<?php
	$data = array();
	include_once("model/$controller.php");					// Соответствующая модель

	$data['admin'] = false;
	if(isset($_SESSION['admin'])){
		$data['admin'] = true;
	}
	
	if( $request[0]== 'edit' && isset($_SESSION['admin']) ){ // Редактирование только для админа
		$id = $request[1];
		$data['task'] = get_task($id);
	}
	
	if( isset($_POST['action']) ){			// Нажата кнопка отправить
		if ( isset($_POST['id']) && $_POST['id'] >0 && isset($_SESSION['admin']) ){
			edit_task();
		}else{
			if ( isset($_POST['id']) && $_POST['id'] > 1 ){
			}else{
				add_task();
			}
		}
		
		
	}
	
	if( $request[0]== 'orderby' && isset($request[1]) ){
		if ($request[1]=='name'){
			$_SESSION['$orderby'] = 'name';
		}else if($request[1]=='name_desc'){
			$_SESSION['$orderby'] = 'name DESC';
		}else if($request[1]=='email'){
			$_SESSION['$orderby'] = 'email';
		}else if($request[1]=='email_desc'){
			$_SESSION['$orderby'] = 'email DESC';
		}else if($request[1]=='status'){
			$_SESSION['$orderby'] = 'status';
		}else if($request[1]=='status_desc'){
			$_SESSION['$orderby'] = 'status DESC';
		}
	}
	
	$data['query'] = get_page();
	$data['paginator']= get_paginator();

	ob_start(); // перенаправление вывода перед вызовом шаблона
	include_once("view/$controller.tpl.php");				// Соответствующий шаблон
	$content .= ob_get_clean(); // забираем итог отработки шаблона
?> 