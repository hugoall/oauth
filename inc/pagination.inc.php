<?php
################################################
# 分页函数
# 
# 传入参数[$Page 		当前页数
# 		  $PageSize		每页大小
#		  $PageNum		总共纪录数目
#		  $UrlText		当前已经配置的地址参数
#		  $QuekTo		快速跳转按钮
function Pagination($Page,$PageSize,$PageNum,$UrlText,$QuekTo=false){
	
	$PagePage	=	ceil($PageNum/$PageSize);	//总共页数
	$PageUrl	=	'';							//页面连接代码
	$PageFile	=	substr($_SERVER['REQUEST_URI'],0,strpos($_SERVER['REQUEST_URI'],"?"));//页面文件的地址
	$Page		=	( ceil($Page)>1 )? ceil($Page):1;
	
	
	if($Page<10){//如果当前页数小于10
		
		if($PagePage<10){
		#------------------如果总共页数小于10
			for($i=1;$i<=$PagePage;$i++){
				if($i==ceil($Page)){
					$PageUrl.="<font color=#ff0000>[$i]</font>";
				}else{
					$PageUrl.="<a class='page_num' href=$PageFile?$UrlText&p=$i>[$i]</a>";
				}
			}
		#---------------end
		}else{
		#---------------如果总共页数大于10
			for($i=1;$i<=10;$i++){
				if($i==ceil($Page)){
					$PageUrl.="<font color=#ff0000>[$i]</font>";
				}else{
					$PageUrl.="<a class='page_num' href=$PageFile?$UrlText&p=$i>[$i]</a>";
				}
			}
					$PageUrl.="...<a class='page_num' href=$PageFile?$UrlText&p=$PagePage>[$PagePage]</a>";
		#---------------end	
		}
		
	}else{//如果大于10
		
		$PageUrl.="<a class='page_num' href=$PageFile?$UrlText&p=1>[1]</a>...";
		
		for($i=$Page-5;$i<=$Page+5 & $i<=$PagePage;$i++){
			
				if($i==ceil($Page)){
					$PageUrl.="<font color=#ff0000>[$i]</font>";
				}else{
					$PageUrl.="<a class='page_num' href=$PageFile?$UrlText&p=$i>[$i]</a>";
				}
		}
		
		if($i<=$PagePage){
			
			$PageUrl.="...<a class='page_num' href=$PageFile?$UrlText&p=$PagePage>[$PagePage]</a>";
			
		}
		
	}
	
	if($PagePage==0){
		$PageUrl.="[1]";
	}
	
	
	if($Page>1){
		$PageUrl="<a class='page_num' href=$PageFile?$UrlText&p=".intval($Page-1).">[&lt;]</a>".$PageUrl;
		$PageUrl="<a class='page_num' href=$PageFile?$UrlText&p=1>[&lt;&lt;]</a>".$PageUrl;
	}else{
		$PageUrl="<span>[&lt;]</span>".$PageUrl;
		$PageUrl="<span>[&lt;&lt;]</span>".$PageUrl;
	}
	
	
	if($Page<$PagePage){
		$PageUrl.="<a class='page_num' href=$PageFile?$UrlText&p=".intval($Page+1).">[&gt;]</a>";
		$PageUrl.="<a class='page_num' href=$PageFile?$UrlText&p=$PagePage>[&gt;&gt;]</a>";
	}else{
		$PageUrl.="<span>[&gt;]</span>";
		$PageUrl.="<span>[&gt;&gt;]</span>";
	}
	
	if( $QuekTo==true ){
		$PageUrl.="&nbsp;&nbsp;<span><input type=\"text\" style=\"width:25px;height:18px;\" value=\"{$Page}\" onblur=\"window.location='{$PageFile}?{$UrlText}&p='+this.value\" onkeyup=\"javascript:function(e){if(e.keyCode==13){window.location='';}}\" /></span>";
	}
	
	return $PageUrl;
}

