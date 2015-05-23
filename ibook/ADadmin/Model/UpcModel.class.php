<?php 
	namespace ADadmin\Model;
	use Think\Model;
	use Think\Model\RelationModel;
	class UpcModel extends RelationModel{
	   protected $_validate = array(     
		   array('code','require','请输入验证码！'),
		   array('code','check_verify','验证码错误！',0,'function',1),
		   array('username','require','用户名不能为空！'), 
		   array('username','','用户名已经存在！',0,'unique',1), 
		   array('passwd','6,14','密码长度为6-14个字符',0,'length'), 
		   array('repasswd','passwd','确认密码不正确',0,'confirm'), 	   
	   );
	   protected $_auto = array (          
		   array('passwd','md5',3,'function') , 
		   );

	   protected $_link = array( 

	   	'userinfo'=>array( //注意 userinfo

	   		'mapping_type' => self::HAS_ONE,
	   		'class_name'   => 'userinfo',
	   		'foreign_key'  => 'upcid',
	   		// 'as_fields'    => 'tel,email,regdate,lastlogindate,addr,number,vip,shopcartid,maxbooks,truename',
	           
	   	),
	   );
	}
 ?>

