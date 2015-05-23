<?php
use Think\Verify;
//检查用户是否存在
function checkAdmin($adminname,$passwd,$verifycode){
		
	$m = M("Admin");
	$condition['name'] = $adminname;
	//'adminname = admin or 1=1';
	
	//if(!isset($_SESSION['verify_code'])){ return 2;}
	if(!check_verify($verifycode)){
		return  2;
	}
	$result = $m->where($condition)->find();
	if($result!=null){
	
			if(md5($passwd)==$result['passwd']){
			
				session('permission',$result['permission']);
				session('adminid',$result['id']);
				return 3;   //登录成功
			}else {
				return 1;   //密码不正确
			}
	}else{
		return 0;	
	}
}

//验证用户是否合法的代码
function userIsValid(){
	
	if(session('?loginuser')){
		return  true;
	}else{
		return false;
	}
	

}


//生成验证码
function myverify(){
		$config =    array(    'fontSize'    =>    15,    // 验证码字体大小
             'length'      =>    4,     // 验证码位数    
                'useNoise'    =>    false, // 关闭验证码杂点
		);
		$Verify = new Verify($config);
		$Verify->codeSet = '0123456789';
		$Verify->entry();
	}
//检查验证码
function check_verify($code, $id = ''){   
	$verify = new Verify();    
	return $verify->check($code, $id);
}

function getLastTime(){

	//直接写
	//empty isset 函数又区别!!
	//isset 函数可以判断某个变量是否设置过
	//empty 函数判断该变量是为空(empty函数再如下情况会返回真)
	date_default_timezone_set("PRC");
	if(!isset($_COOKIE['lasttime'])){
		//获取当前时间，然后保存
		setcookie("lasttime",date('Y-m-d H:i:s'),time()+3600);
		echo '欢迎你第一次登陆';
	}else{
		echo $_COOKIE['lasttime'];
		setcookie("lasttime",date('Y-m-d H:i:s'),time()+3600);
			
	}
}

//得到上次的id
function getCookieKey($key){

	if(isset($_COOKIE[$key])){
		echo $_COOKIE[$key];
	}else{
		echo "";
	}
		

}

    
 //处理‘未处理’条数的公共函数
  function isnothandlefun(){
    	 $m = M('Order');
    		//购买订单未处理条数
    	$conditon1['ishandled']=0;   //未处理
    	$conditon1['class'] = 1; 
    	$nothandle['nothandledcount_buy'] = count($m->where($conditon1)->select());
    	
    	//售出订单未处理条数
    	$conditon2['ishandled']=0;   //未处理
    	$conditon2['class'] = 0; 
    	$nothandle['nothandledcount_sale']  = count($m->where($conditon2)->select());
    	
    	//用户求助未处理条数
    	$conditon3['ishandled']=0;   //未处理
    	$conditon3['class'] = 0; 
    	$nothandle['nothandledcount_help']  = count($m->where($conditon3)->select());
    	
    	
    	return $nothandle;
    	
    }


?>