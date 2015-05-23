<?php
use Think\Verify;
//生成验证码
function verify(){

	$config = array(
		'fontSize' => 20,    // 验证码字体大小
	    'length' => 4,     // 验证码位数    
	    'useNoise' => false, // 关闭验证码杂点
	    'useCurve' => true
	);
	$Verify = new Verify($config);
	$Verify->codeSet = '0123456789';
	$Verify->entry();
	}

	function check_verify($code, $id = ''){   
		$verify = new Verify();    
		return $verify->check($code, $id);
	}

	function sendEmail($username,$email,$activecode){

       #echo "<br />userinfo->truename: ".$username."<br />userinfo->email: ".$email."<br />upc->token: ".$activecode;

		header('Content-type:text/html;charset=utf-8');
     	vendor("PHPMailer.class#phpmailer"); //从PHPMailer目录导入class.phpmailer.php类文件
     	$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
		 
		$mail->IsSMTP(); // telling the class to use SMTP
		 
		try {
			$mail->Host       = "smtp.163.com"; // SMTP server 部分邮箱不支持SMTP，QQ邮箱里要设置开启的
			$mail->SMTPDebug  = false;        // 改为2可以开启调试
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->Port       = 25;                 // set the SMTP port for the GMAIL server
			$mail->CharSet = "UTF-8";            // 这里指定字符集！解决中文乱码问题
			$mail->Encoding = "base64";
			$mail->Username   = "ibook_service@163.com"; // SMTP account username
			$mail->Password   = "ibookadmin";        // SMTP account password
			$mail->AddAddress($email, ''); //发送到的地址
			$mail->SetFrom('ibook_service@163.com', '理工二手书');     //发送者邮箱
			$mail->AddReplyTo('ibook_service@163.com', '理工二手书'); //回复到这个邮箱
			$mail->Subject = '用户帐号激活';
			$emailbody = "亲爱的 ".$username."：<br/>感谢您在理工二手书注册了新帐号。<br/>请点击链接激活您的帐号。<br/>
    <a href='http://localhost".__MODULE__."/Register/active/activecode/".$activecode."'target='_blank'>http://localhost".__MODULE__."/Register/active/activecode/".$activecode."</a>
    <br/>如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。<br/>如果此次激活请求非你本人所发，请忽略本邮件。
    <br/><p style='text-align:right'>-------- 理工二手书 敬上</p>";
			$mail->MsgHTML($emailbody);
		  	//$mail->AddAttachment('images/phpmailer.gif');      // attachment
		 	//$mail->AddAttachment('images/phpmailer_mini.gif'); // attachment
		  	$mail->Send();
		  	return true;
		}catch (phpmailerException $e) {
		  	echo $e->errorMessage(); //Pretty error messages from PHPMailer
		  	return false;

		} 	catch (Exception $e) {
		  	echo $e->getMessage(); //Boring error messages from anything else!
		  	return false;
		}
	}

	function utf(){
		header("Content-Type:text/html;charset=utf-8"); 
	}

	function loginCheck($username,$passwd){
		$user = M('Upc');
		$condition['username'] = $username;
		$ret = $user->where($condition)->find();
		if($ret){
			if($ret['passwd'] != $passwd){
				return 1;
			}else if($ret['status'] == 0){
				return 2;	//注册了但未激活
			}
			else{
				return $ret;
			}
		}else{
			return 0;
		}


	}
	
	
	
	//检查用户是否已经登录
	function userIsValid(){
	
		if(session('?_loginuser')){
			return  true;
		}else{
			return false;
		}

	}

?>
