<?php
//JS弹出框
function ErrorJS($MSG,$URL=""){
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n";
	echo "<script lanage=\"javascript\">\r\n";
	
	if( $MSG!="" ){
		echo "alert(\"{$MSG}\")\r\n";
	}
	
	if( $URL=="" ){
		echo "history.back(-1);\r\n";
	}else{
		echo "location='{$URL}';";
	}
	
	echo "\r\n";
	echo "</script>";
	exit;
}





//截取
function substr_utf8($Str,$Lim=0,$Size=0){
	$DefStr		= $Str;
	$ValStr		= mb_substr($Str,$Lim,$Size,"utf-8");
	if( $DefStr==$ValStr ){
		return $ValStr;
	}else{
		return mb_substr($Str,$Lim,$Size-3,"utf-8")."...";
	}
}

//字符串编码转换UTF-8 转换 GB2312或者GB2312 转换UTF-8
function utf_gb( $str,$bask ){
	if( $bask=="utf8" ){
		//输出UTF-8的字符串
		$result		= iconv( "gb2312","utf-8",$str );
	}else{
		//输出GB2312的字符串
		$result		= iconv( "utf-8","gb2312",$str );
	}
	
	return $result;
}

//去除样式和HTML
function clear_html_css($content){
	$content = preg_replace("/<a[^>]*>/i", "", $content);
	$content = preg_replace("/<\/a>/i", "", $content);
	$content = preg_replace("/<div[^>]*>/i", "", $content);
	$content = preg_replace("/<\/div>/i", "", $content);
	$content = preg_replace("/<p[^>]*>/i", "", $content);
	$content = preg_replace("/<\/p>/i", "", $content);
	$content = preg_replace("/<span[^>]*>/i", "", $content);
	$content = preg_replace("/<\/span>/i", "", $content);

	$content = preg_replace("/<!--[^>]*-->/i", "", $content);//注释内容

	$content = preg_replace("/style=.+?['|\"]/i",'',$content);//去除样式
	$content = preg_replace("/class=.+?['|\"]/i",'',$content);//去除样式
	$content = preg_replace("/id=.+?['|\"]/i",'',$content);//去除样式
	$content = preg_replace("/lang=.+?['|\"]/i",'',$content);//去除样式
	$content = preg_replace("/width=.+?['|\"]/i",'',$content);//去除样式
	$content = preg_replace("/height=.+?['|\"]/i",'',$content);//去除样式
	$content = preg_replace("/border=.+?['|\"]/i",'',$content);//去除样式
	$content = preg_replace("/face=.+?['|\"]/i",'',$content);//去除样式
	//$content = preg_replace("/face=.+?['|\"]/i",'',$content);//去除样式
	$content = preg_replace("/face=.+?['|\"]/",'',$content);
	return $content;
}


/**
 * 判断是否为金额
 * @param unknown $Inp
 * @return boolean
 */
function FunIsMoney($Inp){
	if( preg_match("/^[-|+]?[0-9]+[\.[0-9]{0,3}]?$/", $Inp) ){
		return true;
	}else{
		return false;
	}
}

