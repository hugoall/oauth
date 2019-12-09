<?php 
//require_once 'inc/auto.inc.php';
require_once './class/oauth_kernal.class.php';

//功能选择
//$Action				= OAuthPOST('act');
$obj                	  =new oauth_kernal();
if( !empty($_POST) ){
	if( !empty($_POST['time']) && $_POST['time']>0 ){
		$time			  =intval($_POST['time']);
		$time			  =$obj->oauth_time($time);
	}
    $decrypt            = $obj->oauth_decode($_POST['oauth']);
    
    if( empty($decrypt) ){
        $msg			=$obj->GetErr();
        $Run	= array('error' =>0, 'message' =>$msg);
    }else{
        $msg			=$obj->GetErr();
        $Run	= array('error' =>1, 'message' =>$decrypt,"status"=>$msg);
    }
    //return json_encode($Run);
    //print_r($Run);die;
}
$jiexi          =$_SERVER['QUERY_STRING'];



if( !empty($Run) ){
	var_dump($Run);
    if( !empty($Run['message']['_t']) ){
        unset($Run['message']['_t']);
    }
    if( !empty($Run['message']['_r']) ){
        unset($Run['message']['_r']);
    }
	
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript">
		/* function parsing(){
			var $url = $(".enconde_url").html();
			$.ajax({
				type:"post",
				url:"oauth_decode.php",
				async:true,
				data:{"url":$url},
				
			});	
		} */
	</script>
</head>
<body>
	<div style="width: 1000px;margin: 0 auto;">
		<form method="post" accept-charset="utf-8">
			<textarea class="" name="oauth" style="width: 80%;height: 100px;border: 1px solid #ccc;display:block;word-wrap: break-word;"><?php echo $jiexi ?></textarea>
			<div style="margin-top:20px ;">
				<span style="color:red">时间设置:</span>
				<input type="text" name="time" value=""><span> 分钟</span><br />
			</div>
			<input style="width: 100px;margin-top: 20px; cursor: pointer;" type="submit" value="解析">
		</form>
		<?php if($Run['error']=="1" ){?>
		    <div style="color:green;margin-top:20px"><?php echo $Run["status"]?></div> 
		    <?php foreach ($Run['message'] as $v=>$r){?>
    		<div style="margin-top: 20px;">
    			<input type="text" name="" value="<?php echo $v ?>"><span>&nbsp;=>&nbsp;</span><input type="text" name="11" value="<?php echo $r ?>" />
    		</div>
    		<?php }?>
		<?php }elseif( $Run['error']=="0" ){?>
    		<div style="margin-top: 20px;">
    			<div>错误提示：<span style="color:red"><?php echo $Run['message']?></span></div>
    		</div>
		<?php }?>
	</div>
</body>
</html>
