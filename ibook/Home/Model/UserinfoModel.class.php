<?php 
	namespace Home\Model;
	use Think\Model;
	use Think\Model\RelationModel;
	class UserinfoModel extends RelationModel{
	   protected $_validate = array(     
		   array('code','require','请输入验证码！'),
		   array('code','check_verify','验证码错误！',0,'function',3),
		   array('username','require','用户名不能为空！'),
		   array('username','isUserExist','用户名已经存在！',0,'function',1),
		   array('passwd','6,14','密码长度为6-14个字符',0,'length'),
		   array('repasswd','passwd','确认密码不正确',0,'confirm'),
		   array('tel','require','请输入联系电话！'),
		   array('tel','number','联系电话非法！'),
		   array('email','email','邮箱格式不正确！'),
		   array('email','isEmailExist','该邮箱已被注册',0,'function',1),
		   // array('number','require','请填写正确的学号！'),
		   array('addr','require','请输入您的地址！'),
		   // array('truename','require','请输入您的真实姓名！'),
	   );
	   protected $_auto = array (          
		   array('passwd','md5',3,'function') , 
		   );

	   protected $_link = array( );
	}
 ?>

