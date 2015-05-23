<?php
// 本类由系统自动生成，仅供测试用途


namespace ADadmin\Controller;
use Think\Controller;
require_once MODULE_PATH."Common/common.php";

class RegisterController extends Controller {
    
    public function index(){
        #echo date('Y-m-d H:i:s',time()+24*60*60);
        
        $this->display();
    }

    public function doReg(){

    	$upc = D('Upc');
    	$upc->create();

    	if(!$upc->getError()){	//upc数据输入合法

            $upc->token = md5($upc->username.$upc->passwd.time());//创建激活码
            $upc->token_exptime = date('Y-m-d H:i:s',time()+24*60*60);
            $upc->status = 1;

            $userinfo = D('Userinfo');
            $userinfo->create();
            // echo $upc->token;
            // dump($upc);
            // exit;

    		if(!$userinfo->getError()){	//userinfo数据合法

                
               

                    $upcid = $upc->add();
                    echo "id:"."$upcid";

                    $userinfo->upcid = $upcid;
                    $userinfo->regdate = date('Y-m-d H:i:s',time());
                     
                    
                    $userinfoid = $userinfo->add();
                     dump($userinfoid);
                    $coin = M('coin');

                    $coin_data['userid'] = $userinfoid;

                    $coin->add($coin_data);

                   $arr['status'] = 'success';
                  echo json_encode($arr);  //注册成功
               

    			
    		}else{
    			$arr['status'] = 'fail';
                  echo json_encode($arr); 
    			 //注册失败
    		}

    	}else{
        $arr['status'] = 'exist';
                  echo json_encode($arr); 
    		 //用户名已存在
    	}
    }

  

    public function verify(){
    	verify();
    }



}



