<?php
//error_reporting(0);					// Не выводить ошибки (включить на "боевой" версии)	
session_start();						// Работаем с сессиями
require_once 'system/functions_.php';	// Подключаем общие функции приложения
require_once 'system/db_.php';			// Конфигурация и ф-ции работы с БД
require_once 'system/site_.php';		// Общие настройки сайта 

// Инициализация переменных
$admin=false;		// Признак авторизации администрантора
$request= '';		// Параметры из строки url запроса
$output = '';		// Здесь формируется полный текст страницы
$content = '';		// Здесь формируется контекстная часть страницы
$header = '';		// Текст хедера
$footer = '';		// Текст футера

$request = $_SERVER['REQUEST_URI'];				// Получаем URL в переменную $result 
$request = parser($request,'','?');				// Оставляем часть GET параметров

//проверяем, что бы в URL не было "мусора", иначе 404
if (preg_match ('/([^a-zA-Z0-9\.\/\-\_\#])/', $request)) {
	header('HTTP/1.0 404 Not Found');
	exit;
}

// отбрасываем из ЧПУ всё лишнее
$request = preg_split ('/(\/|\..*$)/', $request,-1, PREG_SPLIT_NO_EMPTY);

$output = implode("",file("view/index.html"));	// Загружаем шаблон сайта

// обработка запроса ЧПУ
$controller = 'main';
if (isset($request[0]) ){		
	$controller = $request[0];					// Определяем контроллер
}

// Проверяем наличие контроллера иначе главный
if( !file_exists("controller/$controller.php") ){
	$controller = 'main';
}

require_once 'system/start.php';				// Инициализация приложения
require_once "controller/$controller.php";		// Вызываем контроллер
require_once 'system/final_replace.php';		// Замена определений в шаблоне на значения
echo $output;

?>
