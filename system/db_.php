<?php 

define('DB_HOST', 'localhost');		// хост
define('DB_NAME', 'test1');			// имя БД
define('DB_USER', 'test1');			// имя подьзователя БД
define('DB_PASS', 'test1');			// пароль к БД
define('CHARSET', 'utf8');			// кодировка БД

	
$dbConnection = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST.';charset=utf8', DB_USER, DB_PASS);
$dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbConnection->exec("set names utf8");
$dbConnection->exec("SET SESSION group_concat_max_len = 1000000");
$dbConnection->exec("SET sql_mode=''");

function q($sql, $params){ // запрос к базе — короткое имя для удобства
    global $dbConnection;
    try{
		$stmt = $dbConnection->prepare($sql);
		$stmt->execute($params);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}catch(Exception $e){
		if(1){
			echo "<pre>";
			print_r($e);
			echo "\n\n\n------- \n\n\n";
			echo $sql;
			echo "\n\n\n------- \n\n\n";
			print_r($params);
			die("<br /> <a href='/'>Выход</a>");
		}else{
			die("Произошла ошибка в SQL-запросе. Обратитесь к Администратору. <br /> <a href='/'>Выход</a>");
		}
	}
}

function q1($sql, $params){ //запрос одной строки
	global $dbConnection;
	try{
		$stmt = $dbConnection->prepare($sql);
		$stmt->execute($params);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
    }catch(Exception $e){
		if(1){
			echo "<pre>";
			print_r($e);
			echo "\n\n\n------- \n\n\n";
			echo $sql;
			echo "\n\n\n------- \n\n\n";
			print_r($params);
			die("<br /> <a href='/'>Выход</a>");
		}else{
			die("Произошла ошибка в SQL-запросе. Обратитесь к Администратору.<br /> <a href='/'>Выход</a>");
		}
	}
}


function qi($sql, $params, $ignore_exceptions=0){ // Используется для insert и update
	try{
		global $dbConnection;
		$stmt = $dbConnection->prepare($sql);
		if($stmt->execute($params)){
			return true;
		}
		else return false;
    }catch(Exception $e){
		if($ignore_exceptions){
			return;
		}
		if(1){
			echo "<pre>";
			print_r($e);
			echo "\n\n\n------- \n\n\n";
			echo $sql;
			echo "\n\n\n------- \n\n\n";
			print_r($params);
			die("<br /> <a href='/'>Выход</a>");
		}else{
			die("Произошла ошибка в SQL-запросе. Обратитесь к Администратору.<br /> <a href='/'>Выход</a>");
		}
	}
}

function qCount($sql, $params){ // Выводит количество записей
    global $dbConnection;
    $stmt = $dbConnection->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchColumn();
}

function qRows(){ // Выводит кол-во строк другим способом
    global $dbConnection;
    $stmt = $dbConnection->query('SELECT FOUND_ROWS() as num');
    return $stmt->fetchColumn(0);
}

function qInsertId(){ // Последнйи автоинкриментный ID
    global $dbConnection;
    return $dbConnection->lastInsertId();
}

	
?>
