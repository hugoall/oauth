<?php
require_once '../inc/config.inc.php';
require_once '../inc/auto.inc.php';

$callback                   = $_POST['callback'];
// $Filef                      =new upfile();
//图片上传管理
$upLoadType 				= ( isset($_POST['upload_type']) ) ?  $_POST['upload_type']  : $_GET['upload_type'];
$upLoad 					= array("filename"=>"","upload"=>true,"error"=>"上传出错.",);
$Setting   					= array();
$Setting["fileField"]		= "upfile";
$Setting["savePath"]		= UPLOADPIC_DIR."move_pic/";
$Setting["fileHttp"]		= UPLOADPIC_DIR."move_pic/";
$Setting["fileType"]		= array("jpg","png","jpeg","gif");
$Setting["fileSize"]		= 1024*1024*2;
$Setting["fileDate"]		= FALSE;

$upFile					    = new upfile($Setting);
$upFilePath  			    = $upFile->saveFile();

if( empty($upFilePath) ){
    $upLoad['upload']	    = false;
}else{

    $sess_uparray		    = array('fs_time'=>date("Y-m-d H:i:s"),
                                    'fs_path'=>'/images/move_pic/'.basename($upFilePath),
                                    'fs_http'=>UPLOADPIC_SERVER.'/images/move_pic/'.basename($upFilePath),
                                    'fs_name'=>$_FILES['upfile']['name'],
                                    'fs_size'=>filesize(UPLOADPIC_DIR."/move_pic/".basename($upFilePath)),
                                    'fs_type'=>preg_replace('/^[^\.]+/i','',basename($upFilePath))
                                    );

}
echo "<script>window.parent.{$callback}(".json_encode($sess_uparray).")</script>";die;
