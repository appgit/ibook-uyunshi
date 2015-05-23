<?php 
	namespace ADadmin\Model;
	use Think\Model\RelationModel;
	class ShoppingcartModel extends RelationModel{
		protected $_link = array( 

	   	'book'=>array( 

	   		'mapping_type' => self::BELONGS_TO,
	   		'class_name'   => 'book',
	   		'foreign_key'  => 'bookid',
	   		// 'as_fields'    => 'id,status,bookname,price,publish,author,bookimage,newlevel,classid,publishdate,costprice,ishotsell,issepprice,count,hasnote',
	           
	   	),
	   );
	}
 ?>
