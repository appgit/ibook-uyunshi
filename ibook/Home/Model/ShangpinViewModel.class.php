<?php 
	namespace Home\Model;
	use Think\Model\ViewModel;
	class ShangpinViewModel extends ViewModel{

	   public $viewFields = array(
	        'shangpin'=>array('id','chatcount','publishdate','ishandled','description','status','stypeid','name','costprice','duedate','image','price','isnew'), 
	        'userinfo'=>array('id'=>'userid','username','tel','email','addr','truename','_on'=>'shangpin.userid=userinfo.id'), 
	        'stype'=>array('id'=>'stypeid','note'=>'stype', '_on'=>'shangpin.stypeid=stype.id'),     
	    	'btype'=>array('id'=>'btypeid','note'=>'btype', '_on'=>'stype.btypeid=btype.id'),  
	    	'sptype'=>array('note'=>'sptype','id'=>'sptypeid', '_on'=>'btype.sptypeid=sptype.id'), 
	      );
		}
 ?>
