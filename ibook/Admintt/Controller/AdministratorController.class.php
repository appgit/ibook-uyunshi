<?php
// 本类由系统自动生成，仅供测试用途
namespace Admintt\Controller;
use Think\Controller;
use Think\Verify;
require_once MODULE_PATH."Common/common.php";
class AdministratorController extends Controller {
    public function index(){
    	
    	$this->display();
    }
    public  function login(){
    	//$cc = new Verify();
    	//echo check_verify($_POST['verifycode']);
   
		   
    	
    	 if(!empty($_POST['adminname'])&&!empty($_POST['passwd'])&&!empty($_POST['verifycode'])){
    		$adminname =$_POST['adminname'];
    		$passwd = $_POST['passwd'];
    		$verifycode = $_POST['verifycode'];
    	}else {
    		$this->error("用户名或密码或验证码不得为空!!!");
    	}
    	
    //	$m = M("Admin");
    	//var_dump($passwd);
    	$result = checkAdmin($adminname,$passwd,$verifycode);
	
    	//var_dump($result);
    	if($result==2){
    		$this->error('验证码错误，请重新登录！');
    	}
    	if($result!=0){
    		
    		if($result==3){
    		//echo 'dfklsjffdfdsfdsfd';
    		  session('loginuser',$adminname);
    		  
    			$this->success("登录成功，正在跳转...",__MODULE__."/Home/index");
    			//header("admintt.php/Admintt/Home");
    		}else{
    			$this->error("密码错误，请重新输入！");
    		}
    		
    	}else {
    		$this->error("登录失败，用户名不存在，请重新输入！");
    	}
    	
    }

    //安全退出函数；
    
 public function dropout(){
 	   //echo session('？loginuser')."fdffff";
    	if(session('?loginuser')!=null){
    		session('loginuser',null);
    		session('permission',null);
    		//跳转到主页
    		//echo "ddddddddd";
    	}
    	$this->success("安全退出中........",__MODULE__."/Index/index");
    	
    }
}