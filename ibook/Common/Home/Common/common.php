<?php
use Think\Verify;


/*-------------
U('Index/index','参数：如 cate_id=1&status=1','伪静态后缀');
跳转：
redirect('New/category/cate_id/2', 5, '页面跳转中...')
$this->redirect('Index/index', array('cate_id' => 2), 5, '页面跳转中...');
$this->success('提示消息','../Index/index');
-------------*/
$domin = C('__DOMIN__');	
define('__DOMIN__',$domin );


//生成验证码
function verify($fontsize){

	$fontsize = isset($fontsize) ? $fontsize : 20;
	$config = array(
		// 'imageW' =>200,
		'fontSize' => $fontsize,// 验证码字体大小
		'length' => 4,	// 验证码位数
		'useNoise' => false, // 关闭验证码杂点
		'useCurve' => true
	);
	$Verify = new Verify($config);
	$Verify->codeSet = '0123456789';
	$Verify->entry();
}

//验证码校验
function check_verify($code, $id = ''){

	$verify = new Verify();
	return $verify->check($code, $id);
}

/*用户是否注册（含有是否qq登录的区分）*/
function isUserExist($username){
	$user = M('userinfo');

	$sql['username'] = $username;
	$sql['isqq'] = 0;

	if($user->where($sql)->find()){

		return false;
	}else{
		return true;
	}
	// dump($username);
}

/*邮箱是否注册(含有是否是qq登陆的区分)*/
function isEmailExist($email){
	$user = M('userinfo');

	$sql['email'] = $email;
	$sql['isqq'] = 0;

	if($user->where($sql)->find()){

		return false;
	}else{
		return true;
	}
	// dump($username);
}

/*缩略图生成*/
function resizeimage($img,$x,$y){

	//类型只能是jpg或者jpeg
	$sizex = 140;
	$sizey = 144;
if( isset($x) && isset($y) ){
	$sizex = $x;	
	$sizey = $y;	
}

	vendor('PhpThumb.ThumbLib#inc');
	$PhpThumbFactory = new PhpThumbFactory();
	$error = false;

	try{
		$img_jpg = $img.'.jpg';
		$thumb = $PhpThumbFactory->create($img_jpg);
		// $thumb = PhpThumbFactory::create($img);

	} catch (Exception $e) {// dump('not jpg');

		$error = true;
		try {
			$img_jpeg = $img.'.jpeg';
			$thumb = $PhpThumbFactory->create($img_jpeg);
			$error = false;
		} catch (Exception $e) {}// dump('not jpeg');		
	}
	if(!$error){
		$thumb->adaptiveResize($sizex, $sizey);
		$thumb->show();	
	}
}

//发送邮件
function sendEmail($username,$email,$activecode,$is_forget_passwd){

	#echo "<br />userinfo->truename: ".$username."<br />userinfo->email: ".$email."<br />upc->token: ".$activecode;

	header('Content-type:text/html;charset=utf-8');

	vendor("PHPMailer.class#phpmailer"); //从PHPMailer目录导入class.phpmailer.php类文件

	$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
	
	$mail->IsSMTP(); // telling the class to use SMTP


//发送注册邮件
if( !isset($is_forget_passwd) ){

	$subject = '用户帐号激活';	//邮件标题

	$arr = array(
			'$_USERNAME' => $username,
			'$_MODULE' => __DOMIN__.__MODULE__,
			'$_ACTIVECODE' => $activecode
		);

	$html = file_get_contents(T('Mailhtml/active'));

	$emailbody = bat_str_replace($arr,$html);

	}else{	//发送忘记密码邮件

		$subject = '用户重置密码';	//邮件标题

		$arr = array(
			'$_USERNAME' => $username,
			'$_MODULE'	=> __DOMIN__.__MODULE__,
			'$_VERIFY'	=> $activecode
			);

		$html = file_get_contents(T('Mailhtml/resetpasswd'));

		$emailbody = bat_str_replace($arr,$html);
	}
	
	try {
		$smtpservice = "uyunshi";
		$admin_email = "uyunshi@uyunshi.com";
		$admin_passwd = "youyunwang99";
		$admin_emailtitle = "优云";

		$mail->Host	= "smtp.".$smtpservice.".com"; // SMTP server 部分邮箱不支持SMTP，QQ邮箱里要设置开启的
		$mail->SMTPDebug  = false;	 // 改为2可以开启调试
		$mail->SMTPAuth   = true;	// enable SMTP authentication
		$mail->Port	= 25;		 // set the SMTP port for the GMAIL server
		$mail->CharSet = "UTF-8";	   // 这里指定字符集！解决中文乱码问题
		$mail->Encoding = "base64";
		$mail->Username   = $admin_email; // SMTP account username
		$mail->Password   = $admin_passwd;	 // SMTP account password
		$mail->AddAddress($email, ''); //发送到的地址
		$mail->SetFrom($admin_email, $admin_emailtitle);	//发送者邮箱
		$mail->AddReplyTo($admin_email, $admin_emailtitle); //回复到这个邮箱
		$mail->Subject = $subject;


		$mail->MsgHTML($emailbody);
		
		//$mail->AddAttachment('images/phpmailer.gif');	// attachment
		//$mail->AddAttachment('images/phpmailer_mini.gif'); // attachment
		
		$mail->Send();

	}catch (phpmailerException $e) {

		echo $e->errorMessage(); //Pretty error messages from PHPMailer
		return false;

	}catch (Exception $e) {

		echo $e->getMessage(); //Boring error messages from anything else!
		return false;
	}
	return true;

}



