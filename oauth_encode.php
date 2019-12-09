<?php
//require_once 'inc/auto.inc.php';
require_once './class/oauth_kernal.class.php';

//功能选择
//$Action				= OAuthPOST('act');
$obj                = new oauth_kernal();
if( !empty($_POST['data']) ){
	$date=$_POST['data'];
	
	$j=count($_POST['data']);
	/*//var_dump($j);die;
	if( $j>=2){
		$j=$j/2;
	}*/
    for(  $i=0;$i<$j;$i++ ){
    	$a=$i++;
		$data[$date[$a]]=$date[$i];
    }
	//var_dump($data);die;
    $encryption         = $obj->oauth_encode($data);
	//$a=$_SERVER['HTTP_HOST']."/oauth/oauth_decode.php?";
	echo $encryption;
	return json_encode($encryption);
}



?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript">
		$(function(){
			$url  		= "http://sys.ts.gli.cn/oauth/oauth_decode.php";
			$(".encode_url").val($url);
		});
		
		function encode_append(){
			var num1 = $(".encode_num").val();
			var $id1 = $('.encode_num').data("id");
			var num2 = parseInt(num1)+1;
			var $id2 = $id1+1;
			$(".encode_num").val(parseInt(num1)+1);
			$('.encode_num').attr("data-id",$id1+1);
			$div 		= $("<div style='margin:10px 0px;'></div>");
			$input1		= $("<input type='text' name='"+num1+"'value=''>");
			$span		= $("<span>&nbsp;=>&nbsp;</span>");
			$input2		= $("<input type='text' name='"+num1+num1+"'value=''>");
			$div.append($input1);
			$div.append($span);
			$div.append($input2);
			$(".append_div").append($div);
		}
		function form_submit(){
			data = [];
			var	$input = $('.append_div').find("input[type='text']");
			for(var i=0; i<$input.length;i++){
					if( $input.eq(i).val() == "" ){
						alert("请输入完整信息！");
						return false;
					}else{
						var $value =  $input.eq(i).val()
						data.push($value);
					}
				}
			$.ajax({
				type:"post",
				url:"oauth_encode.php",
				async:true,
				data:{"data":data},
				success:function(data){
					var $url 		= $("#url").val();
					var last_url	= $url+"?"+data;
					$(".encode_url_last").html(last_url);
					$(".encode_url_last").attr("href",last_url);
				}
			});
		}
	</script>
</head>
<body>
	<div style="width: 1000px;margin: 0 auto;">
		<input id="url" class="encode_url" style="width: 100%;height: 50px;border: 1px solid #ccc;margin: 50px 0px;padding: 5px;" value=""/>
		<form  method="post" accept-charset="utf-8" id="formSubmit">
			<input type="hidden" value="2" data-id="2" class="encode_num"/>
		<div class="append_div">
			<div>
				<input type="text" name="1" value=""><span>&nbsp;=>&nbsp;</span><input type="text" name="11" />
			</div>
			<input style="width:50px;cursor: pointer;position: absolute;margin-left: 425px;margin-top: -22px;" type="button" value="+" onclick="encode_append()"/>
		</div>
		<div>
			<input style="margin-left:100px;margin-top:20px; width: 200px;cursor: pointer;" type="button" onclick="form_submit()" value="生成">
		</div>
		</form>
		<div style="width: 100%;height: 50px;border: 1px solid #ccc;margin: 50px 0px;padding: 5px;">
		  <a target="_blank" style="word-wrap: break-word;" class="encode_url_last"></a>
		</div>
		<!--<form  method="post" accept-charset="utf-8" style="margin:20px 0;border-top:1px solid #ccc;padding-top:20px" >
		<div class="append_div_1">
			<div>
			    <span style="color:red">时间设置:</span>
			    <?php if( empty($time) ){?>
			    <input type="text" name="time" value="">
			    <?php }else{?>
			    <input type="text" name="time" value="<?php echo  $time;?>">
			    <?php }?>
				
			</div>
		</div>
		<div>
			<input style="margin-left:80px;margin-top:20px;height:21px;width:173px;cursor: pointer;" type="submit" value="确定">
		</div>
		</form>-->
		
	</div>
</body>
</html>
