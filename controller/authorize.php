<?php
	if ( isset($_POST['login']) && isset($_POST['pass']) ){
		if ( $_POST['login']=='admin' && $_POST['pass']== '123' ){
			$_SESSION['admin']=true;
			$content = $_POST['login'];
		}
		header('Location: /'); exit; 
	}
	$content .= implode("",file("view/$controller.html"));	// Загружаем шаблон
?>