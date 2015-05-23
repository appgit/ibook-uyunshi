<?php 
	namespace Home\Model;
	use Think\Model;
	use Think\Model\RelationModel;
	class ShangpinModel extends RelationModel{
	   	protected $_validate = array(     
		   array('code','require','请输入验证码！'),
		   array('code','check_verify','验证码错误！',0,'function',3),
		   array('name','require','请输入商品名称'),
		   array('price','require','请输入商品价格'),
		   array('price','is_numeric','商品价格必须为数字',0,'function',3),
		   array('costprice','require','请输入商品原价'),
		   array('costprice','is_numeric','商品原价必须为数字',0,'function',3),
		   array('description','require','请输入商品描述信息'),
	   );
	}
 ?>

