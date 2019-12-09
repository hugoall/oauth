<?php
function TemplateGet(){
	$Template						= array();
	$Template['TemplatePublicInfo']	= array(
		"web_name"=>gli_web_name,"web_host"=>gli_web_host,"web_static"=>UPLOADPIC_SERVER
	);
	
	
	/**
	 * 用户注册成功发送的欢迎电子邮件模板
	 * [WebInfo]=$TemplatePublicInfo
	 * [UserInfo]用户信息字段数组， 例如用户登录帐号替换为[BuyerUsername]
	 */
	$Template['TemplateUserRegTitle']	= '欢迎您《[BuyerRealname]》，[web_name]:注册成功';
	$Template['TemplateUserRegText']	= '欢迎您《[BuyerRealname]》，您已经成功注册了[web_name]<br>登录帐号:[BuyerUsername]<br>注册邮箱:[BuyerEmail]<br>请牢记您的注册信息。<br>
									==========================================================
									<br><a href="[web_host]">[web_name]</a>';
	
	
	
	
	/**
	 * 用户忘记密码发送的邮件配置
	 * [WebInfo]		= $TemplatePublicInfo
	 * [UserInfo]		= 用户信息字段
	 * [CallBackURL]	= 回调的访问地址
	 */
	$Template['TemplateRetrieveTitle']	= "[BuyerRealname],密码取回邮件：[web_name]！";
	$Template['TemplateRetrieveText']	= '亲爱的《 [BuyerRealname] 》， 这是一封密码取回邮件，如果您未申请密码取回功能，可不用理会该信息，您的密码将不会作出任何改变，除非您把本邮件内容泄露给其他人。<br>
									<br>如果您确实申请了密码取回功能，请<a href="[CallBackURL]">点击该连接</a>进行密码取回操作<br><br>
									==========================================================
									<br><a href="[web_host]">[web_name]</a>';
	
	
	
	
	
	
	/**
	 * 验证用户邮箱的模板
	 * [WebInfo]		= $TemplatePublicInfo
	 * [UserInfo]		= 用户信息字段
	 * [CallBackURL]	= 回调的访问地址
	 */
	$Template['TemplateEmailVerTitle']	= " [BuyerRealname]， 请验证您的邮箱地址正确性:[web_name]";
	$Template['TemplateEmailVerText']	= '亲爱的《 [BuyerRealname] 》， 您在[ [web_name] ]申请了邮箱验证，请按照以下步骤操作，完成您的邮箱验证<br>
									<br>请<a href="[CallBackURL]">点击该连接</a>进行验证的操作<br><br><'.rand(1000,9999).'>
									================================================================================
									<br>本邮件由不受监控的系统邮箱发送,请勿尝试回复或者联系本邮箱.<a href="[web_host]">[web_name]</a>';
	
	
	return $Template;
}

function TemplateEmailParse($Template,$TemplateVal=array()){
	if( is_array($TemplateVal) ){
	foreach($TemplateVal as $TempName=>$TempValue){
		$Template = str_replace("[{$TempName}]", "{$TempValue}", $Template);
	}
	}
	$RegExp		= '/\[[a-z0-9-_]+\]/i';
	$Template	= preg_replace($RegExp,"",$Template);
	
	return $Template;
}

