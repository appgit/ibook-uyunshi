<?php 
	namespace Home\Model;
	use Think\Model\ViewModel;
	class OrdersViewModel extends ViewModel{

	   public $viewFields = array(
	   		'orders'=>array('id','sid'=>'sellerid','createtime','isread','description'),
	        'shangpin'=>array('id'=>'shangpinid','name','costprice','image','price','isnew','_on'=>'orders.spid=shangpin.id'), 
	        'userinfo'=>array('id'=>'userid','isseller','username','tel','email','number'=>'qq','addr','truename','_on'=>'orders.uid=userinfo.id'), 
	        'avatar'=>array('path'=>'avatar', '_on'=>'avatar.uid=userinfo.id'),
	        // 'stype'=>array('id'=>'stypeid','note'=>'stype', '_on'=>'shangpin.stypeid=stype.id'),     
	    	// 'btype'=>array('id'=>'btypeid','note'=>'btype', '_on'=>'stype.btypeid=btype.id'),  
	    	// 'sptype'=>array('note'=>'sptype','id'=>'sptypeid', '_on'=>'btype.sptypeid=sptype.id'), 
	      );
		}
 ?>