//调试的时候dump时防止乱码，若没涉及到模板渲染的话
function utf(){

	header("Content-Type:text/html;charset=utf-8"); 
}
function session_dump(){
	dump($_SESSION);exit;
}




//登录验证
function loginCheck($username,$passwd){	

	$user = M('userinfo');

	$condition['username'] = $username;
	$condition['isqq'] = 0;

	$ret = $user->where($condition)->find();

	// dump($ret);exit;

	if($ret){

		if($ret['passwd'] != md5($passwd)){

			return 1;	//密码错误

		}else if($ret['status'] == 0){

			return 2;	//注册了但未激活

		}else{

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



//获得当前时间或者指定时间
function get_datetime($time){

	if( !isset($time) ){

		$time = time();
	}
	return date('Y-m-d H:i:s',$time);
}


//多session写入
function set_session($arr){

	foreach ($arr as $key => $val) {

		session($key,$val);
	}
}



function get_user(){

	$myinfo = D('UserinfoView');

		$ret = $myinfo->find(session('_userinfoid'));
		// dump($ret);return;

		return $ret;

}



function home_url($login){

	// if( isset($login) ){

	// 	session('_dologin',true);
	// }
	return U('Index/index','','');
}




// 直接调用函数 --判断用户有没有登陆过，没有则跳到登陆页
function go_login(){	

	if(!userIsValid()){

		$home = A('Index');
		
		$home->_go_login();
	}else{

		return true;
	}
}


/*批量替换字符串
-----外部文件中用 $_NAME 来占位需要替换的变量名字(命名规范)*/
function bat_str_replace($bat_arr,$str){

	foreach ($bat_arr as $key => $value) {
		
		$str = str_replace($key, $value, $str);
	}

	return $str;
}




//确认密码验证
function passwd_verify($passwd1,$passwd2){

	if($passwd1 !== $passwd2){

		return 1;				//密码不一致
	}
	else if( strlen($passwd1) < 6 ){	

		return 2;	//验证条件这里写，或者写到函数里
	}else{

		return 3;	//ok
	}
}


function get_type($sptypeid){

	$req['sptypeid'] = $sptypeid;

	$s_type = $b_type = $ret = array();

	$type = D('TypeView')->where($req)->order('btypeid')->select();

	foreach ($type as $key => $value) {

	// $s_type[$value['btypeid']]['title'] = $value['btype'];

	$b_type[$value['btypeid']] = $value['btypename'];

	$s_type[$value['btypeid']][] = $value['stypename'];

	}

	$ret['btype'] = $b_type;

	$ret['stype'] = $s_type;

	 // dump($ret);return;
	return $ret;
}


 function get_stypeid(){

	$stype = D('TypeView');

	$arr = get_type();

	$btypename = $arr['btype'][session('_btypeid')];
	$stypename = $arr['stype'][session('_btypeid')][session('_stypesub')];

	$req['btype'] = $btypename;
	$req['stype'] = $stypename;

	$ret = $stype->where($req)->find();

	return $ret['id'];
}

/*自动登录*/
function autologin(){
	if (cookie('verify')) {	//自动登录检查
		# code...
		$verify = cookie('_verify');

		$req['verify'] = $verify;
		$time = time();
		$autologin = M('autologin')->where($req)->find();

		if( $autologin['token_exptime'] > $time ){

			$user['id'] = $autologin['userid'];

			$userinfo = M('userinfo')->where($user)->find();
			// dump($userinfo);

			$arr = array(   //session 信息
			'_loginuser' => $userinfo['username'],
			'_userinfoid' => $userinfo['id'],
			);

			set_session($arr);

		}
	}
}

function randomStype(){
	
}

/*分页*/
function pageTool($page,$pages,$url_no_page){

	$side_step = 2;

	$url_base = $url_no_page."/page/";

	if($page>1){
		$prepage = $page-1;
		$page_url = $url_base.$prepage;
		echo "<a href='$page_url' class='backpage'>上一页</a>";	
	}else{
		$page_url = $url_base.$page;
		echo "<a href='javascript:;' class='backpage disabled'>上一页</a>";
	}
 
	if($page <= $side_step+2){

		for($i=1;$i<=$page-1;$i++){
		  $page_url = $url_base.$i;
		  echo " <a href='$page_url'>$i</a> " ;
		}

		$page_url = $url_base.$i;
		echo " <a href='$page_url' class='active'>$i</a> " ;

		if(($pages-$page)<=$side_step+1){

			for($i=$page+1;$i<=$pages;$i++){
				$page_url = $url_base.$i;
				echo "<a href='$page_url'>$i</a> " ;
			} 

		}else{
	 		for($i=$page+1;$i<=$page+$side_step;$i++){

				$page_url = $url_base.$i;
				echo " <a href='$page_url'>$i</a> " ;
			}
			echo "<a href='javascript:;'>...</a>";

			$page_url = $url_base.$pages;
			echo "<a href='$page_url'>$pages</a>"; 
		}

	}else {
		$page_url = $url_base."1";
		echo "<a href='$page_url'>1</a>";
		echo "<a href='javascript:;'>...</a>";

		for($i=$page-$side_step;$i<$page;$i++){
			$page_url = $url_base.$i;
			echo " <a href='$page_url'>$i</a> " ;
		}
		$page_url = $url_base.$i;
		echo " <a href='$page_url' class='active'>$i</a> " ;
		
		if(($pages-$page)<=$side_step+1){
			for($i=$page+1;$i<=$pages;$i++){
				$page_url = $url_base.$i;
				echo " <a href='$page_url'>$i</a> " ;
			} 
		}else{
			
			for($i=$page+1;$i<=$page+$side_step;$i++){
				$page_url = $url_base.$i;
				echo " <a href='$page_url'>$i</a> " ;
			} 
			echo "<a href='$page_url'>..</a>";

			$page_url = $url_base.$i;
			echo "<a href='$page_url'>$pages</a>";
		}
	}

	if($page<$pages){

		$nextpage =$page+1;
		$page_url = $url_base.$nextpage;
		echo "<a href='$page_url' class='nextpage'>下一页</a>";
	}else{

		echo "<a href='javascript:;' class='nextpage disabled'>下一页</a>"; 
	}

	echo "<span class='total-pages'>共 $pages 页</span><form class='gp-page' action='$url_no_page'>
		去第 <input class='enter-page' name='page' size='3' type='text'>页
		<input value='Go' type='submit' class='submit'>
	</form>";
}

/*排序*/
function array_sort($arr,$keys,$type='asc'){ 
	$keysvalue = $new_array = array();
	foreach ($arr as $k=>$v){
		$keysvalue[$k] = $v[$keys];
	}
	if($type == 'asc'){
		asort($keysvalue);
	}else{
		arsort($keysvalue);
	}
	reset($keysvalue);
	foreach ($keysvalue as $k=>$v){
		$new_array[$k] = $arr[$k];
	}
	return $new_array; 
} 

/*发布商品检查*/
function pubproCheck(){
	if($_POST['stype'] == ''|| !isset($_POST['stype'])){
		return "请选择类目";
	}else{
		return true;
	}
}

function echo_error($str){
	$str = isset($str)?$str:"操作失败";
	echo "<script>alert('".$str."');</script>";
}


function qqlogin($acess_token='',$openid='',$info=null){

     //新建一个用户与之绑定
	 $req['openid'] = $openid;
	 $qquser= M('Qqlogin')->where($req)->find();
	 // echo "dfdsuuuuuuuu";
	 if(!$qquser){
	
            $date =array('isqq'=>1,'username'=>$info['nickname'],'regdate'=>time(),'status'=>1,'passwd'=>'uyunshi','email'=>'xxx@xx.com','addr'=>'请自行修改地址','tel'=>'18888888888');
			
            $uid = M('Userinfo')->add($date);
			$date2 = array('userid'=>$uid,'openid'=>$openid,'acesstoken'=>$acess_token);
             M('Qqlogin')->add($date2);
		//	echo "dfdsfsdfddddddd".$uid;
            

                
                // dump($userinfo);

                $arr = array(   //session 信息
                '_loginuser' => $info['nickname'],
                '_userinfoid' => $uid ,
                );

                set_session($arr);

           
	}else{
	 //echo "dfdsfsdfdddddddyyyyyyyyy";
	    $uid = $qquser['userid'];
		$date2 = array('userid'=>$uid,'openid'=>$openid,'acesstoken'=>$acess_token);
             M('Qqlogin')->save($date2);
		 $arr = array(   //session 信息
                '_loginuser' => $info['nickname'],
                '_userinfoid' => $uid ,
                );

                set_session($arr);
	
	}

}

?>
