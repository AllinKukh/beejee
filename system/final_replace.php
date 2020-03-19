<?php
// Устанавливаем на страницу данные из настроек
	$output = str_replace("{SITE_NAME}", $sitename, $output);
	$output = str_replace("{SLOGAN}", $slogan, $output);
	$output = str_replace("{TITLE}", $title, $output);
	$output = str_replace("{DESCRIPTIONS}", $descriptions, $output);
	$output = str_replace("{KEYWORDS}", $keywords, $output);
	$output = str_replace("{CONTENT}", $content, $output);
?>