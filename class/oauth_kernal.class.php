<?php
/**
 * OAUTH交互协议接口
 * @author Administrator
 * 
 * 2015-10-13 修正接口写法与名称定义
 */
class oauth_kernal{
	
	//加密公钥
	//protected  private
	protected $oauth_public_key	= '';
	//错误提示
	protected $Err				= '';
	//有效时间
	protected $time             =15;
	
	
	
	/**
	 * 修改公钥
	 *
	 */
	public function oauth_key( $OauthKey ){
		return $this->oauth_public_key	= $OauthKey;
	}
	
	
	/**
	 * 修改有效时间
	 * 
	 */
	public function oauth_time( $oauth_time ){
	    return $this->time= ceil( $oauth_time );
	}
	
	
	
	
	/**
	 * 将数组信息加密成OAUTH协议字符串
	 * @param unknown $rows
	 * @return string			a=1&b=2&c=3
	 */
	public function oauth_encode( $Row,$RunArr=false ){
		
		//数组是否存在时间如没有，则添加
		if( !array_key_exists("_t",$Row) ){
			$Row['_t']		= time();
		}
		if( !array_key_exists("_r",$Row) ){
			$Row['_r']		= rand(100,9999);
		}
	    if( empty($Row)||!is_array($Row) )return "";
		
    	$URL 				= "";
    	foreach($Row as $Vs=>$Rs){
    	    if( !preg_match("/^[_a-zA-Z0-9]+$/", $Vs) ){
    	        return "";
    	    }
    		$URL   .= urlencode($Vs)."=".urlencode($Rs)."&";
    	}
    	
    	$ToKen				= md5( $this->oauth_public_key.$URL.$this->oauth_public_key );
    	$URL 	   		   .= "_token_=" . $ToKen;
    	$Row['_token_']		= $ToKen;
    	
    	if( $RunArr!==true ){
    		return $URL;
    	}else{
    		return $Row;
    	}
	}
	
	
	/**
	 * 将加密的OAUTH协议字符串解析为数组
	 * @param 带格式的字符串 $Text  a=1&b=2&c=3
	 * @return array(status=>boolean,error=>'错误说明',rows=>array())
	 */
	public function oauth_decode( $Text ){
		
	    $Arr                       	= array();
	    
	    if( empty($Text) ){
	        $this->Err				= "请输入参数";
	        return false;
	    }
	    if( !is_array($Text) ){
	        $TmpArr                 = preg_split("/[=|&]+/i", $Text);
	        if( !is_array($TmpArr)||empty($TmpArr) ){
	            $this->Err			= "非法字符串";
	            return false;
	        }
	        
	        $data  					= array();
	        for($i=0;$i<count($TmpArr);$i+=2){
	            $data[ $TmpArr[$i]]	= $TmpArr[$i+1];
	        }
	    }
	    
	    $WsiaKEY 	= $data['_token_'];
	    $URL 		= "";
	    foreach($data as $Vs=>$Rs){
	        if( $Vs=="_token_" ) continue;
            if( $Vs=="_t" ){
	        	//字符串后十位的时间戳；加密连接的时间大于15分钟就为过期
	        	if( ((time()-$Rs)/60)>$this->time && empty($times) ){
	        	    $this->Err		= "时间已过期或数据丢失";
	        	    return false;
	            }
            }
            
            if( $Vs=="_r" ){
            	//如果随机数字不是3~4位且第一位不小于1,否则错误
            	$torand				= preg_match('/^[1-9]\d{2,3}$/', $Rs);
            	if( empty($torand) ){
            	    $this->Err		= "非法操作2";
            	    return false;
                }
            }
            
	        $URL 		   .= strval($Vs)."=".strval($Rs)."&";
	        $Arr[$Vs] 		= urldecode($Rs);
	    }
	    
	    $WsiaIn 			= md5( $this->oauth_public_key.$URL.$this->oauth_public_key );
	    
	    if( $WsiaKEY==$WsiaIn ){
	        $this->Err		="通过验证";
	        return $Arr;
	    }else{
	        $this->Err		= "信息错误";
	        return false;
	    }
	}
	
	
	
	/**
	* 错误提示
	*/
	public function GetErr(){
	    return $this->Err;
	}
}