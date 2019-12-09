<?php
session_start();

function keycode_start(){
	
		srand((double)microtime()*1000000);
		$_SESSION['Imgkey'] = rand(1000,9999);

}


function keycode_print(){
		
		if($_SESSION['Imgkey']=="" || strlen($_SESSION["Imgkey"])!=4){
			keycode_start();
		}
		
		header ("Content-type: image/png");
		$im = @imagecreate (60, 25);
		
		for($i=0;$i<200;$i++){
		$color=rand(0,255);
		$dian_kuan = rand(1,60);
		$dian_gao = rand(1,25);
		imagesetpixel($im,$dian_kuan,$dian_gao,$color);
		}
		
		$background_color = imagecolorallocate ($im, 200, 200, 200);
		$text_color = imagecolorallocate ($im, 0, 82, 191);
		
		imagestring ($im, 5, 12, 5,  $_SESSION['Imgkey'], $text_color);
		imagepng ($im);
		imagedestroy ($im);
}

function keycode_get(){
	return $_SESSION['Imgkey'];
}
?>