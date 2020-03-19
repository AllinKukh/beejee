<?

// Из строки $str вырезаем часть от <$beg> до <$end>
function parser($str, $beg, $end){
	$result=false;
	if ($beg){
		$b=strpos($str, $beg);
		if ($b !==false){
			$b+=strlen($beg);
			$result=substr($str,$b);
		}
	}else{
		$result=$str;
	}
	if ($end){
		$e=strpos($result, $end);
		if ($e !==false){
			$result=substr($result,0,$e);
		}
	}
	return $result;
}	


?>