<?php

if (isset($request[0]) && $request[0]=='authorize' ){
	if ( isset($request[1]) && $request[1]== 'logout' ){		// Выход из аккаунта
		unset($_SESSION['admin']);	// Закрыть сессию
		header('Location: /'); exit; 
	}
}

if(isset($_SESSION['admin'])){
	$userMenu="<a class='nav-link btn-outline-info' href='/authorize/logout'>Выход</a>";
}else{
	$userMenu="<a class='nav-link btn-outline-info' href='/authorize'>Вход</a>";
}

// Подстановки в верхнем меню (Авторизация или Выход)
$output = str_replace("{USER_MENU}", $userMenu, $output);


?>