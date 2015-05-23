<?php 
	namespace ADadmin\Model;
	use Think\Model;
		use Think\Model\RelationModel;
	class UserinfoModel extends RelationModel{
	   protected $_validate = array(     
		   #array('code','require','请输入验证码！'),
		   array('tel','require','请输入联系电话！'),     
		   array('tel','number','联系电话非法！'),
		   array('email','email','邮箱格式不正确！'),
		   array('number','require','请填写正确的学号！'), 
		   array('addr','require','请输入您的地址！'), 
		   array('truename','require','请输入您的真实姓名！'), 
		   // 验证确认密码是否和密码一致 
	   );
	    protected $_link = array( 

	   	'coin'=>array( //注意 userinfo

	   		'mapping_type' => self::HAS_ONE,
	   		'class_name'   => 'coin',
	   		'foreign_key'  => 'userid',
	           
	   	),
	   );
	}
 ?>